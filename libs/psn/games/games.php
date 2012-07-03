<?php
class PSNGames extends PSNApi
{
	public function getGames($psnId,$iMax=20,$sSince="")
	{
		$postFields = array(
			'sPSNID' => $psnId,
			'iMax' => $iMax,
			'sSince' => $sSince
		);
	
		$this->curl->setCurlHeader('Content-Type','application/x-www-form-urlencoded')
				   ->setCurlHeader('Content-Length',strlen($psnId))
				   ->setCurlOption(CURLOPT_POST, count($postFields))
				   ->setCurlOption(CURLOPT_POSTFIELDS, http_build_query($postFields));
	
		$data = $this->getUrl('getGames');
		$data = simplexml_load_string($this->curl->getResponse());
		$response = $this->_parseData($data);
		
		return $response;
	}
	
	protected function _parseData($data)
	{
		
		$returnData = array(
			'total' => count($data->Game),
			'games' => array(),
		);
		
		foreach ($data->Game as $game)
		{
			$gameData = array(
				'id' 			=> (string)$game->ID,
				'title' 		=> (string)$game->Title,
				'image' 		=> (string)$game->Image,
				'progress' 		=> (string)$game->Progress,
				'trophiesCount' => array(
					'earned' 	=> (string)$game->TrophiesCount->Earned,
					'total' 	=> (string)$game->TrophiesCount->Total,
					'platinum' 	=> (string)$game->TrophiesCount->Platinum,
					'gold' 		=> (string)$game->TrophiesCount->Gold,
					'silver' 	=> (string)$game->TrophiesCount->Silver,
					'bronze' 	=> (string)$game->TrophiesCount->Bronze,
				),
				'orderPlayed' 	=> (string)$game->OrderPlayed,
				'totalPoints' 	=> (string)$game->TotalPoints,
				'totalTrophies' => (string)$game->TotalTrophies,
				'userPoints' 	=> (string)$game->UserPoints,
				'stars' 		=> (string)$game->Stars,
				'reviews' 		=> (string)$game->Reviews,
				'platform' 		=> (string)$game->Platform,
			);
			
			$returnData['games'][] = $gameData;
		}
		
		return $returnData;
	}
}