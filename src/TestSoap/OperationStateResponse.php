<?php

namespace App\Components\Robokassa\TestSoap;

class OperationStateResponse extends Response
{

	/**
	 *
	 * @var OperationState $State
	 * @access public
	 */
	public $State = null;

	/**
	 *
	 * @var OperationInfo $Info
	 * @access public
	 */
	public $Info = null;

	/**
	 *
	 * @param Result         $Result
	 * @param OperationState $State
	 * @param OperationInfo  $Info
	 *
	 * @access public
	 */
	public function __construct($Result, $State, $Info)
	{
		parent::__construct($Result);
		$this->State = $State;
		$this->Info  = $Info;
	}
}
