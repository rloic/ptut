<?php

namespace Root\Src\Model;

class UserModel extends DefaultModel{
    
    private $_id;
    private $_name;
    private $_password;
    private $_email;
    private $_avatar;
    private $_points;
    private $_confirmToken;
    private $_isConfirmed;
    private $_resetToken;
    private $_resetDate;
    
    public function getId() {
        
        return $this->_id;
        
    }
    
    public function getConfirmToken() {
        
        return $this->_confirmToken;
        
    }
    
    public function getEmail() {
        return $this->_email;
    }
    
    public function getPoints() {
        return $this->_points;
    }
    
    public function getPassword() {
        return $this->_password;
    }
    
    public function getAvatar() {
        return $this->_avatar;
    }
    
    public function getIsConfirmed() {
        return $this->_isConfirmed;
    }
    
    public function getResetToken() {
        return $this->_resetToken;
    }
    
    public function getResetDate() {
        return $this->_resetDate;
    }    
    
    public function getName() {
        return $this->_name;
    }
    public function setId($id) {
        
        $this->_id = $id;
        
    }
    
    public function setName($name) {
        
        $this->_name = $name;
        
    }
    
    public function setPassword($password) {
        
        $this->_password = $password;
        
    }
    
    public function setEmail($email) {
        
        $this->_email = $email;
        
    }
    
    public function setAvatar($avatar) {
        
        $this->_avatar = $avatar;
        
    }
    
    public function setPoints($points) {
        
        $this->_points = $points;
        
    }
    
    public function setConfirmToken($confirmToken) {
        
        $this->_confirmToken = $confirmToken;
        
    }
    
    public function setIsConfirmed($isConfirmed) {
        
        $this->_isConfirmed = $isConfirmed;
        
    }
    
    public function setResetToken($resetToken) {
        
        $this->_resetToken = $resetToken;
        
    }
    
    public function setResetDate($resetDate) {
        
        $this->_resetDate = $resetDate;
        
    }
    
    public function __construct($name, $password) {
        $this->_name = $name;
        $this->_password = $password;
    }
    
    public function exist($needConfirmation = true) {
        if($needConfirmation) {
            $confirmation = 1;
        } else {
            $confirmation = 0;
        }
    $statement = \Root\Src\Model\ConnectionModel::getConnection()->query('Select * From user Where :name = name and :password = password and isConfirmed = :confirmation', 
        ['name' => $this->_name,
         'password' => \Root\Src\Library\Encoder::encode($this->_password),
         'confirmation' => $confirmation]);
    
    
    if($statement != Null) {
        
        $result = new UserModel('','');
        $result->hydrate($statement[0]);
        
        
    } else {
        
        $result = false;
        
    }
    
    return $result;
        
    }
    
    public function canUse($field) {
        $objectField = '_'.$field;
        $value = $this->$objectField;
        debug($value);
        $statement = ConnectionModel::getConnection()->query('Select * from user where '.$field.' = :value', 
                ['value' => $value]);
        
        if($statement == Null) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
        
    }
    
    public function record() {
        
        $confirmToken = \Root\Src\Library\Encoder::generateToken();
        $password = \Root\Src\Library\Encoder::encode($this->_password);
        
        $statement = ConnectionModel::getConnection()->query('Insert into user values("", :name, :password, :email, :avatar, 0, :confirmToken, 1, NULL,NULL)', 
                ['name' => $this->_name,
                 'avatar' => $this->_avatar,
                 'password' => $password,
                 'email' => $this->_email,
                 'confirmToken' => $confirmToken]);
        
        if($statement) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    public function update() {
    
        $statement = ConnectionModel::getConnection()->query('Update user set name = :name, email = :email, avatar = :avatar where id = :id', 
                ['id' => $this->_id,
                 'name' => $this->_name,
                 'avatar' => $this->_avatar,
                 'email' => $this->_email]);
        
        return $statement;
        
    }
    
    public function updatePassword() {
        $password = \Root\Src\Library\Encoder::encode($this->_password);
        $statement = ConnectionModel::getConnection()->query('Update user set password = :password where id = :id', 
                ['id' => $this->_id,
                 'password' => $password]);
        
        return $statement;
        
    }
    
    
    public function activate() {
        
        $statement = ConnectionModel::getConnection()->query('Select * From user where id = :id and confirmToken = :confirmToken',
            ['id' => $this->_id,
             'confirmToken' => $this->_confirmToken]);
        
        if($statement) {
            
            $activate = ConnectionModel::getConnection()->query('Update user set isConfirmed = 1 where id = :id', 
                ['id' => $this->_id]);
            
            if($activate) {
                
                $user = ConnectionModel::getConnection()->query('Select * From user where id = :id', 
                    ['id' => $this->_id]);
                
                $result = new UserModel('','');
                $result->hydrate($user[0]);
                
                return $result;
                
            }
            
        }
        
        return false;
        
}
    
    
}

