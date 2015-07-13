<?php

namespace App\Components\Robokassa\Soap;

class OperationStateResponse extends ResponseData
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
	 * @param OperationState $State
	 * @param OperationInfo  $Info
	 *
	 * @access public
	 */
	public function __construct($State, $Info)
	{
		parent::__construct();
		$this->State = $State;
		$this->Info  = $Info;
	}
}
