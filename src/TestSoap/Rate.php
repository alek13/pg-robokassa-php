<?php

namespace App\Components\Robokassa\TestSoap;

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
