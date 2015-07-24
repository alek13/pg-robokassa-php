<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class PaymentMethodsList extends RatesRelatedResponseData
{

	/**
	 *
	 * @var Method[] $Methods
	 * @access public
	 */
	public $Methods = null;

	/**
	 *
	 * @param Method[] $Methods
	 *
	 * @access public
	 */
	public function __construct($Methods)
	{
		parent::__construct();
		$this->Methods = $Methods;
	}
}
