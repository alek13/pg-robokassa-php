<?php

namespace App\Components\Robokassa\TestSoap;

class Currency
{

	/**
	 *
	 * @var Rate $Rate
	 * @access public
	 */
	public $Rate = null;

	/**
	 *
	 * @var string $Label
	 * @access public
	 */
	public $Label = null;

	/**
	 *
	 * @var string $Name
	 * @access public
	 */
	public $Name = null;

	/**
	 *
	 * @param Rate   $Rate
	 * @param string $Label
	 * @param string $Name
	 *
	 * @access public
	 */
	public function __construct($Rate, $Label, $Name)
	{
		$this->Rate  = $Rate;
		$this->Label = $Label;
		$this->Name  = $Name;
	}
}
