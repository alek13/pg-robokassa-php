<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

class GetRatesResponse
{

	/**
	 *
	 * @var RatesList $GetRatesResult
	 * @access public
	 */
	public $GetRatesResult = null;

	/**
	 *
	 * @param RatesList $GetRatesResult
	 *
	 * @access public
	 */
	public function __construct($GetRatesResult)
	{
		$this->GetRatesResult = $GetRatesResult;
	}
}
