<?php
namespace Alek\PaymentGate\Robokassa\Data\OpState;

use App\Components\Utils\Enum;

class Code extends Enum
{
	const INITED   = 5;
	const CANCELED = 10;
	const CHARGED  = 50;
	const REFUNDED = 60;
	const PAUSED   = 80;
	const SUCCESS  = 100;
} 