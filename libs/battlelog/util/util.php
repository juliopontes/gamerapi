<?php
abstract class BattlelogUtil
{
	/**
	 * Returns the URL of a rank from the Battlelog CDN.
	 * 
	 * @param string $size The desired image size. Valid sizes are 'tiny', 'small', 'medium' and 'large'. Default size is small
	 */
	public static function getRankImage($rank, $size = 'small')
	{
		$validSizes = array('tiny', 'small', 'medium', 'large');
		$size = strtolower($size);
		
		if (!in_array($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		if ($rank < 45)
		{
			$rank = 'r'.$rank;
		}
		else
		{
			$rank = $rank - 45;
			$rank = 'ss'.$rank;
		}
		
		return "http://battlelog-cdn.battlefield.com/public/profile/bf3/stats/ranks/{$size}/{$rank}.png";
	}
	
	/**
	 * Returns the URL of a kit image from the Battlelog CDN.
	 * 
	 * @param string $kit The kit name. Valid kit names are 'assault', 'support', 'engineer', 'recon'.
	 * @param string $team The team designation. Valid teams are 'us' and 'ru'. Defaults to 'us'.
	 * @param string $size The image size. Valid image sizes are 'small', 'medium' and 'large'.
	 */
	public static function getKitImage($kit, $team = 'us', $size = 'medium')
	{
		$validKits = array('assault', 'recon', 'engineer', 'support');
		$validTeams = array('us', 'ru');
		$validSizes = array('small', 'medium', 'large');
		$kit = strtolower($kit);
		$team = strtolower($team);
		$size = strtolower($size);
		
		if (!in_array($kit, $validKits))
		{
			throw new Exception("Invalid kit '$kit' specified");
		}
		if (!in_array($team, $validTeams))
		{
			throw new Exception("Invalid team '$team' specified");
		}
		if (!in_array($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		return "http://battlelog-cdn.battlefield.com/public/profile/kits/{$size[0]}/bf3-{$team}-{$kit}.png";
	}
	
	/**
	 * Returns the URL of a ribbon image from the Battlelog CDN.
	 * 
	 * @param string|int $id The ribbon id.
	 * @param string $size The image size. Valid image sizes are 'small', 'medium' and 'large'.
	 */
	public static function getRibbonImage($id, $size = 'medium')
	{
		$validSizes = array('small', 'medium', 'large');
		$size = strtolower($size);
		
		if (!in_array($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		$id = str_pad($id, 2, '0', STR_PAD_LEFT);
		return "http://battlelog-cdn.battlefield.com/public/profile/bf3/stats/ribbons/{$size[0]}/r{$id}.png";
	}
	
	/**
	 * Returns the URL of a medal image from the Battlelog CDN.
	 * 
	 * @param string|int $id The medal id.
	 * @param string $size The image size. Valid image sizes are 'small', 'medium' and 'large'.
	 */
	public static function getMedalImage($id, $size = 'medium')
	{
		$validSizes = array('small', 'medium', 'large');
		$size = strtolower($size);
		
		if (!in_array($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		$id = str_pad($id, 2, '0', STR_PAD_LEFT);
		return "http://battlelog-cdn.battlefield.com/public/profile/bf3/stats/medals/{$size[0]}/m{$id}.png";
	}
	
	/**
	 * Returns the URL of an item image from the Battlelog CDN.
	 * 
	 * @param string $name The item name
	 * @param string $size The image size. Valid sizes are 'tiny', 'small', 'medium' and 'large'. Default size is medium.
	 */
	public static function getItemImage($name, $size = 'medium')
	{
		$validSizes = array(
				'tiny'		=> '79x43',
				'small'		=> '90x54',
				'medium'	=> '147x88',
				'large'		=> '512x308'
		);
		$size = strtolower($size);
		
		if (!array_key_exists($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		$name = strtolower($name);
		return "http://battlelog-cdn.battlefield.com/public/profile/bf3/stats/items_{$validSizes[$size]}/{$name}.png";
	}
	
	public static function getMapImage($name, $size='tiny')
	{
		$validSizes = array(
			'tiny'		=> '30x21',
			'large'		=> '992x164'
		)
		
		$size = strtolower($size);
		
		if (!array_key_exists($size, $validSizes))
		{
			throw new Exception("Invalid size '$size' specified");
		}
		
		$name = strtolower($name);
		return "http://battlelog-cdn.battlefield.com/public/base/bf3/map_images/{$validSizes[$size]}/{$name}.jpg";
	}
	
	public static function secondsToTime($seconds)
	{
	    // extract hours
	    $hours = floor($seconds / (60 * 60));
	 
	    // extract minutes
	    $divisor_for_minutes = $seconds % (60 * 60);
	    $minutes = floor($divisor_for_minutes / 60);
	 
	    // extract the remaining seconds
	    $divisor_for_seconds = $divisor_for_minutes % 60;
	    $seconds = ceil($divisor_for_seconds);
	 
	    // return the final array
	    $obj = array(
	        "h" => (int) $hours,
	        "m" => (int) $minutes,
	        "s" => (int) $seconds,
	    );
	    return $obj;
	}
}