<?php

namespace Alek\PaymentGate\Robokassa\TestSoap;

class CurrenciesList extends ResponseData
{

	/**
	 *
	 * @var PaymentMethodGroup[] $Groups
	 * @access public
	 */
	public $Groups = null;

	/**
	 *
	 * @param PaymentMethodGroup[] $Groups
	 *
	 * @access public
	 */
	public function __construct($Groups)
	{
		parent::__construct();
		$this->Groups = $Groups;
	}
}
