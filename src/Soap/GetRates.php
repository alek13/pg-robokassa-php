<?php

namespace App\Components\Robokassa\Soap;

class GetRates
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
	 * @var float $OutSum
	 * @access public
	 */
	public $OutSum = null;

	/**
	 *
	 * @var string $Language
	 * @access public
	 */
	public $Language = null;

	/**
	 *
	 * @param string $MerchantLogin
	 * @param string $IncCurrLabel
	 * @param float  $OutSum
	 * @param string $Language
	 *
	 * @access public
	 */
	public function __construct($MerchantLogin, $IncCurrLabel, $OutSum, $Language)
	{
		$this->MerchantLogin = $MerchantLogin;
		$this->IncCurrLabel  = $IncCurrLabel;
		$this->OutSum        = $OutSum;
		$this->Language      = $Language;
	}
}
