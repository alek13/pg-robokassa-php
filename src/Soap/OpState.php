<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class OpState
{

	/**
	 *
	 * @var string $MerchantLogin
	 * @access public
	 */
	public $MerchantLogin = null;

	/**
	 *
	 * @var int $InvoiceID
	 * @access public
	 */
	public $InvoiceID = null;

	/**
	 *
	 * @var string $Signature
	 * @access public
	 */
	public $Signature = null;

	/**
	 *
	 * @param string $MerchantLogin
	 * @param int    $InvoiceID
	 * @param string $Signature
	 *
	 * @access public
	 */
	public function __construct($MerchantLogin, $InvoiceID, $Signature)
	{
		$this->MerchantLogin = $MerchantLogin;
		$this->InvoiceID     = $InvoiceID;
		$this->Signature     = $Signature;
	}
}
