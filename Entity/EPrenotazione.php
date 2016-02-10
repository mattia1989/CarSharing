<?php

/**
 * class EPrenotazione
 * @author Mattia Di Luca
 */
class EPrenotazione {
    
    private $id;
    private $user_id;
    private $data_prelievo;
    private $data_consegna;
    private $parcheggio_prelievo;
    private $parcheggio_consegna;
    private $veicolo_id;
    
    /* GETTER */
    
    /**
     * @access public
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @access public
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * @access public
     * @return Data
     */
    public function getData_prelievo() {
        return $this->data_prelievo;
    }
    
    /**
     * @access public
     * @return Data
     */
    public function getData_consegna() {
        return $this->data_consegna;
    }
    
    /**
     * @access public
     * @return EParcheggio
     */
    public function getParcheggio_prelivo() {
        return $this->parcheggio_prelievo;
    }
    
    /**
     * @access public
     * @return EParcheggio
     */
    public function getParcheggio_consegna() {
        return $this->parcheggio_consegna;
    }
    
    /**
     * @access public
     * @return EMezzo
     */
    public function getVeicoloId() {
        return $this->veicolo_id;
    }
    
    /* SETTER */
    
    /**
     * @access public
     * @param int $param
     */
    public function setID($param) {
        $this->id = $param;
    }

    /**
     * @access public
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    
    /**
     * @access public
     * @param Data $param
     */
    public function setData_prelievo($param) {
        $this->data_prelievo = $param;
    }
    
    /**
     * @access public
     * @param Data $param
     */
    public function setData_consegna($param) {
        $this->data_consegna = $param;
    }
    
    /**
     * @access public
     * @param EParcheggio $param
     */
    public function setParcheggio_prelievo($param) {
        $this->parcheggio_prelievo = $param;
    }
    
    /**
     * @access public
     * @param EParcheggio $param
     */
    public function setParcheggio_consegna($param) {
        $this->parcheggio_consegna = $param;
    }
    
    /**
     * @access public
     * @param EMezzo $param
     */
    public function setVeicoloId($param) {
        $this->veicolo_id = $param;
    }

}

?>
