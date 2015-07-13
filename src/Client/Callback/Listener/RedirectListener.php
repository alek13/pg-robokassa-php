<?php
namespace App\Components\Robokassa\Client\Callback\Listener;

use App\Components\Robokassa\Client\Callback\Handler\AbstractRedirect;
use App\Components\Robokassa\Merchant\Culture;

interface RedirectListener
{
	/**
	 * @param AbstractRedirect $callbackHandler
	 * @param double           $sum
	 * @param int              $invoiceId
	 * @param array            $additionalParams
	 * @param string           $culture one of Culture::<CONST>
	 *
	 * @return mixed
	 */
	public function beforeRun(AbstractRedirect $callbackHandler, $sum, $invoiceId, array $additionalParams, $culture);

	/**
	 * @param double $sum
	 * @param int    $invoiceId
	 * @param array  $additionalParams
	 * @param string $culture one of Culture::<CONST>
	 *
	 * @return mixed
	 */
	public function onSuccess($sum, $invoiceId, array $additionalParams, $culture);

	/**
	 * @param array      $input     raw (be careful) input params $_GET or $_POST
	 * @param \Exception $exception catched exception
	 *
	 * @return mixed
	 */
	public function onFailure(array $input, \Exception $exception);
}
