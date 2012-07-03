<?php
abstract class GamerApi
{
	protected $curl;
	
	public function __construct()
	{
		$this->curl = new GamerRequest();
	}
}