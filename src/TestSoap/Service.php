<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;


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
		'GetPaymentMethods'         => 'Alek\PaymentGate\Robokassa\TestSoap\GetPaymentMethods',
		'GetPaymentMethodsResponse' => 'Alek\PaymentGate\Robokassa\TestSoap\GetPaymentMethodsResponse',
		'PaymentMethodsList'        => 'Alek\PaymentGate\Robokassa\TestSoap\PaymentMethodsList',
		'ResponseData'              => 'Alek\PaymentGate\Robokassa\TestSoap\ResponseData',
		'Result'                    => 'Alek\PaymentGate\Robokassa\TestSoap\Result',
		'Method'                    => 'Alek\PaymentGate\Robokassa\TestSoap\Method',
		'GetCurrencies'             => 'Alek\PaymentGate\Robokassa\TestSoap\GetCurrencies',
		'GetCurrenciesResponse'     => 'Alek\PaymentGate\Robokassa\TestSoap\GetCurrenciesResponse',
		'CurrenciesList'            => 'Alek\PaymentGate\Robokassa\TestSoap\CurrenciesList',
		'PaymentMethodGroup'        => 'Alek\PaymentGate\Robokassa\TestSoap\PaymentMethodGroup',
		'Currency'                  => 'Alek\PaymentGate\Robokassa\TestSoap\Currency',
		'Rate'                      => 'Alek\PaymentGate\Robokassa\TestSoap\Rate',
		'GetRates'                  => 'Alek\PaymentGate\Robokassa\TestSoap\GetRates',
		'GetRatesResponse'          => 'Alek\PaymentGate\Robokassa\TestSoap\GetRatesResponse',
		'RatesList'                 => 'Alek\PaymentGate\Robokassa\TestSoap\RatesList',
		'OpState'                   => 'Alek\PaymentGate\Robokassa\TestSoap\OpState',
		'OpStateResponse'           => 'Alek\PaymentGate\Robokassa\TestSoap\OpStateResponse',
		'OperationStateResponse'    => 'Alek\PaymentGate\Robokassa\TestSoap\OperationStateResponse',
		'Response'                  => 'Alek\PaymentGate\Robokassa\TestSoap\Response',
		'OperationState'            => 'Alek\PaymentGate\Robokassa\TestSoap\OperationState',
		'OperationInfo'             => 'Alek\PaymentGate\Robokassa\TestSoap\OperationInfo',
		'OperationPaymentMethod'    => 'Alek\PaymentGate\Robokassa\TestSoap\OperationPaymentMethod');

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
