<?php

/**
 * Description of EUtente
 *
 * @author mdl
 */
class EUtente {
    
    private $id;
    private $nome;
    private $password;
    private $email;
    private $nDocumento;
    private $stato = false;
    private $admin = false;
    
    /**
     * @access public
     * @param Array() $param
     */
    public function __construct($param = Array()) {
        
        $this->id = $param['id'];
        $this->nome = $param['nome'];
        $this->email = $param['email'];
        $this->password = $param['password'];
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
     * @return bool
     */
    public function isAdmin() {
        return $this->admin;
    }

    /* SETTER */
    
    /**
     * @access public
     * @param int $param
     */
    public function setId($param) {
        $this->id = $param;
    }
    
    /**
     * @access public
     * @param String $param
     */
    public function setNome($param) {
        $this->nome = $param;
    }
    
    /**
     * @access public
     * @param String $param
     */
    public function setEmail($param) {
        $this->email = $param;
    }
    
    /**
     * @access public
     * @param String $param
     */
    public function setPassword($param) {
        $this->password = $param;
    }
        
    /**
     * @access public
     * @param String $param
     */
    public function setNDocumento($param) {
        $this->nDocumento = $param;
    }
    
    /**
     * @access public
     * @param boolean $param
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
     * @param $param
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
