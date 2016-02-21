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
            if ($this->result == 'TRUE') {
                // andata a buon fine
                return true;
            } else {
                // è una SELECT, SHOW, DESCRIBE, EXPLAIN
                return $this->getQueryResult();
            }

        }
        
    }

    protected function getQueryResult() {
        // controllo quanti elementi sono
        if (mysqli_num_rows($this->result) > 1) {
            return $this->getArrayObject();
        } else {
            return $this->getObject();
        }

    }

    private function getObject() {
        // mi faccio tornare il singolo array associativo
        return mysqli_fetch_assoc($this->result);
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

    public function getAllElement() {

        $query = 'SELECT * FROM '.$this->table.';';
        return $this->executeQuery($query);
    }
    
    public function load($key) {

        $query = 'SELECT * FROM '.$this->table.' WHERE '.$this->keytable.' = \''.$key.'\'';

        $temp = $this->executeQuery($query);

        return $temp;


    }

    public function addRow($paramRow) {

        $colonne = '';
        $valori = '\'';

//        $paramRow = mysqli_real_escape_string($this->connessione, $paramRow);

        foreach ($paramRow as $key => $value) {

            $colonne = $colonne.$key.', ';
            $valori = $valori.$value.'\', \'';

        }

        $colonne = substr($colonne, 0, strlen($colonne) - 2);
        $valori = substr($valori, 0, strlen($valori) - 3);

        $query = 'INSERT INTO '.$this->table.' ('.$colonne.') VALUE ('.$valori.');';
//        echo $query;

        return $this->executeQuery($query);

    }

    public function getLastRow() {

        $query = 'SELECT * FROM '.$this->table.' ORDER BY '.$this->keytable.' DESC LIMIT 1;';

        return $this->executeQuery($query);

    }

    public function deleteRow($key) {
        // rimuove la riga dal db in base alla chiave primaria
        $query = 'DELETE FROM '.$this->table.' WHERE '.$this->keytable.' = \''.$key.'\';';

        return $this->executeQuery($query);

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
