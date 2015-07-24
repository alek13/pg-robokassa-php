<?php
namespace Alek\PaymentGate\Robokassa\Client\Callback\Handler;

use Alek\PaymentGate\Robokassa\Client\Callback\AbstractCallback;
use Alek\PaymentGate\Robokassa\Client\Callback\Listener;

class Result extends AbstractCallback
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
	 * @var Listener\ResultListener
	 */
	private $resultListener = null;
	/**
	 * @var
	 */
	private $expectedOpStateForTest;

	/**
	 * !!! use only for test mode or pass null
	 *
	 * @param null $opStateCode one of Data\OpState\Code::<CONST>
	 *
	 * @return $this
	 */
	public function setExpectedOpStateForTest($opStateCode = null)
	{
		$this->expectedOpStateForTest = $opStateCode;

		return $this;
	}

	/**
	 * @param Listener\ResultListener $resultListener
	 *
	 * @return $this
	 */
	public function setListener(Listener\ResultListener $resultListener)
	{
		$this->resultListener = $resultListener;

		return parent::setGeneralListener($this);
	}

	/**
	 * @param AbstractCallback $callbackHandler
	 * @param float            $sum
	 * @param int              $invoiceId
	 * @param array            $additionalParams
	 * @param array            $otherParams
	 */
	public function beforeRun(AbstractCallback $callbackHandler, $sum, $invoiceId, array $additionalParams, array $otherParams)
	{
		/** @var $callbackHandler Result    - its realy $this */
		$this->resultListener->beforeRun($callbackHandler, $sum, $invoiceId, $additionalParams);
	}

	/**
	 * @param double $sum
	 * @param int    $invoiceId
	 * @param array  $additionalParams
	 * @param array  $otherParams
	 *
	 * @return mixed
	 */
	public function onSuccess($sum, $invoiceId, array $additionalParams, array $otherParams)
	{
		$roboState = $this->client->opState(
			$invoiceId,
			$this->expectedOpStateForTest
		);

		$this->resultListener->onSuccess($sum, $invoiceId, $additionalParams, $roboState);

		return 'OK' . $invoiceId;
	}

	/**
	 * @param array      $input     raw (be careful) input params $_GET or $_POST
	 * @param \Exception $exception catched exception
	 *
	 * @return mixed
	 */
	public function onFailure(array $input, \Exception $exception)
	{
		$this->resultListener->onFailure($input, $exception);
		return false;
	}
}