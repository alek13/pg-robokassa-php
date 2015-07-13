<?php
namespace App\Components\Robokassa\Client\Callback;

use App\Components\Robokassa\Client;
use App\Components\Robokassa\Signer;

abstract class AbstractCallback implements Listener
{
	/**
	 * @var bool
	 */
	protected static $needSignatureVerification = true;
	/**
	 * @var bool
	 */
	protected static $signatureVerificationUsePassword1 = false;
	/**
	 * @var int one of InputMethod::<CONST>. (In this version:) also you can use one of 2 php constants [INPUT_GET, INPUT_POST]
	 */
	protected $inputMethod = null;
	/**
	 * @var Client
	 */
	protected $client = null;
	/**
	 * @var Listener
	 */
	private $listener = null;
	/**
	 * @var Signer
	 */
	private $signer;


	/**
	 * @param int      $inputMethod one of Method::<CONST>. (In this version:) also you can use one of 2 php constants [INPUT_GET, INPUT_POST]
	 * @param Client   $client
	 * @param Listener $listener
	 */
	public function __construct($inputMethod, Client $client, Listener $listener = null)
	{
		$this->setInputMethod($inputMethod);
		$this->client   = $client;
		$this->signer   = $client->getSigner();
		$this->listener = $listener;
	}

	/**
	 * @param int $inputMethod
	 *
	 * @throws Exception
	 * @return $this
	 */
	public function setInputMethod($inputMethod)
	{
		if (!InputMethod::isValid($inputMethod)) {
			throw new Exception('Unknown input method for callback');
		}

		$this->inputMethod = $inputMethod;

		return $this;
	}

	/**
	 * @param array $credentialsConfig
	 *
	 * @return $this
	 */
	public function setCredentials(array $credentialsConfig)
	{
		$this->client->setCredentials($credentialsConfig);
		$this->signer = $this->client->getSigner();

		return $this;
	}

	/**
	 * @param \App\Components\Robokassa\Client\Callback\Listener $listener
	 *
	 * @return $this
	 */
	protected function setGeneralListener(Listener $listener)
	{
		$this->listener = $listener;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function run()
	{
		$input = $this->inputMethod == InputMethod::GET ? $_GET : $_POST;

		try {
			// @todo filter_input($this->inputMethod, ... )
			list($sum, $invoiceId, $additionalParams) = self::extractInput($input);

			$this->listener->beforeRun($this, $sum, $invoiceId, $additionalParams, $input);

			if (static::$needSignatureVerification) {
				$signature  = $input['SignatureValue'];
				$baseParams = [$sum, $invoiceId];
				$this->signer->verify($signature, $baseParams, $additionalParams, static::$signatureVerificationUsePassword1);
				unset($input['SignatureValue']);
			}

			return
				$this->listener->onSuccess($sum, $invoiceId, $additionalParams, $input);
		} catch (\Exception $exception) {

			return
				$this->listener->onFailure($input, $exception);
		}
	}

	/**
	 * @param array $input
	 *
	 * @return array  [&$sum, &$invoiceId, &$additionalParams]
	 */
	private static function extractInput(array &$input)
	{
		$sum              = $input['OutSum'];
		$invoiceId        = $input['InvId'];
		$additionalParams = self::extractAdditionalParams($input);
		unset($input['OutSum']);
		unset($input['InvId']);

		return [&$sum, &$invoiceId, &$additionalParams];
	}

	/**
	 * @param array $input
	 *
	 * @return array
	 */
	private static function extractAdditionalParams(array &$input)
	{
		$additionalParams = [];
		foreach ($input as $key => $value) {
			if (strpos($key, 'shp') === 0) {
				$paramKey                    = substr($key, 3);
				$additionalParams[$paramKey] = $value;
				unset($input[$key]);
			}
		}

		return $additionalParams;
	}
}