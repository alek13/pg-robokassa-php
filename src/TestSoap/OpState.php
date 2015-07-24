<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

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
	 * @var int $StateCode
	 * @access public
	 */
	public $StateCode = null;

	/**
	 *
	 * @param string $MerchantLogin
	 * @param int    $InvoiceID
	 * @param string $Signature
	 * @param int    $StateCode
	 *
	 * @access public
	 */
	public function __construct($MerchantLogin, $InvoiceID, $Signature, $StateCode)
	{
		$this->MerchantLogin = $MerchantLogin;
		$this->InvoiceID     = $InvoiceID;
		$this->Signature     = $Signature;
		$this->StateCode     = $StateCode;
	}
}
