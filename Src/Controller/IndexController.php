<?php

namespace Root\Src\Controller;

class IndexController extends AppController {
    // Peut être appelé depuis l'url
    public static $isCallable = true;
    
    public static function render($params = []) {
        
        $helpList = \Root\Src\Model\AlgorithmModel::getMostRecentHelped();
        $helpMsg = [];
        
        foreach($helpList as $help) {
            
            $userId = \Root\Src\Model\MailModel::getMsgBySubject($help->getId())[0]->getOwnerId(); 
            $helpMsg[$help->getId()]["owner"] = \Root\Src\Model\UserModel::getUser($userId)->getName();
            $helpMsg[$help->getId()]["content"] = \Root\Src\Model\MailModel::getMsgBySubject($help->getId())[0]->getContent(); 
            
        }
        
        $news = [];
        $sharing = [];        
        
        parent::render([
            
            "helpList" => $helpList,
            "helpMsg" => $helpMsg,
            "news" => $news,
            "sharing" => $sharing
            
        ]);
        
    }
    
    public static function help($page = 0) {
        
        self::render(["helpPage" => $page]);
        
    }
    
     /**
     * 
     */
    public static function giveHelp() {
                
        debug($_POST);
        
        if(isset($_POST['msgHelpedId']) && isset($_POST['helpMsg']) && AppController::getUser()) {
            
            $msg = new \Root\Src\Model\MailModel();
            $msg->setContent($_POST['helpMsg']);
            $msg->setSubjectId($_POST['msgHelpedId']);
            $msg->setOwnerId(AppController::getUser()->getId());
            debug($msg);
            $msg->send();
            
            AppController::setMsg("success", "Votre aide a bien été publiée.");
            
        } else {
            
            if(!AppController::getUser()) {
                AppController::setMsg("warning", "Vous devez être connecté pour poster des messages d'aide");
            } else {
                AppController::setMsg("warning", "Aucun message n'a été saisi, vous devez en saisir un pour obtenir de l'aide");
            }
            
        }
        
        self::render();
        
    }
    
}