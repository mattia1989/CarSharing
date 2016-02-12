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
    protected $result;
    protected $table;
    protected $keytable;
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
    
    /**
     * @access public
     * @return boolean
     */
    public function getObject() {

        if (count($this->result) > 0) {
            $nrighe = mysqli_num_rows($this->result);

            if ($nrighe > 0) {

                $row = mysqli_fetch_object($this->result, $this->returnClass);
                $this->result = false;
                return $row;

            } else {
                return false;
            }

        } else {
            return false;
        }
        
    }

    /* SETTER */
    
    /* METHOD */
    
    /**
     * @access public
     * @param String $paramHost
     * @param String $paramUser
     * @param String $paramPsw
     * @param String $paramDb
     * @return boolean
     */
    public function connect($paramHost, $paramUser, $paramPsw, $paramDb) {
        
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

        $result = mysqli_query($this->connessione, $paramQuery) or die("Impossibile effettuare la query: "
                . mysqli_error($this->connessione));

        $tmpResult = array();

        $numRows = mysqli_num_rows($result);

        for ($i = 0; $i < $numRows; $i++) {

            $query_result = mysqli_fetch_assoc($result);
            $tmpResult[$i] = $query_result;

        }

        $this->result = $tmpResult;

        echo 'Query result count value: '.count($this->result);

        if (count($this->result) > 0) {
            return $this->result;
        } else {
            return false;
        }
        
    }

    public function addObject($param) {
        
        $valori = '';
        $campi = '';
        $i = 0;
        
        foreach ($param as $key => $value) {
            
            if ($i > 0) {
                
                $campi .= ',';
                $valori .= ',';

            }
            
            $keyval = mysqli_escape_string($key);
            $valueval = mysqli_escape_string($value);
            $campi .= "$keyval";
            $valori .= "$valueval";
            $i++;
            
        }
        
        $query = "INSERT INTO $this->table ($campi) VALUES ($valori);";

        return $this->executeQuery($query);
        
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
