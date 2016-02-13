<?php

/**
 * Description of EUtente
 *
 * @author mdl
 */
class EUtente {

    public $email;
    public $password;
    public $nome;
    public $nDocumento;
    public $stato = false;
    public $admin = false;
    
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
     * @æccess public
     * @return boolean
     */
    public function isEnable() {
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
