<?php

namespace App\Components\Robokassa\Soap;

class OperationState
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
	 * @var dateTime $RequestDate
	 * @access public
	 */
	public $RequestDate = null;

	/**
	 *
	 * @var dateTime $StateDate
	 * @access public
	 */
	public $StateDate = null;

	/**
	 *
	 * @param int      $Code
	 * @param string   $Description
	 * @param dateTime $RequestDate
	 * @param dateTime $StateDate
	 *
	 * @access public
	 */
	public function __construct($Code, $Description, $RequestDate, $StateDate)
	{
		$this->Code        = $Code;
		$this->Description = $Description;
		$this->RequestDate = $RequestDate;
		$this->StateDate   = $StateDate;
	}
}
