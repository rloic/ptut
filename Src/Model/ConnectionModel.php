<?php

namespace Root\Src\Model;

class ConnectionModel {
    
    private $_db;
    private static $_instance;
    
    public static function getConnection() {
        
        if(self::$_instance == NULL) {
            
            self::$_instance = new connectionModel();
            
        }
        return self::$_instance;
        
    }   
    
    private function __construct() {
        $host=HOST_NAME; // ou sql.hebergeur.com
        $user=USER_NAME;      // ou login
        $password=PASSWORD;      // ou xxxxxx
        $dbname=DB_NAME;
        try {
            $this->_db = new \PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8',$user,$password);
            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }
    
    public function query($statement, $params = []) {
        
        $result = [];
        
        if($params == []) {
            
            $resultStatements = $this->_db->query($statement);
            
            if(\strtoupper(\substr($statement, 0, 6)) == 'SELECT') {
            
                while($data = $resultStatements->fetch(\PDO::FETCH_OBJ)) {

                    array_push($result, $data);

                }
                
            } else {
                
                $result = $resultStatements;
                
            }
            
            $resultStatements->closeCursor();
            
            
        } else {
            
            $prepareStatement = $this->_db->prepare($statement);
            $prepareStatement->execute($params);
            if(\strtoupper(\substr($statement, 0, 6)) == 'SELECT') {
            
                while($data = $prepareStatement->fetch(\PDO::FETCH_OBJ)) {

                    array_push($result, $data);

                }
                
            } else {
                
                $result = $prepareStatement;
                
            }
            $prepareStatement->closeCursor();
            
        }
        
        if($result == []) {
            
            return false;
            
        }
        return $result;
    }
    
    public function lastInsertId($field = 'id') {
        
        return $this->_db->lastInsertId($field = 'id');
        
    }
    
}