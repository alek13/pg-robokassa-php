<?php
namespace Alek\PaymentGate\Robokassa\Client\Callback;


use App\Components\Utils\Enum;

class InputMethod extends Enum
{
	const GET  = INPUT_GET;
	const POST = INPUT_POST;
}