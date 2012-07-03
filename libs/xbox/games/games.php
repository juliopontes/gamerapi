<?php
class XboxGames extends XboxApi
{
	public function getGames($gamerTag)
	{
		$url = sprintf('games/%s', urlencode($gamerTag));
		$data = $this->getUrl($url);
		$data = json_decode($data);
		$response = $this->_parseData($data);
		
		return $response;
	}
	
	public function _parseData($data)
	{
		$returnData = array(
			'games' => array(),
			'total' => count($data->Games)
		);
		
		foreach ($data->Games as $game)
		{
			$gameData = array(
				'image' => array(
					'large' 			=> $game->BoxArt->Large,
					'small' 			=> $game->BoxArt->Small,
				),
				'gamerID' 				=> $game->ID,
				'marketplaceURL' 		=> $game->MarketplaceURL,
				'name' 					=> $game->Name,
				'possibleAchievements' 	=> $game->PossibleAchievements,
				'possibleScore' 		=> $game->PossibleScore,
				'progress' => array(
					'achievements' 		=> $game->Progress->Achievements,
					'score' 			=> $game->Progress->Score
				)
			);
			
			$returnData['games'][] = $gameData;
		}
		
		return $returnData;
	}
}