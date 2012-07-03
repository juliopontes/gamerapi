<?php
abstract class BattlelogApi extends GamerApi
{
	const API_URL = "http://battlelog.battlefield.com/bf3/%s";
	
	public function getUrl($url)
	{
		$url = sprintf(BattlelogApi::API_URL,$url);
		
		$this->curl->setCurlOption(CURLOPT_URL, $url)
				   ->setCurlOption(CURLOPT_RETURNTRANSFER, true)
				   ->setCurlHeader('X-Requested-With','XMLHttpRequest')
				   ->setCurlHeader('X-AjaxNavigation','1')
				   ->request();
		
		if ($this->curl->getInfo('http_code') != 200)
		{
			throw new Exception('Bad Request Code');
		}
		
		return $this->curl->getResponse();
	}
	
	function objectToArray($data)
	{
	    if (is_array($data) || is_object($data))
	    {
	        $result = array();
	        foreach ($data as $key => $value)
	        {
	            $result[$key] = $this->objectToArray($value);
	        }
	        return $result;
	    }
	    return $data;
	}
}