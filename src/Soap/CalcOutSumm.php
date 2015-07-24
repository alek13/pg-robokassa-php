<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class CalcOutSumm
{

	/**
	 *
	 * @var string $MerchantLogin
	 * @access public
	 */
	public $MerchantLogin = null;

	/**
	 *
	 * @var string $IncCurrLabel
	 * @access public
	 */
	public $IncCurrLabel = null;

	/**
	 *
	 * @var float $IncSum
	 * @access public
	 */
	public $IncSum = null;

	/**
	 *
	 * @param string $MerchantLogin
	 * @param string $IncCurrLabel
	 * @param float  $IncSum
	 *
	 * @access public
	 */
	public function __construct($MerchantLogin, $IncCurrLabel, $IncSum)
	{
		$this->MerchantLogin = $MerchantLogin;
		$this->IncCurrLabel  = $IncCurrLabel;
		$this->IncSum        = $IncSum;
	}
}
