<?php

namespace Root\Src\Model;

class AlgorithmModel extends DefaultModel{
    
    private $_id;
    private $_name;
    private $_ownerId;
    private $_content;
    private $_date;
    private $_label;
    private $_type;
    
    const PUBLIC_USER = 12;
    
    public function __construct() {
        
    }
    
    public function getId() {
        
        return $this->_id;
        
    }
    
    public function getName() {
        
        return $this->_name;
        
    }
    
    public function getOwnerId() {
        
        return $this->_ownerId;
        
    }
    
    public function getContent() {
        
        return $this->_content;
        
    }
    
    public function getDate() {
        
        return $this->_date;
        
    }
    
    public function getLabel() {
        
        return $this->_label;
        
    }
    
    public function getType() {
        
        return $this->_type;
        
    }
    
    public function setId($id) {
        
        $this->_id = $id;
        
    }
    
    public function setName($name) {
        
        $this->_name = $name;
        
    }
    
    public function setOwnerId($ownerId) {
        
        $this->_ownerId = $ownerId;
        
    }
    
    public function setContent($content) {
        
        $this->_content = $content;
        
    }
    
    public function setDate($date) {
        
        $this->_date = $date;
        
    }
    
    public function setType($type) {
        
        $this->_type = $type;
        
    }
    
    public function setLabel($label) {
        
        $this->_label = $label;
        
    }
    
    public static function loadFunctionByUser($userId) {
        
        $result = [];
        
        $statement = ConnectionModel::getConnection()->query('Select * from function where ownerId = :ownerId order by name', 
            ['ownerId' => $userId]);
        
        $i = 0;
        
        while($i < \sizeof($statement) && $statement) {
            $newAlgorithm = new AlgorithmModel();
            $newAlgorithm->hydrate($statement[$i]);
            array_push($result, $newAlgorithm);
            $i += 1;
        }
        
        return $result;
        
    }
    
    public static function loadFunctionById($id) {
        
        $result = false;
        
        $statement = ConnectionModel::getConnection()->query('Select * from function where id = :id', 
            ['id' => $id]);
        
        if($statement) {
            
            $result = new AlgorithmModel();
            $result->hydrate($statement[0]);
            
        }
        
        return $result;
        
    }
    
    public static function loadPublicFunction() {
        
        $result = [];
        
        $statement = ConnectionModel::getConnection()->query('Select * from library join function on functionId = id order by name');
        
        $i = 0;
        
        while($i < \sizeof($statement) && $statement) {
            
            $newAlgo = new AlgorithmModel();
            $newAlgo->hydrate($statement[$i]);
            
            array_push($result, $newAlgo);
            $i += 1;
        }
        
        return $result;
        
    }
    
    public function record() {
        
       // $date = date('Y-m-d H:i:s', time());
        
        if($this->_id == '') {
        
            $statement = ConnectionModel::getConnection()->query('Insert into function values ("", :name, :ownerId, :content, NOW(), :label, :type)',
                    ['name' => $this->_name,
                     'content' => $this->_content,
                    'ownerId' => $this->_ownerId,
                    'label' => $this->_label,
                    'type' => $this->_type]);
        
        } else {
            
            
            $statement = ConnectionModel::getConnection()->query('Update function set name = :name, content = :content, date = NOW(), label = :label, type = :type where id =:id', 
                    ['name' => $this->_name,
                     'content' => $this->_content,
                     'label' => $this->_label,
                     'type' => $this->_type,
                     'id' => $this->_id]);
            
        }
        
        return $statement;
        
    }
    
    public function delete() {
        
        return ConnectionModel::getConnection()->query('Delete from function where id = :id',
                ['id' => $this->_id]);
        
    }
    
}