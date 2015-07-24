<?php
namespace Alek\PaymentGate\Robokassa\Client\Callback\Handler;


class Fail extends AbstractRedirect
{
	/**
	 * @var bool
	 */
	protected static $needSignatureVerification = false;
}