<?php

namespace App\Components\Robokassa\TestSoap;

class RatesList extends ResponseData
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
