<?php
abstract class GamerApi
{
	protected $curl;
	
	public function __construct()
	{
		$this->curl = new GamerRequest();
	}

    public function debug($bool = false)
    {
        $this->curl->set('debug', $bool);
    }
}