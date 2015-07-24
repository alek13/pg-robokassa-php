<?php
namespace Alek\PaymentGate\Robokassa\Client;

use App\Components\Utils\Enum;

class Mode extends Enum
{
	const TEST = 'test';
	const PROD = 'prod';
} 