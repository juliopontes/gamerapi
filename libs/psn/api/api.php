<?php
abstract class PSNApi extends GamerApi
{
	const API_URL = "http://www.psnapi.com.ar/ps3/api/psn.asmx/%s";
	
	public function getUrl($url)
	{
		$this->curl->setCurlOption(CURLOPT_URL, sprintf(PSNApi::API_URL,$url))
				   ->setCurlOption(CURLOPT_RETURNTRANSFER, true)
				   ->setCurlOption(CURLOPT_FOLLOWLOCATION, 1)
				   ->setCurlOption(CURLOPT_SSL_VERIFYPEER, 0)
				   ->setCurlOption(CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)")
				   ->request();		
		
		if ($this->curl->getInfo('http_code') != 200)
		{
			throw new Exception('Bad Request Code');
		}
		
		return $this->curl->getResponse();
	}
	
	abstract protected function _parseData($data);
}