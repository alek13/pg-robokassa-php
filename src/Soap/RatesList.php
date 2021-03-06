<?php

namespace Alek\PaymentGate\Robokassa\Soap;

class RatesList extends RatesRelatedResponseData
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
