<?php
namespace App\Components\Robokassa;


class Signer
{
	/**
	 * @var string
	 */
	private $login;
	/**
	 * @var string
	 */
	private $password1;
	/**
	 * @var string
	 */
	private $password2;

	/**
	 * @param string $login
	 * @param string $password1
	 * @param string $password2
	 */
	public function __construct($login, $password1, $password2)
	{
		$this->login     = $login;
		$this->password1 = $password1;
		$this->password2 = $password2;
	}


	private function makeHash(array $baseParams, array $additionalParams = [])
	{
		return md5(
			$s = implode(':', $baseParams) .
			(
			count($additionalParams) > 0
				? (':shp' . http_build_query($additionalParams, '', ':shp'))
				: ''
			)
		);
	}

	/**
	 * @param array $baseParams
	 * @param array $additionalParams
	 * @param bool  $usePassword2
	 *
	 * @return string
	 */
	public function sign(array $baseParams, array $additionalParams = [], $usePassword2 = false)
	{
		array_unshift($baseParams, $this->login);
		array_push($baseParams, $usePassword2 ? $this->password2 : $this->password1);

		ksort($additionalParams);

		return $this->makeHash($baseParams, $additionalParams);
	}


	/**
	 * @param string $signature
	 * @param array  $baseParams
	 * @param array  $additionalParams
	 * @param bool   $usePassword1
	 *
	 * @throws Signer\Exception
	 */
	public function verify($signature, array $baseParams, array $additionalParams = [], $usePassword1 = false)
	{
		array_push($baseParams, $usePassword1 ? $this->password1 : $this->password2);

		ksort($additionalParams);

		if (strtolower($signature) != $this->makeHash($baseParams, $additionalParams))
			throw new Signer\Exception('Robokassa signature not valid');
	}
}