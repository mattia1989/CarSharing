<?php
/**
 * @author Mattia Di Luca
 */

class FUserRecovery extends FDatabase {

    public function __construct()
    {
        parent::__construct();

        USingleton::getInstances('FDatabase');

        $this->table = 'UserRecovery';
        $this->keytable = 'Email';

    }

}