<?php
class PSNUser
{
	private $psnID = null;
	
	public function __construct($psnID)
	{
		$this->psnID = $psnID;
	}
	
	public function getGames($limit=20,$psnID=null)
	{
		if (is_null($PSNId) && !empty($this->psnID))
		{
			$psnID = $this->psnID;
		}
		
		$psnGames = new PSNGames();
		return $psnGames->getGames($psnID,$limit);
	}
	
	public function getPSNID($psnID=null)
	{
		if (is_null($psnID) && !empty($this->psnID))
		{
			$psnID = $this->psnID;
		}
		
		$psnPsnID = new PsnPsnID();
		return $psnPsnID->getPSNID($psnID);
	}
}