<?php

/**
 * class FDatabase
 * @author Mattia Di Luca
 */
class FDatabase {

    public $connessione;
    
    protected $host;
    protected $user;
    protected $password;
    protected $database;

    protected $table;
    protected $keytable;

    protected $result;
    protected $resultClass;


    /**
     * @access public
     */
    public function __construct() {
        
        global $configs;
        $this->connect($configs['mysql']['localhost'], $configs['mysql']['user'],
                 $configs['mysql']['password'], $configs['mysql']['database']);
        
    }
    
    /* GETTER */
    
    /**
     * @access public
     * @return type
     */
    public function getConnessione() {
        return $this->connessione;
    }

    /* SETTER */
    
    /* METHOD */
    
    /**
     * @access private
     * @param String $paramHost
     * @param String $paramUser
     * @param String $paramPsw
     * @param String $paramDb
     * @return boolean
     */
    private function connect($paramHost, $paramUser, $paramPsw, $paramDb) {
        
        $this->host = $paramHost;
        $this->user = $paramUser;
        $this->password = $paramPsw;
        $this->database = $paramDb;
        
        $this->connessione = mysqli_connect($paramHost, $paramUser, $paramPsw);
        
        if ($this->connessione != TRUE) {
            echo ("Errore mysql: " . mysqli_error());
            return false;
        }

        $selectedDB = mysqli_select_db($this->connessione, $paramDb);

        if (!$selectedDB) {
            die('Impossibile selezionare il db: ' . mysqli_error());
            return false;
        }

        $this->executeQuery("SET NAMES utf8");

        return true;
        
    }
    
    /**
     * @access public
     * @param String $paramQuery
     * @return boolean
     */
    public function executeQuery($paramQuery) {

        $this->result = mysqli_query($this->connessione, $paramQuery) or die("Impossibile effettuare la query: "
                . mysqli_error($this->connessione));

        if (!$this->result) {
            // non andata a buon fine
            return false;
        } else {

            if ($this->result == true) {
                // andata a buon fine
                return true;
            } else {
                // è una SELECT, SHOW, DESCRIBE, EXPLAIN
                return $this->getQueryResult();
            }

        }
//        $tmpResult = array();
//
//        $numRows = mysqli_num_rows($result);
//
//        for ($i = 0; $i < $numRows; $i++) {
//
//            $query_result = mysqli_fetch_assoc($result);
//            $tmpResult[$i] = $query_result;
//
//        }
//
//        $this->result = $tmpResult;
//
//        if (count($this->result) > 0) {
//            return $this->result;
//        } else {
//            return false;
//        }
        
    }

    private function getQueryResult() {
        // controllo quanti elementi sono
        if (count($this->result) > 1) {
            return $this->getObject();
        } else {
            return $this->getArrayObject();
        }
    }

    private function getObject() {
        // mi faccio tornare il singolo oggetto
        return mysqli_fetch_object($this->result);
    }

    private function getArrayObject() {
        // mi faccio tornare un array con dentro i singoli oggetti
        $resultArray = array();
        $i = 0;

        while ($obj = $this->getObject()) {

            $resultArray[$i] = $obj;
            $i++;

        }

        return $resultArray;

    }
    
    public function load($key) {

        $query = 'SELECT * FROM '.$this->table.' WHERE '.$this->keytable.' = \''.$key.'\'';
        $this->executeQuery($query);

        return $this->getObject();
        
    }

    /**
     * @access public
     */
    public function closeConnection() {

        mysqli_close($this->connessione);

    }
    
    // Completare
    
}

?>
