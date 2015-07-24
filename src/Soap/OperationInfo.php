<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class OperationInfo
{

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
	 * @var string $IncAccount
	 * @access public
	 */
	public $IncAccount = null;

	/**
	 *
	 * @var OperationPaymentMethod $PaymentMethod
	 * @access public
	 */
	public $PaymentMethod = null;

	/**
	 *
	 * @var string $OutCurrLabel
	 * @access public
	 */
	public $OutCurrLabel = null;

	/**
	 *
	 * @var float $OutSum
	 * @access public
	 */
	public $OutSum = null;

	/**
	 *
	 * @param string                 $IncCurrLabel
	 * @param float                  $IncSum
	 * @param string                 $IncAccount
	 * @param OperationPaymentMethod $PaymentMethod
	 * @param string                 $OutCurrLabel
	 * @param float                  $OutSum
	 *
	 * @access public
	 */
	public function __construct($IncCurrLabel, $IncSum, $IncAccount, $PaymentMethod, $OutCurrLabel, $OutSum)
	{
		$this->IncCurrLabel  = $IncCurrLabel;
		$this->IncSum        = $IncSum;
		$this->IncAccount    = $IncAccount;
		$this->PaymentMethod = $PaymentMethod;
		$this->OutCurrLabel  = $OutCurrLabel;
		$this->OutSum        = $OutSum;
	}
}
