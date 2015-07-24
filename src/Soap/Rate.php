<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class Rate
{

	/**
	 *
	 * @var float $IncSum
	 * @access public
	 */
	public $IncSum = null;

	/**
	 *
	 * @param float $IncSum
	 *
	 * @access public
	 */
	public function __construct($IncSum)
	{
		$this->IncSum = $IncSum;
	}
}
