<?php
namespace Alek\PaymentGate\Robokassa\Client\Callback;

use Alek\PaymentGate\Robokassa\Client;
use App\Components\Utils\ClassForStaticUse;

class Factory extends ClassForStaticUse
{
	/**
	 * @param string                           $callbackType one of Type::<CONST>
	 * @param array                            $callbackConfig
	 * @param \Alek\PaymentGate\Robokassa\Client $client
	 *
	 * @throws Exception
	 * @return AbstractCallback
	 */
	public static function create($callbackType, array $callbackConfig, Client $client)
	{
		if (!Type::isValid($callbackType)) {
			throw new Exception('Unknown callback type');
		}

		$config = self::extractCallbackConfigFor($callbackType, $callbackConfig);

		$className = __NAMESPACE__ . '\\Handler\\' . ucfirst($callbackType);

		return new $className($config['method'], $client);
	}

	/**
	 * @param string $callbackType
	 * @param array  $config
	 *
	 * @return array
	 */
	private static function extractCallbackConfigFor($callbackType, array $config)
	{
		$callbackConfigByType = isset($config[$callbackType]) ? $config[$callbackType] : [];
		if (!isset($callbackConfigByType['method']))
			$callbackConfigByType['method'] = $config['defaultMethod'];

		return $callbackConfigByType;
	}

} 