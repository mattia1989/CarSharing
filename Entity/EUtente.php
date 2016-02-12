<?php

/**
 * Description of EUtente
 *
 * @author mdl
 */
class EUtente {

    private $email;
    private $password;
    private $nome;
    private $nDocumento;
    private $stato = false;
    private $admin = false;
    
    /**
     * @access public
     * @param Array() $param
     */
    public function __construct($param = Array()) {

        $this->email = $param['email'];
        $this->password = $param['password'];
        $this->nome = $param['nome'];
        $this->nDocumento = $param['nDocumento'];
        $this->stato = $param['stato'];
        $this->admin = $param['admin'];
        
    }
    
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
     * @return String
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * @access public
     * @return String
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * @access public
     * @return String
     */
    public function getPassword() {
        return $this->password;
    }
        
    /**
     * @access public
     * @return String
     */
    public function getNDocumento() {
        return $this->nDocumento;
    }
    
    /**
     * @æccess public
     * @return boolean
     */
    public function getStato() {
        return $this->stato;
    }

    /**
     * @access public
     * @return boolean
     */
    public function isAdmin() {
        return $this->admin;
    }

    /* SETTER */
    
    /**
     * @access public
     * @param int
     */
    public function setId($param) {
        $this->id = $param;
    }
    
    /**
     * @access public
     * @param String
     */
    public function setNome($param) {
        $this->nome = $param;
    }
    
    /**
     * @access public
     * @param String
     */
    public function setEmail($param) {
        $this->email = $param;
    }
    
    /**
     * @access public
     * @param String
     */
    public function setPassword($param) {
        $this->password = $param;
    }
        
    /**
     * @access public
     * @param String
     */
    public function setNDocumento($param) {
        $this->nDocumento = $param;
    }
    
    /**
     * @access public
     * @param boolean
     */
    public function setStato($param) {
        
        if($param != true) {
            $this->stato = false;
        } else {
            $this->stato = true;
        }
        
    }

    /**
     * @access public
     * @param boolean
     */
    public function setAdmin($param)
    {
        if($param != true) {
            $this->admin = false;
        } else {
            $this->admin = true;
        }

    }
    
}

?>
