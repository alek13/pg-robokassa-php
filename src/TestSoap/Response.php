<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

class Response
{

	/**
	 *
	 * @var Result $Result
	 * @access public
	 */
	public $Result = null;

	/**
	 *
	 * @param Result $Result
	 *
	 * @access public
	 */
	public function __construct($Result)
	{
		$this->Result = $Result;
	}
}
