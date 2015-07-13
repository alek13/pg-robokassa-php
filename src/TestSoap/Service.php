<?php

namespace App\Components\Robokassa\TestSoap;


/**
 *
 */
class Service extends \SoapClient
{

	/**
	 *
	 * @var array $classmap The defined classes
	 * @access private
	 */
	private static $classmap = array(
		'GetPaymentMethods'         => 'App\Components\Robokassa\TestSoap\GetPaymentMethods',
		'GetPaymentMethodsResponse' => 'App\Components\Robokassa\TestSoap\GetPaymentMethodsResponse',
		'PaymentMethodsList'        => 'App\Components\Robokassa\TestSoap\PaymentMethodsList',
		'ResponseData'              => 'App\Components\Robokassa\TestSoap\ResponseData',
		'Result'                    => 'App\Components\Robokassa\TestSoap\Result',
		'Method'                    => 'App\Components\Robokassa\TestSoap\Method',
		'GetCurrencies'             => 'App\Components\Robokassa\TestSoap\GetCurrencies',
		'GetCurrenciesResponse'     => 'App\Components\Robokassa\TestSoap\GetCurrenciesResponse',
		'CurrenciesList'            => 'App\Components\Robokassa\TestSoap\CurrenciesList',
		'PaymentMethodGroup'        => 'App\Components\Robokassa\TestSoap\PaymentMethodGroup',
		'Currency'                  => 'App\Components\Robokassa\TestSoap\Currency',
		'Rate'                      => 'App\Components\Robokassa\TestSoap\Rate',
		'GetRates'                  => 'App\Components\Robokassa\TestSoap\GetRates',
		'GetRatesResponse'          => 'App\Components\Robokassa\TestSoap\GetRatesResponse',
		'RatesList'                 => 'App\Components\Robokassa\TestSoap\RatesList',
		'OpState'                   => 'App\Components\Robokassa\TestSoap\OpState',
		'OpStateResponse'           => 'App\Components\Robokassa\TestSoap\OpStateResponse',
		'OperationStateResponse'    => 'App\Components\Robokassa\TestSoap\OperationStateResponse',
		'Response'                  => 'App\Components\Robokassa\TestSoap\Response',
		'OperationState'            => 'App\Components\Robokassa\TestSoap\OperationState',
		'OperationInfo'             => 'App\Components\Robokassa\TestSoap\OperationInfo',
		'OperationPaymentMethod'    => 'App\Components\Robokassa\TestSoap\OperationPaymentMethod');

	/**
	 *
	 * @param array  $options A array of config values
	 * @param string $wsdl    The wsdl file to use
	 *
	 * @access public
	 */
	public function __construct(array $options = array(), $wsdl = '../app/config/paymentGate/robokassa.test.wsdl')
	{
		foreach (self::$classmap as $key => $value) {
			if (!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}

		parent::__construct($wsdl, $options);
	}

	/**
	 * Получение списка способов оплаты, доступных магазину
	 *
	 * @param GetPaymentMethods $parameters
	 *
	 * @access public
	 * @return GetPaymentMethodsResponse
	 */
	public function GetPaymentMethods(GetPaymentMethods $parameters)
	{
		return $this->__soapCall('GetPaymentMethods', array($parameters));
	}

	/**
	 * Получение списка валют, доступных магазину
	 *
	 * @param GetCurrencies $parameters
	 *
	 * @access public
	 * @return GetCurrenciesResponse
	 */
	public function GetCurrencies(GetCurrencies $parameters)
	{
		return $this->__soapCall('GetCurrencies', array($parameters));
	}

	/**
	 * Получение текущих курсов валют / расчет сумм оплаты в различных валютах
	 *
	 * @param GetRates $parameters
	 *
	 * @access public
	 * @return GetRatesResponse
	 */
	public function GetRates(GetRates $parameters)
	{
		return $this->__soapCall('GetRates', array($parameters));
	}

	/**
	 * Получение информации об операции и ее текущего состояния
	 *
	 * @param OpState $parameters
	 *
	 * @access public
	 * @return OpStateResponse
	 */
	public function OpState(OpState $parameters)
	{
		return $this->__soapCall('OpState', array($parameters));
	}
}
