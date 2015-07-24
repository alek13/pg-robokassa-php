<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

class GetPaymentMethodsResponse
{

	/**
	 *
	 * @var PaymentMethodsList $GetPaymentMethodsResult
	 * @access public
	 */
	public $GetPaymentMethodsResult = null;

	/**
	 *
	 * @param PaymentMethodsList $GetPaymentMethodsResult
	 *
	 * @access public
	 */
	public function __construct($GetPaymentMethodsResult)
	{
		$this->GetPaymentMethodsResult = $GetPaymentMethodsResult;
	}
}
