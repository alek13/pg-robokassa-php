<?php
namespace Alek\PaymentGate\Robokassa;

use Alek\PaymentGate\Robokassa\Client\Callback\Factory;
use Alek\PaymentGate\Robokassa\Client\Callback\InputMethod;
use Alek\PaymentGate\Robokassa\Client\Mode;
use Alek\PaymentGate\Robokassa\Data\OpState\Code;
use Alek\PaymentGate\Robokassa\Merchant\Culture;


/**
 * Class Robokassa\Client
 *
 *
 */
class Client
{
	const TEST_MODE_REDIRECT_URL = 'http://test.robokassa.ru/Index.aspx';
	const PROD_MODE_REDIRECT_URL = 'https://auth.robokassa.ru/Merchant/Index.aspx';
	const MAX_INVOICE_DESC_LEN   = 100;

	const TEST_SOAP_NS = 'TestSoap';
	const PROD_SOAP_NS = 'Soap';
	/**
	 * @var string
	 */
	private $soap_ns = null;

	/**
	 * @var Soap\Service|TestSoap\Service
	 */
	private $soapService = null;
	/**
	 * @var Signer
	 */
	private $signer = null;
	/**
	 * @var string
	 */
	private $mode = Client\Mode::TEST;
	/**
	 * @var string
	 */
	private $login = null;
	/**
	 * @var array
	 */
	private $default = [];
	/**
	 * @var string
	 */
	private $callbackConfig = [];

	/**
	 * @param array $config
	 *
	 * @throws Exception
	 */
	public function __construct(array $config)
	{
		if (!Mode::isValid($config['mode'])) {
			throw new Client\Exception('Unknown client mode');
		}
		$this->mode    = $config['mode'];
		$this->soap_ns = __NAMESPACE__ . '\\' .
			($this->mode == Mode::TEST
				? self::TEST_SOAP_NS
				: self::PROD_SOAP_NS)
			. '\\';

		$merchantConfig = $config['merchant'];
		$this->default  = $merchantConfig['default'];
		if (isset($merchantConfig['credentials'])) {
			$this->setCredentials($merchantConfig['credentials']);
		}

		$this->setCallbackConfig($config);

		$soapServiceConfig = $config['soap']['service'];
		$soapServiceClass = $this->soap_ns. 'Service';
		$this->soapService = new $soapServiceClass($soapServiceConfig['options'], $soapServiceConfig['wsdl']);
	}

	/**
	 * @param array $credentialsConfig
	 *
	 * @return $this
	 */
	public function setCredentials(array $credentialsConfig)
	{
		$this->login  = $credentialsConfig['login'];
		$this->signer = new Signer($credentialsConfig['login'], $credentialsConfig['password1'], $credentialsConfig['password2']);

		return $this;
	}

	/**
	 * @param double $sum
	 * @param        $invoiceId
	 * @param array  $additionalParams
	 * @param string $invoiceDescription
	 * @param string $email
	 * @param string $currencyLabel
	 * @param string $culture one of Merchant\Culture::<CONST>
	 *
	 * @return string
	 * @throws Exception
	 */
	public function generateRedirectUrl($sum, $invoiceId, array $additionalParams = [], $invoiceDescription = null, $email = null, $currencyLabel = null, $culture = null)
	{
		if (strlen($invoiceDescription > self::MAX_INVOICE_DESC_LEN)) {
			throw new Exception('Invoice description lenth more then ' . self::MAX_INVOICE_DESC_LEN);
		}

		$http_get_params = [
			'MrchLogin'      => $this->login,
			'OutSum'         => $sum,
			'InvId'          => $invoiceId,
			'Desc'           => $invoiceDescription,
			'SignatureValue' => $this->signer->sign([$sum, $invoiceId], $additionalParams),
			'IncCurrLabel'   => $currencyLabel ? : (isset($this->default['currencyLabel']) ? $this->default['currencyLabel'] : null),
			'Email'          => $email,
			'Culture'        => $culture ? : $this->default['culture'],
		];
		if ($http_get_params['Desc'] == null) {
			unset($http_get_params['Desc']);
		}
		if ($http_get_params['Email'] == null) {
			unset($http_get_params['Email']);
		}
		if ($http_get_params['IncCurrLabel'] == null) {
			unset($http_get_params['IncCurrLabel']);
		}


		return
			($this->mode == Mode::PROD
				? self::PROD_MODE_REDIRECT_URL
				: self::TEST_MODE_REDIRECT_URL
			) .

			'?' . http_build_query($http_get_params) .

			(count($additionalParams) > 0
				? '&shp' . http_build_query($additionalParams, '', '&shp')
				: ''
			);
	}

	/**
	 * @return Signer
	 */
	public function getSigner()
	{
		return $this->signer;
	}

