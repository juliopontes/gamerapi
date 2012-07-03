<?php
class BattlelogUser extends BattlelogAuthentication
{
	const USER_URL = 'user/%s/';
	
	const FRIENDS_URL = 'user/%s/friends/';
	
	const SERVERS_URL = 'user/%s/servers/';
	
	private $_userId;
	
	private $_platformId;
	
    public function __construct($username)
    {
		parent::__construct();
        $this->_username = $username;
        $this->_getUser();
    }
    
    protected function _getUser()
    {
        $url = sprintf(BattlelogUser::USER_URL, $this->_username);
        
        $this->_rawData = $this->getUrl($url);
        
        $data = $this->objectToArray(json_decode($this->_rawData));
        $this->_data = $data['context'];
        $this->_userId = $this->_data['profileCommon']['user']['userId'];
    }
	
    public function getProfile()
    {
        return $this->_data['profileCommon'];
    }
    
    public function getPlatoons()
    {
        $profile = $this->getProfile();
        return $profile['platoons'];
    }

    public function getUserInfo()
    {
        $profile = $this->getProfile();
        return $profile['userinfo'];
    }

    public function getUserStatusMessage()
    {
        $profile = $this->getProfile();
        return $profile['userStatusMessage'];
    }
    
    public function getFeed()
    {
        $profile = $this->getProfile();
        return $profile['feed'];
    }

    public function getSoldiers()
    {
        $soldiersBox = $this->_data['soldiersBox'];

        $soldiers = array();
        foreach($soldiersBox as $soldier) {
            $soldiers[] = new BattlelogSolider($soldier);
        }

        return $soldiers;

    }

    public function getSoldier($offset)
    {

        $soldiers = $this->getSoldiers();
        if(array_key_exists($offset, $soldiers)) {
            return $soldiers[$offset];
        }
        return null;
    }

    public function getPersonas ()
    {
        $personas = array();
        foreach($this->getSoldiers() as $soldier) {
            $persona = $soldier->getPersona();
            $personas[$persona->getPersonaId()] = $persona;
        }
        return $personas;
    }

    public function getPersona($personaId)
    {
        $personas = $this->getPersonas();
        if(array_key_exists($personaId, $personas)) {
            return $personas[$personaId];
        } else {
            throw new Exception("Persona matching '" . $personaId . "' not found for user '" . $this->_userId . "'");
        }
    }

    public function getRawData()
    {
        return $this->_rawData;
    }
    
    public function toArray()
    {
	    return $this->_data;
    }
}