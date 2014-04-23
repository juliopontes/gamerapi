<?php
class GamerRequest
{
	private $header = array();
	private $info;
	private $response;
	private $ch;
	private $curlOptions = array();
    private $debug = true;
	
	public function set($name, $value)
	{
		if (!isset($this->$name))
		{
			throw new Exception('You cant set '.$name.' property because they not exists');
		}
		
		$this->$name = $value;
		
		return $this;
	}
	
	public function get($name)
	{
		if (!isset($this->$name))
		{
			throw new Exception('This property not exists');
		}
		
		return $this->$name;
	}

	public function getHttpCode()
	{
		if (!empty($this->response))
		{
			throw new Exception('You have a empty response');
		}
		
		return $this->response['http_code'];
	}

	public function setCurlOption($name, $value)
	{
		$this->curlOptions[$name] = $value;
	
		return $this;
	}
	
	public function setCurlHeader($name, $value)
	{
		$this->header[$name] = $value;
	
		return $this;
	}
	
	public function request()
	{
		$this->ch = curl_init();
		
		if (count($this->header) > 0)
		{
            if ($this->debug) {
                echo 'CURL HEADERS: <br ><ul>';
            }
			$sendHeaders = array();
			foreach ($this->header as $headerKey => $headerValue)
			{
				$sendHeaders[] = $headerKey.': '.$headerValue;
                if ($this->debug) {
                    echo sprintf('<li>%s - %s</li>', $headerKey, $headerValue);
                }
			}
            if ($this->debug) {
                echo '</ul><br />';
            }
			$this->setCurlOption(CURLOPT_HTTPHEADER,$sendHeaders);
		}
		
		if (count($this->curlOptions) > 0)
		{
            if ($this->debug) {
                echo 'CURL OPTIONS: <br ><ul>';
            }
			foreach ($this->curlOptions as $option => $value)
			{
                if ($this->debug) {
                    echo sprintf('<li>%s - %s</li>', $option, $value);
                }
				curl_setopt($this->ch, $option, $value);
			}
            if ($this->debug) {
                echo '</ul><br />';
            }
		}
		
		$this->response = curl_exec($this->ch);
		$this->info = curl_getinfo($this->ch);
		curl_close($this->ch);

        if ($this->debug) {
            echo 'CURL INFO: <br ><ul>';
            foreach ($this->info as $key => $value) {
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                if (is_array($key)) {
                    $key = json_encode($key);
                }
                echo sprintf('<li>%s - %s</li>', $key, $value);
            }
            echo '</ul>';
        }
		
		return $this;
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function getInfo($key=null)
	{
		if (!empty($key) && isset($this->info[$key]))
		{
			return $this->info[$key];
		}
		
		return $this->info;
	}
}