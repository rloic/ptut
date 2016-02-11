<?php

namespace Root\Src\Model;

/**
 * Description of BackupModel
 *
 * @author Rouquette Loïc
 */
class BackupModel extends DefaultModel{
 
    private $_functionId;
    private $_date;
    private $_versionId;
    private $_content;
    private $_label;
    private $_type;
    
    public function __construct() {
        
    }
    
    function getFunctionId() {
        return $this->_functionId;
    }

    function getDate() {
        return $this->_date;
    }

    function getVersionId() {
        return $this->_versionId;
    }

    function getContent() {
        return $this->_content;
    }

    function getLabel() {
        return $this->_label;
    }

    function getType() {
        return $this->_type;
    }

    function setFunctionId($_functionId) {
        $this->_functionId = $_functionId;
    }

    function setDate($_date) {
        $this->_date = $_date;
    }

    function setVersionId($_versionId) {
        $this->_versionId = $_versionId;
    }

    function setContent($_content) {
        $this->_content = $_content;
    }

    function setLabel($_label) {
        $this->_label = $_label;
    }

    function setType($_type) {
        $this->_type = $_type;
    }

    /**
     * Enregistre le backup sur la base de donnée
     * @return boolean True si l'enregistrement a été effectué, false sinon
     */
    public function record() {
        
        $statement = ConnectionModel::getConnection()->query('Insert into backup values (:functionId, NOW(), :versionId, :content, :label, :type)',
                    [
                        
                        'functionId' => $this->_functionId,
                        'versionId' => $this->_versionId,
                        'content' => $this->_content,
                        'label' => $this->_label,
                        'type' => $this->_type
                        
                    ]);
        
        return $statement;
        
    }
    
    public static function loadByFunctionId($id) {
        
        $result = [];
        
        $cursor = ConnectionModel::getConnection()->query('Select * From backup where functionId = :id order by versionId desc', [
            
                        'id' => $id
            
        ]);

        $i = 0;
                
        while($i < \sizeof($cursor) && $cursor) {
            
            $newBackup = new BackupModel();
            $newBackup->hydrate($cursor[$i]);
            
            array_push($result, $newBackup);
            $i += 1;
        }
        
        return $result;
        
    }
    
    public static function loadByKey($functionId, $versionId) {
        
        $result = [];
        
        $cursor = ConnectionModel::getConnection()->query("Select * From bakcup where functionId = :functionId and versionId = :versionId", [
            
            'functionId' => $this->_functionId,
            'versionId' => $this->_versionId
            
        ]);
        
        $i = 0;
        
        while($i < \sizeof($cursor) && $cursor) {
            
            $newBackup = new BackupModel();
            $newBackup->hydrate($cursor[$i]);
            
            array_push($result, $newBackup);
            $i += 1;
        }
        
        return $result;
        
        
    }
    
    public function update() {
        
        $statement = ConnectionModel::getConnection()->query('Update backup set content = :content, date = NOW(),'
                . ' label = :label, type = :type where functionId = :functionId and versionId = :versionId',[
                    
                    'content' => $this->_content,
                    'label' => $this->_label,
                    'type' => $this->_type,
                    'functionId' => $this->_functionId,
                    'versionId' => $this->_versionId
                    
                ]);
        
        return $statement;
        
    }
    
}
