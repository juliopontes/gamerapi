<?php
class BattlelogPersona extends BattlelogAuthentication
{
	const OVERVIEW_STATS_URL = "overviewPopulateStats/%s/bf3/%s/";

    protected $_personaId;
    
    protected $_platformId;

    protected $_data = array();

    protected $_rawData = array();

    public function __construct ($personaId, $namespace)
    {
    	parent::__construct();
    	
        $this->_personaId = (int) $personaId;
        $this->_platformId = (int) BattlelogPlatform::getPlatformId($namespace);
        $this->_getOverview();
    }
    
    public function getPersonaId ()
    {
        return $this->_personaId;
    }

    protected function _getOverview()
    {
    	$url = sprintf(BattlelogPersona::OVERVIEW_STATS_URL, $this->_personaId, $this->_platformId);
		$response = $this->getUrl($url);
		$response = json_decode($response);
        $this->_rawData = $this->objectToArray($response);

        if($this->_rawData['type'] == "success") {
            $this->_data = $this->_rawData['data'];
        } else {
            throw new Exception("Battlelog overview stats API returned a failure");            
        }
    }

    public function getStatPids()
    {
        return $this->_data['statPids'];
    }

    public function bf3GadgetsLocale()
    {
        return $this->_data['bf3GadgetsLocale'];
    }

    public function getOverviewStatistics()
    {
        return $this->_data['overviewStats'];
    }

    public function getTopStatistics()
    {
        return $this->_data['topStats'];
    }

    public function getUser()
    {
        return $this->_data['user'];
    }

    public function getKitMap()
    {
        return $this->_data['kitMap'];
    }

    public function getCurrentRankNeeded()
    {
        return $this->_data['currentRankNeeded'];
    }

    public function getRankNeeded()
    {
        return $this->_data['rankNeeded'];
    }
    
    public function toArray ()
    {
        return $this->_data;
    }
}