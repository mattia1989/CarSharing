<?php

/**
 * Description of USession
 * @author Mattia Di Luca
 */
class USession {
    
    public function __construct() {
        
        session_name('CarSharingSession');
        session_start();
        
    }
    
    public function setValue($key, $value) {
        
        $_SESSION[$key] = $value;
        
    }
    
    public function removeValue($key) {

        unset($_SESSION[$key]);
        
    }

    public function getValue($key) {

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
        
    }

    public function destroySession() {
        return session_destroy();
    }
    
}

?>
