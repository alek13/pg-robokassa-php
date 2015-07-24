<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class OpStateResponse
{

	/**
	 *
	 * @var OperationStateResponse $OpStateResult
	 * @access public
	 */
	public $OpStateResult = null;

	/**
	 *
	 * @param OperationStateResponse $OpStateResult
	 *
	 * @access public
	 */
	public function __construct($OpStateResult)
	{
		$this->OpStateResult = $OpStateResult;
	}
}
