<?php
class XboxProfile extends XboxApi
{
	public function getProfile($gamerTag)
	{
		$url = sprintf('profile/%s',urlencode($gamerTag));
		$data = $this->getUrl($url);
		$data = json_decode($data);
		$response = $this->_parseData($data);
		
		return $response;
	}
	
	protected function _parseData($data)
	{
		$returnData = array(
			'gamertag' 					=> $data->Player->Gamertag,
			'name' 						=> $data->Player->Name,
			'location' 					=> $data->Player->Location,
			'reputation' 				=> $data->Player->Reputation,
			'gamerScore' 				=> $data->Player->Gamerscore,
			'bio' 						=> $data->Player->Bio,
			'online' 					=> $data->Player->Status->Online,
			'onlineStatus' 				=> $data->Player->Status->Online_Status,
			'images' => array(
				'gamertile' => array(
					'large' 			=> $data->Player->Avatar->Gamertile->Large,
					'small' 			=> $data->Player->Avatar->Gamertile->Small,
				),
				'gamerpic' => array(
					'large' 			=> $data->Player->Avatar->Gamerpic->Large,
					'small' 			=> $data->Player->Avatar->Gamerpic->Small,
				),
				'body' 					=> $data->Player->Avatar->Body,
			),
		);
		
		$recentGames = array();
		if (count($data->RecentGames))
		{
			foreach ($data->RecentGames as $recentGame)
			{
				$recentGame = array(
					'name' 				=> $recentGame->Name,
					'MarketplaceURL' 	=> $recentGame->MarketplaceURL,
					'gameID' 			=> $recentGame->id,
					'images' => array(
						'large' 		=> $recentGame->BoxArt->Large,
						'small' 		=> $recentGame->BoxArt->Small
					)
				);
				
				$recentGames[] = $recentGame;
			}
			
			$returnData['recentGames'] = $recentGames;
		}
		
		
		return $returnData;
	}
}