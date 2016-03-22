<?php

namespace Root\Src\Model;

/**
 * Description of MailModel
 *
 * @author Rouquette Loïc
 */
class MailModel extends DefaultModel{
    
    private $_id;
    private $_ownerId;
    private $_date;
    private $_content;
    private $_subjectId;
    
    public static $SUBJECT_HOME = "home";
    public static $SUBJECT_NEWS = "news";
   
    public function __construct() {
        
    }
    
    function getId() {
        return $this->_id;
    }

    function getOwnerId() {
        return $this->_ownerId;
    }

    function getDate() {
        return $this->_date;
    }

    function getContent() {
        return $this->_content;
    }

    function getSubjectId() {
        return $this->_subjectId;
    }

    function setId($_id) {
        $this->_id = $_id;
    }

    function setOwnerId($_ownerId) {
        $this->_ownerId = $_ownerId;
    }

    function setDate($_date) {
        $this->_date = $_date;
    }

    function setContent($_content) {
        $this->_content = $_content;
    }

    function setSubjectId($_subjectId) {
        $this->_subjectId = $_subjectId;
    }

    public function send(array $userList = []) {
        
        \Root\Src\Model\ConnectionModel::getConnection()->query("Insert into mail values (:id, :ownerId, NOW(), :content, :subjectId)",
                ["id" => "",
                 "ownerId" => $this->_ownerId,
                 "content" => $this->_content,
                 "subjectId" => $this->_subjectId]);
        
        $this->_id = \Root\Src\Model\ConnectionModel::getConnection()->lastInsertId();

        $message = 'Reponse de ' . $this->_ownerId;

        foreach($userList as $user) {
            
            \Root\Src\Model\ConnectionModel::getConnection()->query("Insert into link values (:id,:messageId, :user)", 
            ["id" => "",
             "messageId" => $this->_id,
             "user" => $user]);

            \Root\Src\Model\ConnectionModel::getConnection()->query("Insert into notifications values (:idNotif,:nomNotif, :contenuNotif, :typeNotif, :expediteurNotif, :idUser)",
                ["idNotif" => "",
                    "nomNotif" => "Nouveau Message",
                    "contenuNotif" => $message,
                    "typeNotif" => "message",
                    "expediteurNotif" => $this->_ownerId,
                    "idUser" => $user
                ]);
            
        }
        
    }

    public static function getMsgBySubject($subjectId) {
        
        $result = [];
        
        $cursor = \Root\Src\Model\ConnectionModel::getConnection()->query("Select * From mail where subjectId = :subjectId", [
            "subjectId" => $subjectId
        ]);
        
        $i = 0;
        
        while($i < \sizeof($cursor) && $cursor) {
            $current = new MailModel();
            $current->hydrate($cursor[$i]);
            array_push($result, $current);
            $i += 1;
        }

        return $result;
        
    }
    
    
}
