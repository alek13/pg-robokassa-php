<?php

namespace App\Components\Robokassa\TestSoap;

class Result
{

	/**
	 *
	 * @var int $Code
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
	 * @param int    $Code
	 * @param string $Description
	 *
	 * @access public
	 */
	public function __construct($Code, $Description)
	{
		$this->Code        = $Code;
		$this->Description = $Description;
	}
}
