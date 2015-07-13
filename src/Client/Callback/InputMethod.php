<?php
namespace App\Components\Robokassa\Client\Callback;


use App\Components\Utils\Enum;

class InputMethod extends Enum
{
	const GET  = INPUT_GET;
	const POST = INPUT_POST;
}