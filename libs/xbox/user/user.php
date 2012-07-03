<?php
class XboxUser
{
	private $gamerTag = null;
	
	public function __construct($gamerTag)
	{
		$this->gamerTag = $gamerTag;
	}
	
	public function getGames($gamerTag=null)
	{
		if (is_null($gamerTag) && !empty($this->gamerTag))
		{
			$gamerTag = $this->gamerTag;
		}
		
		$xboxGames = new XboxGames();
		return $xboxGames->getGames($gamerTag);
	}
	
	public function getProfile($gamerTag=null)
	{
		if (is_null($gamerTag) && !empty($this->gamerTag))
		{
			$gamerTag = $this->gamerTag;
		}
		
		$xboxProfile = new XboxProfile();
		return $xboxProfile->getProfile($gamerTag);
	}
}