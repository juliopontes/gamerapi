<?php
abstract class BattlelogAuthentication extends BattlelogApi
{
	const COOKIE_FILE = 'battelog.txt';
	
	/**
     * Authorise username
     *
     * @var string
     */
    protected static $_authUsername = "";

    /**
     * Authorise password
     *
     * @var string
     */
    protected static $_authPassword = "";
    
    /**
     * Set the auth username
     *
     * @static
     * @param string $username Username
     * @return void
     */
    public static function setAuthUsername($username)
    {
        self::$_authUsername = $username;
    }

    /**
     * Set the auth password
     *
     * @static
     * @param string $password Password
     * @return void
     */
    public static function setAuthPassword($password)
    {
        self::$_authPassword = $password;
    }
    
    /**
     * Get the auth username
     *
     * @static
     * @return string
     */
    public static function getAuthUsername()
    {
        return self::$_authUsername;
    }

    /**
     * Get the auth password
     *
     * @static
     * @return string
     */
    public static function getAuthPassword()
    {
        return self::$_authPassword;
    }
	
	public function getUrl($url)
	{
		$postFields = array(
            "redirect" => "",
            "email" => self::getAuthUsername(),
            "password" => self::getAuthPassword(),
            "submit" => "Sign+in",
        );
        
        $curl = new GamerRequest();
        $curl->setCurlOption(CURLOPT_URL, sprintf(BattlelogApi::API_URL, 'gate/login/'))
				   ->setCurlOption(CURLOPT_COOKIEJAR, BattlelogAuthentication::COOKIE_FILE)
                   ->setCurlOption(CURLOPT_POST, true)
                   ->setCurlOption(CURLOPT_POSTFIELDS, http_build_query($postFields))
                   ->setCurlOption(CURLOPT_SSL_VERIFYPEER, false)
                   ->request();
        
        $this->curl->setCurlOption(CURLOPT_COOKIEFILE, BattlelogAuthentication::COOKIE_FILE);
        return parent::getUrl($url);
	}
}