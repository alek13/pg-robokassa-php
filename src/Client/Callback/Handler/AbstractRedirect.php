<?php
namespace App\Components\Robokassa\Client\Callback\Handler;

use App\Components\Robokassa\Client\Callback\AbstractCallback;
use App\Components\Robokassa\Client\Callback\Listener;

abstract class AbstractRedirect extends AbstractCallback
{
	/**
	 * @var Listener\RedirectListener
	 */
	private $redirectListener = null;

	/**
	 * @param Listener\RedirectListener $successListener
	 *
	 * @return $this
	 */
	public function setListener(Listener\RedirectListener $successListener)
	{
		$this->redirectListener = $successListener;

		return parent::setGeneralListener($this);
	}

	/**
	 * @param AbstractCallback $callbackHandler
	 * @param float            $sum
	 * @param int              $invoiceId
	 * @param array            $additionalParams
	 * @param array            $otherParams
	 *
	 * @internal param array $input
	 *
	 * @return array           returns an arraywith following vars: $sum, $invoiceId, $additionalParams
	 */
	public function beforeRun(AbstractCallback $callbackHandler, $sum, $invoiceId, array $additionalParams, array $otherParams)
	{
		/** @var $callbackHandler AbstractRedirect    - its realy $this */
		return $this->redirectListener->beforeRun($callbackHandler, $sum, $invoiceId, $additionalParams, $otherParams['Culture']);
	}


	/**
	 * @param float $sum
	 * @param int   $invoiceId
	 * @param array $additionalParams
	 * @param array $otherParams
	 *
	 * @return mixed
	 */
	public function onSuccess($sum, $invoiceId, array $additionalParams, array $otherParams)
	{
		return $this->redirectListener->onSuccess($sum, $invoiceId, $additionalParams, $otherParams['Culture']);
	}

	/**
	 * @param array      $input     raw (be careful) input params $_GET or $_POST
	 * @param \Exception $exception catched exception
	 *
	 * @return mixed
	 */
	public function onFailure(array $input, \Exception $exception)
	{
		return $this->redirectListener->onFailure($input, $exception);
	}
}