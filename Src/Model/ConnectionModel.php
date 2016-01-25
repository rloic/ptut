<?php

namespace Root\Src\Model;

/**
 * Etablit la connexion avec la base de données
 */
class ConnectionModel {
    
    private $_db;
    private static $_instance;
    
    /**
     * Renvoie la connexion à la base de données
     * @return type ConnectionModel
     */
    public static function getConnection() {
        
        if(self::$_instance == NULL) {
            
            self::$_instance = new connectionModel();
            
        }
        return self::$_instance;
        
    }   
    
    /**
     * Constructeur
     */
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
    
    /**
     * Exécute une requête préparée
     * @param type $statementla requête à exécuter
     * @param type $params les paramètres de la requête
     * @return boolean, array renvoie faux si le résultat de la requête est vide
     * sinon renvoie un tableau d'objet 
     */
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
    
    /**
     * Renvoie le dernier id inséré
     * @param string $field le nom du champs dont on veut récupérer le numéro
     * @return int le dernier id inséré
     */
    public function lastInsertId($field = 'id') {
        
        return $this->_db->lastInsertId($field = 'id');
        
    }
    
}