<?php
class PsnPsnID extends PSNApi
{
	public function getPSNID($psnID)
	{	
		$postFields = array(
			'sPSNID' => $psnID,
		);

		$this->curl->setCurlHeader('Content-Type','application/x-www-form-urlencoded')
			   ->setCurlHeader('Content-Length',strlen($psnID))
			   ->setCurlOption(CURLOPT_POST, count($postFields))
               ->setCurlOption(CURLOPT_POSTFIELDS, http_build_query($postFields));
        
        $data = simplexml_load_string($this->getUrl('getPSNID'));
		$response = $this->_parseData($data);
		
		return $response;
	}
	
	protected function _parseData($data)
	{
		$returnData = array(
			'id' 			=> (string)$data->ID,
			'avatarSmall' 	=> (string)$data->AvatarSmall,
			'avatarMedium' 	=> (string)$data->AvatarMedium,
			'avatar' 		=> (string)$data->Avatar,
			'level' 		=> (string)$data->Level,
			'progress' 		=> (string)$data->Progress,
			'aboutme' 		=> (string)$data->AboutMe,
			'trophies' => array(
				'earned' 	=> (string)$data->Trophies->Earned,
				'platinum' 	=> (string)$data->Trophies->Platinum,
				'gold' 		=> (string)$data->Trophies->Gold,
				'silver' 	=> (string)$data->Trophies->Silver,
				'bronze' 	=> (string)$data->Trophies->Bronze,
				'total' 	=> (string)$data->Trophies->Total,
			),
			'status' => array(
				'online' 	=> (string)$data->Status->Online,
				'away' 		=> (string)$data->Status->Away,
			),
			'levelData' => array(
				'points' 	=> (string)$data->LevelData->Points,
				'floor' 	=> (string)$data->LevelData->Floor,
				'ceiling' 	=> (string)$data->LevelData->Ceiling,
				'progress' 	=> (string)$data->LevelData->Progress,
				'level' 	=> (string)$data->LevelData->level,
			)
		);
		
		return $returnData;
	}
}