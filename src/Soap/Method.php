<?php

namespace App\Components\Robokassa\Soap;

class Method
{

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
	 * @param string $Code
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
