<?php

namespace App\Components\Robokassa\TestSoap;

class PaymentMethodGroup
{

	/**
	 *
	 * @var Currency[] $Items
	 * @access public
	 */
	public $Items = null;

	/**
	 *
	 * @var string $Code
	 * @access public
	 */
	public $Code = null;

	/**
	 *
	 * @var string $Description
	 * @access public
	 */
	public $Description = null;

	/**
	 *
	 * @param Currency[] $Items
	 * @param string     $Code
	 * @param string     $Description
	 *
	 * @access public
	 */
	public function __construct($Items, $Code, $Description)
	{
		$this->Items       = $Items;
		$this->Code        = $Code;
		$this->Description = $Description;
	}
}
