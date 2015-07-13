<?php

namespace App\Components\Robokassa\TestSoap;

class PaymentMethodsList extends ResponseData
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
