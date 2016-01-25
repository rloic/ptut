<?php

namespace Root\Src\Library;

/**
 * Classe de gestion de la session Php
 */
class Session {
    
    private $_session;
    public static $instance;
    const ERASE = true;
    
    private function __construct() {
        $this->_session = session_start();
    }
    
    /**
     * Renvoie la session courante
     * @return type
     */
    public static function getSession() {
        
        if(self::$instance == Null) {
            
            self::$instance = new Session();
            
        }
        
        return self::$instance;
        
    }
    
    /**
     * Détruit la session courante
     */
    public static function destroy() {
        
        self::$instance = Null;
        \session_destroy();
        
    }
    
    /**
     * Enregistre une valeur dans le champs $key
     * @param type $key
     * @param type $value
     */
    public function setValue($key, $value) {
        
        if(!isset($_SESSION['key'])) {
            
            $_SESSION[$key] = [];
            
        }
        
        array_push($_SESSION[$key], $value);
        
    }
    
    /**
     * Enregistre un message avec une catégorie et une valeur
     * @param type $category
     * @param type $value
     */
    public function setMsg($category, $value) {
        
        if(!isset($_SESSION['flash'][$category])) {
            
            $_SESSION['flash'][$category] = [];
            
        }
        
        array_push($_SESSION['flash'][$category], $value);
        
    }
    
    /**
     * Renvoie les valeurs du champ $key
     * @param type $key
     * @param type $erase
     * @return type
     */
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