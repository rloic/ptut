<?php

namespace Root\Src\Model;

/**
 * Classe modèle des objets structures de traductions
 */
class StructureModel extends DefaultModel{
    
    private $_id;
    private $_ownerId;
    private $_code;
    
    const ROOT_ID = 12;
    
    public function __construct($ownerId, $code) {
        
        $this->_ownerId = $ownerId;
        $this->_code = $code;
        
    }
    
    public function getId() {
        
        return $this->_id;
        
    }
    
    public function getOwnerId() {
        
        return $this->_ownerId;
        
    }
    
    public function getCode() {
        
        return $this->_code;
        
    }
    
    public function setId($id) {
        
        $this->_id = $id;
        
    }
    
    public function setOwnerId($ownerId) {
        
        $this->_ownerId = $ownerId;
        
    }
    
    public function setCode($code) {
        
        $this->_code = $code;
        
    }
    
    /**
     * Renvoie la liste des structures de traduction d'un utilisateur
     * @param type $userId l'id de l'utilisateur
     * @return array
     */
    public static function loadStructureByUser($userId) {
        
        $result = [];
        
        $statementResult = ConnectionModel::getConnection()->query('Select * From layout where ownerId = :ownerId',
            ['ownerId' => $userId]);
        
        $i = 0;
        
        while($i < \sizeof($statementResult) && $statementResult) {
            
            $newStruct = new StructureModel('','');
            $newStruct->hydrate($statementResult[$i]);
            
            array_push($result, $newStruct);
            
            $i += 1;
        }
        
        return $result;
        
    }
    
    /**
     * Renvoie la structure avec l'id $id
     * @param type $id
     * @return \Root\Src\Model\StructureModel
     */
    public static function loadStructureById($id) {
        
        $result = new StructureModel("","");
        
        $statementResult = ConnectionModel::getConnection()->query('Select * from layout where id = :id',
                ['id' => $id]);
        
        if($statementResult) {
            
            $result->hydrate($statementResult[0]);
            
        }
        
        return $result;
        
    }
    
    /**
     * Crée la structure dans la base de données si elle n'existe pas, sinon la met
     * à jour
     * @return type
     */
    public function record() {
        
        if($this->_id == '') {
            
            return ConnectionModel::getConnection()->query('Insert into layout values (:id, :ownerId, :code)',
                    ['id' => $this->_id,
                     'ownerId' => $this->_ownerId,
                     'code' => $this->_code]);
            
        } else {
            
            return ConnectionModel::getConnection()->query('Update layout set code = :code where id = :id and ownerId = :ownerId',
                    ['id' => $this->_id,
                     'ownerId' => $this->_ownerId,
                     'code' => $this->_code]);
        }
        
        
        
    }
    
    /**
     * Supprime la structure de la base de données
     * @return type
     */
    public function delete() {
        
        return ConnectionModel::getConnection()->query('Delete from layout where id = :id',
                ['id' => $this->_id]);
        
    }
    
}
