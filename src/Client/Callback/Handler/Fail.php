<?php
namespace App\Components\Robokassa\Client\Callback\Handler;


class Fail extends AbstractRedirect
{
	/**
	 * @var bool
	 */
	protected static $needSignatureVerification = false;
}