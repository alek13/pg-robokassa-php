<?php

namespace App\Components\Robokassa\Soap;

class CalcOutSummResponse
{

	/**
	 *
	 * @var CalcSummsResponseData $CalcOutSummResult
	 * @access public
	 */
	public $CalcOutSummResult = null;

	/**
	 *
	 * @param CalcSummsResponseData $CalcOutSummResult
	 *
	 * @access public
	 */
	public function __construct($CalcOutSummResult)
	{
		$this->CalcOutSummResult = $CalcOutSummResult;
	}
}
