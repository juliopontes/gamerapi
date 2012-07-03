<?php
abstract class BattlelogPlatform
{
	private static $platforms = array(
		'pc' => 1,
		'xbox' => 2,
		'ps3' => 4
	);
	
	public static function getPlatformId($name)
	{
		if (array_key_exists($name, self::$platforms))
		{
			return self::$platforms[$name];
		}
		
		throw new Exception('Platform not found try one of these platforms: '.implode(', ',self::$platforms));
	}
}