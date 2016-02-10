<?php

/**
 * Description of EMezzo
 *
 * @author mdl
 */
class EMezzo {

    private $targa;
    private $modello;
    private $cilindrata;
    private $carburante;
    private $km;
    private $colore;
    private $prezzo_giornaliero;
    private $prezzo_orario;

    /* GETTER */

    /**
     * @access public
     * @return String
     */
    public function getTarga() {
        return $this->targa;
    }

    /**
     * @access public
     * @return String
     */
    public function getModello() {
        return $this->modello;
    }

    /**
     * @access public
     * @return double
     */
    public function getCilindata() {
        return $this->cilindrata;
    }

    /**
     * @access public
     * @return String
     */
    public function getCarburante() {
        return $this->carburante;
    }

    /**
     * @access public
     * @return double
     */
    public function getKm() {
        return $this->km;
    }

    /**
     * @access public
     * @return String
     */
    public function getColore() {
        return $this->colore;
    }

    /**
     * @access public
     * @return double
     */
    public function getPrezzo_giornaliero() {
        return $this->prezzo_giornaliero;
    }

    /**
     * @access public
     * @return double
     */
    public function getPrezzo_orario() {
        return $this->prezzo_orario;
    }

    /* SETTER */

    /**
     * @access public
     * @param String $param
     */
    public function setTarga($param) {
        $this->targa = $param;
    }

    /**
     * @access public
     * @param String $param
     */
    public function setModello($param) {
        $this->modello = $param;
    }

    /**
     * @access public
     * @param double $param
     */
    public function setCilindrata($param) {
        $this->cilindrata = $param;
    }

    /**
     * @access public
     * @param String $param
     */
    public function setCarburante($param) {
        $this->carburante = $param;
    }

    /**
     * @access public
     * @param double $param
     */
    public function setKm($param) {
        $this->km = $param;
    }

    /**
     * @access public
     * @param String $param
     */
    public function setColore($param) {
        $this->colore = $param;
    }

    /**
     * @access public
     * @param double $param
     */
    public function setPrezzo_orario($param) {
        $this->prezzo_orario = $param;
    }

    /**
     * @access public
     * @param double $param
     */
    public function setPrezzo_giornaliero($param) {
        $this->prezzo_giornaliero = $param;
    }

}

?>
