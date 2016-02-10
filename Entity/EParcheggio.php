<?php

/**
 * Description of EParcheggio
 *
 * @author mdl
 */
class EParcheggio {
    
    private $id;
    private $indirizzo;
    private $citta;
    private $provincia;
    
    public function __construct() {
    }
    
    /* GETTER */
    
    /**
     * @access public
     * @return integer
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @access public
     * @return String
     */
    public function getIndirizzo() {
        return $this->indirizzo;
    }
    
    /**
     * @access public
     * @return String
     */
    public function getCitta() {
        return $this->citta;
    }
    
    /**
     * @access public
     * @return String
     */
    public function getProvincia() {
        return $this->provincia;
    }
    
    /* SETTER */
    
    /**
     * @access public
     * @param integer $param
     */
    public function setId($param) {
        $this->id;
    }
    
    /**
     * @access public
     * @param String $param
     */
    public function setIndirizzo($param) {
        $this->indirizzo;
    }

    /**
     * @access public
     * @param String $param
     */
    public function setCitta($param) {
        $this->citta;
    }
    
    /**
     * @access public
     * @param String $param
     */
    public function setProvincia($param) {
        $this->provincia;
    }
    
}

?>
