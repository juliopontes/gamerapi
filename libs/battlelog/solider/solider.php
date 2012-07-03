<?php
class BattlelogSolider extends BattlelogAuthentication
{
    protected $_data = array();

    public function __construct($data)
    {
        $this->_data = $data;
        
        parent::__construct();
    }
    
    public function getPersona()
    {
        return new BattlelogPersona($this->_data['persona']['personaId'],$this->_data['persona']['namespace']);
    }
    
    public function toArray ()
    {
        return $this->_data;
    }
}