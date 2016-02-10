<?php

/**
 * Description of USingleton
 *
 * @author mdl
 */
class USingleton {
    public static $instances = Array();
    
    /**
     * @access private
     */
    private function __construct() {
        
    }
    
    /**
     * @access public
     * @param type $param
     * @return type
     */
    public static function getInstances($param) {
        
        if(! isset(self::$instances[$param])) {

            self::$instances[$param] = new $param;
            
        }
        
        return self::$instances[$param];
    }
    
}

?>