	//	/**
	//	 * @return \Alek\PaymentGate\Robokassa\Soap\Service
	//	 */
	//	public function getSoapService()
	//	{
	//		return $this->soapService;
	//	}

	/**
	 * @return Soap\Method[]|TestSoap\Method[]
	 * @throws Exception
	 */
	public function getPaymentMethods()
	{
		$response = $this->soapService->GetPaymentMethods(
			new ${$this->soap_ns . 'GetPaymentMethods'}($this->login, Culture::RUSSIAN)
		);
		$result   = $response->GetPaymentMethodsResult->Result;
		if ($result->Code != 0) {
			throw new Exception($result->Description, $result->Code);
		}

		return $response->GetPaymentMethodsResult->Methods->Method;
	}

	/**
	 * @return TestSoap\PaymentMethodGroup[]|Soap\PaymentMethodGroup[]
	 * @throws Exception
	 */
	public function getCurrencies()
	{
		$paramClass = $this->soap_ns . 'GetCurrencies';
		$response   = $this->soapService->GetCurrencies(
			new $paramClass($this->login, Culture::RUSSIAN)
		);

		$result = $response->GetCurrenciesResult->Result;
		if ($result->Code != 0) {
			throw new Exception($result->Description, $result->Code);
		}

		return $response->GetCurrenciesResult->Groups->Group;
	}

	/**
	 * @not-tested
	 *
	 * @param double $inSum
	 * @param string $currencyLabel
	 *
	 * @throws \BadMethodCallException
	 * @throws Exception
	 * @return double
	 */
	public function calcOutSumm($inSum, $currencyLabel = null)
	{
		if ($this->mode == Mode::TEST) {
			throw new \BadMethodCallException('Can`t request calcOutSumm: this method does not avaible in test mode (on Robokassa test server)');
		}

		$currencyLabel = $currencyLabel ? : $this->default['currencyLabel'];

		$paramClass = $this->soap_ns . 'CalcOutSumm';
		$response   = $this->soapService->CalcOutSumm(
			new $paramClass($this->login, $currencyLabel, $inSum)
		);

		$result = $response->CalcOutSummResult->Result;
		if ($result->Code != 0) {
			throw new Exception($result->Description, $result->Code);
		}

		return $response->CalcOutSummResult->OutSum;
	}

	/**
	 * @param int $invoiceId
	 * @param int $shouldReturnState use only for test mode; one of Data\OpState\Code::<CONST>
	 *
	 * @return TestSoap\OperationStateResponse|Soap\OperationStateResponse
	 * @throws \InvalidArgumentException
	 * @throws \BadMethodCallException
	 * @throws Exception
	 */
	public function opState($invoiceId, $shouldReturnState = null)
	{
		if ($this->mode == Mode::PROD && $shouldReturnState) {
			throw new \BadMethodCallException('Incorrect use of ::opState() method: param $shouldReturnState passed in prod mode, but expected ONLY in test mode');
		}
		if ($this->mode == Mode::TEST && !$shouldReturnState) {
			throw new \BadMethodCallException('Incorrect use of ::opState() method: in test mode expected $shouldReturnState parameter');
		}
		if ($this->mode == Mode::TEST && !Code::isValid($shouldReturnState)) {
			throw new \InvalidArgumentException('Can`t request opState: Incorrect operation state code');
		}

		$signature = $this->signer->sign([$invoiceId], [], true);

		$paramClass = $this->soap_ns . 'OpState';
		$response   = $this->soapService->OpState(
			$this->mode == Mode::TEST
				? new $paramClass($this->login, $invoiceId, $signature, $shouldReturnState)
				: new $paramClass($this->login, $invoiceId, $signature)
		);

		$result = $response->OpStateResult->Result;
		if ($result->Code != 0) {
			throw new Exception($result->Description, $result->Code);
		}

		unset($response->OpStateResult->Result);

		return $response->OpStateResult; //, $response->OpStateResult->Info;
	}


	/**
	 * @param string $callbackType one of Callback\Type::<CONST>
	 *
	 * @return Client\Callback\Handler\Result|Client\Callback\Handler\Success|Client\Callback\Handler\Fail
	 */
	public function callback($callbackType)
	{
		return
			Factory::create($callbackType, $this->callbackConfig, $this);
	}

	/**
	 * @param $config
	 *
	 * @return $this
	 */
	private function setCallbackConfig($config)
	{
		$callbackConfig = isset($config['callback']) ? $config['callback'] : [];
		if (!isset($callbackConfig['defaultMethod'])) {
			$callbackConfig['defaultMethod'] = InputMethod::POST;
		}

		$this->callbackConfig = $callbackConfig;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMode()
	{
		return $this->mode;
	}
}