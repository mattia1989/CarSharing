<?php

/**
 * Description of USession
 *
 * @author mdl
 */
class USession {
    
    public function __construct() {
        
        session_name('CarSharingSession');
        session_start();
        
    }
    
    public function setValue($key, $value) {
        
        $_SESSION[$key] = $value;
        
    }
    
    public function remuveValue($key) {
        
        unset($_SESSION[$key]);
        
    }
    
    static function getValue($key) {
        
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return FALSE;
        }
        
    }
    
    public function destroySession() {
        session_destroy();
    }
    
}

?>
