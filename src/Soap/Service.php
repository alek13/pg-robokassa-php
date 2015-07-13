<?php

namespace App\Components\Robokassa\Soap;


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
		'GetPaymentMethods'         => 'App\Components\Robokassa\Soap\GetPaymentMethods',
		'GetPaymentMethodsResponse' => 'App\Components\Robokassa\Soap\GetPaymentMethodsResponse',
		'PaymentMethodsList'        => 'App\Components\Robokassa\Soap\PaymentMethodsList',
		'RatesRelatedResponseData'  => 'App\Components\Robokassa\Soap\RatesRelatedResponseData',
		'ResponseData'              => 'App\Components\Robokassa\Soap\ResponseData',
		'Result'                    => 'App\Components\Robokassa\Soap\Result',
		'Method'                    => 'App\Components\Robokassa\Soap\Method',
		'GetCurrencies'             => 'App\Components\Robokassa\Soap\GetCurrencies',
		'GetCurrenciesResponse'     => 'App\Components\Robokassa\Soap\GetCurrenciesResponse',
		'CurrenciesList'            => 'App\Components\Robokassa\Soap\CurrenciesList',
		'PaymentMethodGroup'        => 'App\Components\Robokassa\Soap\PaymentMethodGroup',
		'Currency'                  => 'App\Components\Robokassa\Soap\Currency',
		'Rate'                      => 'App\Components\Robokassa\Soap\Rate',
		'GetRates'                  => 'App\Components\Robokassa\Soap\GetRates',
		'GetRatesResponse'          => 'App\Components\Robokassa\Soap\GetRatesResponse',
		'RatesList'                 => 'App\Components\Robokassa\Soap\RatesList',
		'CalcOutSumm'               => 'App\Components\Robokassa\Soap\CalcOutSumm',
		'CalcOutSummResponse'       => 'App\Components\Robokassa\Soap\CalcOutSummResponse',
		'CalcSummsResponseData'     => 'App\Components\Robokassa\Soap\CalcSummsResponseData',
		'OpState'                   => 'App\Components\Robokassa\Soap\OpState',
		'OpStateResponse'           => 'App\Components\Robokassa\Soap\OpStateResponse',
		'OperationStateResponse'    => 'App\Components\Robokassa\Soap\OperationStateResponse',
		'OperationState'            => 'App\Components\Robokassa\Soap\OperationState',
		'OperationInfo'             => 'App\Components\Robokassa\Soap\OperationInfo',
		'OperationPaymentMethod'    => 'App\Components\Robokassa\Soap\OperationPaymentMethod');

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
