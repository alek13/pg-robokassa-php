<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class CalcSummsResponseData extends ResponseData
{

	/**
	 *
	 * @var float $OutSum
	 * @access public
	 */
	public $OutSum = null;

	/**
	 *
	 * @param float $OutSum
	 *
	 * @access public
	 */
	public function __construct($OutSum)
	{
		parent::__construct();
		$this->OutSum = $OutSum;
	}
}
