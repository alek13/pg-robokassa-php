<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class GetPaymentMethods
{

	/**
	 *
	 * @var string $MerchantLogin
	 * @access public
	 */
	public $MerchantLogin = null;

	/**
	 *
	 * @var string $Language
	 * @access public
	 */
	public $Language = null;

	/**
	 *
	 * @param string $MerchantLogin
	 * @param string $Language
	 *
	 * @access public
	 */
	public function __construct($MerchantLogin, $Language)
	{
		$this->MerchantLogin = $MerchantLogin;
		$this->Language      = $Language;
	}
}
