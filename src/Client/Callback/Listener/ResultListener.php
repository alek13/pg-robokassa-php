<?php

namespace App\Components\Robokassa\Client\Callback\Listener;


use App\Components\Robokassa\Client\Callback\Handler\Result;

interface ResultListener
{
	/**
	 * @param Result $callbackHandler
	 * @param double           $sum
	 * @param int              $invoiceId
	 * @param array            $additionalParams
	 *
	 * @return mixed
	 */
	public function beforeRun(Result $callbackHandler, $sum, $invoiceId, array $additionalParams);

	/**
	 * @param double $sum
	 * @param int    $invoiceId
	 * @param array  $additionalParams
	 * @param \App\Components\Robokassa\TestSoap\OperationStateResponse $roboState
	 */
	public function onSuccess($sum, $invoiceId, array $additionalParams, $roboState);

	/**
	 * @param array      $input     raw (be careful) input params $_GET or $_POST
	 * @param \Exception $exception catched exception
	 */
	public function onFailure(array $input, \Exception $exception);
}
