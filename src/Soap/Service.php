<?php

namespace Alek\PaymentGate\Robokassa\Soap;


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
		'GetPaymentMethods'         => 'Alek\PaymentGate\Robokassa\Soap\GetPaymentMethods',
		'GetPaymentMethodsResponse' => 'Alek\PaymentGate\Robokassa\Soap\GetPaymentMethodsResponse',
		'PaymentMethodsList'        => 'Alek\PaymentGate\Robokassa\Soap\PaymentMethodsList',
		'RatesRelatedResponseData'  => 'Alek\PaymentGate\Robokassa\Soap\RatesRelatedResponseData',
		'ResponseData'              => 'Alek\PaymentGate\Robokassa\Soap\ResponseData',
		'Result'                    => 'Alek\PaymentGate\Robokassa\Soap\Result',
		'Method'                    => 'Alek\PaymentGate\Robokassa\Soap\Method',
		'GetCurrencies'             => 'Alek\PaymentGate\Robokassa\Soap\GetCurrencies',
		'GetCurrenciesResponse'     => 'Alek\PaymentGate\Robokassa\Soap\GetCurrenciesResponse',
		'CurrenciesList'            => 'Alek\PaymentGate\Robokassa\Soap\CurrenciesList',
		'PaymentMethodGroup'        => 'Alek\PaymentGate\Robokassa\Soap\PaymentMethodGroup',
		'Currency'                  => 'Alek\PaymentGate\Robokassa\Soap\Currency',
		'Rate'                      => 'Alek\PaymentGate\Robokassa\Soap\Rate',
		'GetRates'                  => 'Alek\PaymentGate\Robokassa\Soap\GetRates',
		'GetRatesResponse'          => 'Alek\PaymentGate\Robokassa\Soap\GetRatesResponse',
		'RatesList'                 => 'Alek\PaymentGate\Robokassa\Soap\RatesList',
		'CalcOutSumm'               => 'Alek\PaymentGate\Robokassa\Soap\CalcOutSumm',
		'CalcOutSummResponse'       => 'Alek\PaymentGate\Robokassa\Soap\CalcOutSummResponse',
		'CalcSummsResponseData'     => 'Alek\PaymentGate\Robokassa\Soap\CalcSummsResponseData',
		'OpState'                   => 'Alek\PaymentGate\Robokassa\Soap\OpState',
		'OpStateResponse'           => 'Alek\PaymentGate\Robokassa\Soap\OpStateResponse',
		'OperationStateResponse'    => 'Alek\PaymentGate\Robokassa\Soap\OperationStateResponse',
		'OperationState'            => 'Alek\PaymentGate\Robokassa\Soap\OperationState',
		'OperationInfo'             => 'Alek\PaymentGate\Robokassa\Soap\OperationInfo',
		'OperationPaymentMethod'    => 'Alek\PaymentGate\Robokassa\Soap\OperationPaymentMethod');

	/**
	 *
	 * @param array  $options A array of config values
	 * @param string $wsdl    The wsdl file to use
	 *
	 * @access public
	 */
	public function __construct(array $options = array(), $wsdl = './app/config/paymentGate/robokassa.wsdl')
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
	 * Расчет сумм оплаты в различных валютах
	 *
	 * @param CalcOutSumm $parameters
	 *
	 * @access public
	 * @return CalcOutSummResponse
	 */
	public function CalcOutSumm(CalcOutSumm $parameters)
	{
		return $this->__soapCall('CalcOutSumm', array($parameters));
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
