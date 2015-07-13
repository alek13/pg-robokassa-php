<?php
namespace App\Components\Robokassa\Client\Callback;

use App\Components\Utils\Enum;

class Type extends Enum
{
	const RESULT  = 'result';
	const SUCCESS = 'success';
	const FAIL    = 'fail';
} 