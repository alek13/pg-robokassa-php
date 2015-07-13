<?php

namespace App\Components\Robokassa\Client\Callback;


interface Listener
{
	/**
	 * @param AbstractCallback $callbackHandler
	 * @param float            $sum
	 * @param int              $invoiceId
	 * @param array            $additionalParams
	 * @param array            $otherParams
	 */
	public function beforeRun(AbstractCallback $callbackHandler, $sum, $invoiceId, array $additionalParams, array $otherParams);

	/**
	 * @param double $sum
	 * @param int    $invoiceId
	 * @param array  $additionalParams
	 * @param array  $otherParams
	 *
	 * @return mixed
	 */
	public function onSuccess($sum, $invoiceId, array $additionalParams, array $otherParams);

	/**
	 * @param array      $input     raw (be careful) input params $_GET or $_POST
	 * @param \Exception $exception catched exception
	 *
	 * @return mixed
	 */
	public function onFailure(array $input, \Exception $exception);
}
