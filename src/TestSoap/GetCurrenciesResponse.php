<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

class GetCurrenciesResponse
{

	/**
	 *
	 * @var CurrenciesList $GetCurrenciesResult
	 * @access public
	 */
	public $GetCurrenciesResult = null;

	/**
	 *
	 * @param CurrenciesList $GetCurrenciesResult
	 *
	 * @access public
	 */
	public function __construct($GetCurrenciesResult)
	{
		$this->GetCurrenciesResult = $GetCurrenciesResult;
	}
}
