<?php
abstract class XboxApi extends GamerApi
{
	const API_URL = "https://xboxapi.com/%s";
	
	public function getUrl($url)
	{
		$this->curl->setCurlOption(CURLOPT_URL, sprintf(XboxApi::API_URL,$url))
				   ->setCurlOption(CURLOPT_RETURNTRANSFER, true)
				   ->request();
		
		if ($this->curl->getInfo('http_code') != 200)
		{
			throw new Exception('Bad Request Code');
		}
		
		return $this->curl->getResponse();
	}
	
	abstract protected function _parseData($data);
}