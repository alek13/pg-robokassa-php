<?php
namespace Alek\PaymentGate\Robokassa\Client\Callback\Handler;


class Success extends AbstractRedirect
{
	/**
	 * @var bool
	 */
	protected static $needSignatureVerification = true;
	/**
	 * @var bool
	 */
	protected static $signatureVerificationUsePassword1 = true;
}