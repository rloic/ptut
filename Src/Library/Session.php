<?php

namespace Root\Src\Library;

class Session {
    
    private $_session;
    public static $instance;
    const ERASE = true;
    
    private function __construct() {
        $this->_session = session_start();
    }
    
    public static function getSession() {
        
        if(self::$instance == Null) {
            
            self::$instance = new Session();
            
        }
        
        return self::$instance;
        
    }
    
    public static function destroy() {
        
        self::$instance = Null;
        \session_destroy();
        
    }
    
    public function setValue($key, $value) {
        
        if(!isset($_SESSION['key'])) {
            
            $_SESSION[$key] = [];
            
        }
        
        array_push($_SESSION[$key], $value);
        
    }
    
    public function setMsg($category, $value) {
        
        if(!isset($_SESSION['flash'][$category])) {
            
            $_SESSION['flash'][$category] = [];
            
        }
        
        array_push($_SESSION['flash'][$category], $value);
        
    }
    
    public function getValue($key, $erase = false) {
        
        $result = null;
        
        if(isset($_SESSION[$key])) {
            
            $result = $_SESSION[$key];
            
            if($erase) {
            
                $_SESSION[$key] = Null;
            
            }
            
        } else {
            
            debug("La clé ".$key." n'existe pas dans la session actuelle");
            
        }
        
        
        
        return $result;
        
    }
    
    
}