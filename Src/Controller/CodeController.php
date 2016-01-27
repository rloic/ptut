<?php

namespace Root\Src\Controller;

/**
 * Controlleur de la traduction
 */
class CodeController extends AppController {
    
    // Peut être appelé depuis l'url
    public static $isCallable = true;
    
    public static function render($params = []) {
        
               
        $method = false;
        $activeFunction = false;
       
        
        if(isset($_POST['translate'])) {
            $method = 'translate';
        }
        
        if(isset($_POST['new'])) {
            $method = 'erase';
        }
        
        if(isset($_POST['open'])) {
            $method = 'open';
        }
        
        if(isset($_POST['save'])) {
            $method = 'save';
        }
        
        if(isset($_POST['backup'])) {
            $method = 'backup';
        }
        
        if(isset($_POST['share'])) {
            $method = 'share';
        }
        
        if(isset($_POST['askForHelp'])) {
            $method = 'askForHelp';
        }
        
        if($method) {
            
            self::$method();
            die();
            
        }
        
        
        $id = NULL;
        $pseudoCode = '';        
        
        if(isset($params[0])) {
            
            $id = $params[0];
            
        }
        
        $language = 'php';
        
        $user = AppController::getUser();
        
        $privateFunctions = [];
        $userStructures = [];
        $selectedUserStructures = [];
        
        if(isset($_POST['selectedStructures'])) {
            
            $selectedUserStructures = $_POST['selectedStructures'];
            
        } else {
            
            if($user) {
                
                $structures = \Root\Src\Model\StructureModel::loadStructureByUser($user->getId());
                foreach($structures as $structure) {
                    
                    array_push($selectedUserStructures, $structure->getId());
                    
                }
                
                
            }            
            
        }
        
        if(isset($_POST['id'])) {
            
            $id = $_POST['id'];
            
        }
        
        if($user) {
            
            $privateFunctions = \Root\Src\Model\AlgorithmModel::loadFunctionByUser($user->getId());
            $userStructures = \Root\Src\Model\StructureModel::loadStructureByUser($user->getId());
            
            if($id) {
                $function = \Root\Src\Model\AlgorithmModel::loadFunctionById($id);
                if($function) {

                    if($function->getOwnerId() != $user->getId()) { 

                        $pseudoCode = ''; 
                        $id=''; 
                        $_POST['id'] = NULL; 

                    } else {
                        
                        if($pseudoCode == "") {
                            $pseudoCode = $function->getContent();
                            $activeFunction = $function;
                        }
                    }
                }
            }
        }
        
        $publicFunctions = [];
        
        $allPublicFunctions = \Root\Src\Model\AlgorithmModel::loadPublicFunction();
        
        foreach($allPublicFunctions as $currentFunction) {
            
            if(!in_array($currentFunction, $privateFunctions)) {
                
                array_push($publicFunctions, $currentFunction);
                
            }
            
        }
        
        $selectedPrivateFunctions = [];
        
        if(isset($_POST['privateFunctions'])) {
            
            $selectedPrivateFunctions = $_POST['privateFunctions'];
            
        }
        
        $selectedPublicFunctions = [];
        
        if(isset($_POST['publicFunctions'])) {
            
            $selectedPublicFunctions = $_POST['publicFunctions'];
            
        }
        
         
        if(isset($_POST['language'])) {
            $language = $_POST['language'];
        }
        
        if(isset($_POST['pseudoCode'])) {
            $pseudoCode = $_POST['pseudoCode'];       
        }
        
        $helpMsgs = \Root\Src\Model\MailModel::getMsgBySubject($id);
        
        parent::render(['id' => $id,
                        'selectedLanguage' => $language,
                        'pseudoCode' => $pseudoCode,
                        'user' => $user,
                        'privateFunctions' => $privateFunctions,
                        'publicFunctions' => $publicFunctions,
                        'selectedPrivateFunctions' => $selectedPrivateFunctions,
                        'selectedPublicFunctions' => $selectedPublicFunctions,
                        'userStructures' => $userStructures,
                        'selectedUserStructures' => $selectedUserStructures,
                        'activeFunction' => $activeFunction,
                        'helpMsgs' => $helpMsgs]);
        
        
    }
    
    /**
     * Rendu de la page de traduction
     */
    public static function translate() {
        
        $language = $_POST['language'];
        $pseudoCode = "";
        $privateFunctionIds = [];
        $selectedUserStructures = [];
        
        if(isset($_POST['selectedUserStructures'])) {
            
            $structureIds = $_POST['selectedUserStructures'];
            foreach($structureIds as $id) {
                
                array_push($selectedUserStructures, \Root\Src\Model\StructureModel::loadStructureById($id));
                
            }
            
        }
        
        if(isset($_POST['privateFunctions'])) {
            
            $privateFunctionIds = $_POST['privateFunctions'];
            
        }
        
        $privateFunctions = [];
        
        foreach($privateFunctionIds as $id) {
            
            $currentFunction = \Root\Src\Model\AlgorithmModel::loadFunctionById($id);
            if($currentFunction) {
                array_push($privateFunctions, $currentFunction);
            }
            
        }
        
        $publicFunctionIds = [];
        
        if(isset($_POST['publicFunctions'])) {
            
            $publicFunctionIds = $_POST['publicFunctions'];
            
        }
        
        $publicFunctions = [];
       
        foreach($publicFunctionIds as $id) {
            
            $currentFunction = \Root\Src\Model\AlgorithmModel::loadFunctionById($id);
            array_push($publicFunctions, $currentFunction);

        }
        
        
        if(isset($_POST['pseudoCode'])) {
            
            $pseudoCode = $_POST['pseudoCode'];
            
        }
        
        $id = $_POST['id'];
        
        parent::getHeader();
        self::call('translate',
            ['id' => $id,
             'selectedLanguage' => $language,
             'pseudoCode' => htmlentities($pseudoCode),
             'privateFunctions' => $privateFunctions,
             'publicFunctions' => $publicFunctions,
             'selectedStructures' => $selectedUserStructures]);
        parent::getFooter();
        
    }
    
    /**
     * Fonction de sauvegarde
     */
    public static function save() {
        
        $id = $_POST['idToSave'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $content = $_POST['pseudoCode'];
        //$date
        $label = $_POST['label'];
        
        $algorithm = new \Root\Src\Model\AlgorithmModel();
        $algorithm->setId($id);
        $algorithm->setName($name);
        $algorithm->setType($type);
        $algorithm->setContent($content);
        $algorithm->setLabel($label);
        $algorithm->setOwnerId(AppController::getUser()->getId());
        $execution = $algorithm->record();
        if($execution && $id == '') {
            
            AppController::setMsg("success", "La fonction a bien été ajoutée à la base");
            
        } else if ($execution) {
            
            AppController::setMsg("success", "La fonction a bien été mise à jour");
            
        } else {
            
            AppController::setMsg("error", "Une erreur lors de la connexion à la base s'est déroulée.");
        }
        
        unset($_POST['save']);
        
        if($id == '') {
            
            $id = \Root\Src\Model\ConnectionModel::getConnection()->lastInsertId();
            
        }
        
        self::open([$id]);
        
        
    }
    
    /**
     * Fonction de chargement d'un algorithme
     * @param type 
     */
    public static function open($params = []) {
        
        if(isset($params[0])) {
            $_POST['id'] = $params[0];
        }
        
        unset($_POST['open']);
        
        self::render();
        
    }
    
    /**
     * Fonction de création d'un nouvel algorithme
     */
    public static function erase() {
        
        if(isset($_POST['new'])) { unset($_POST['new']); }
        
        if(isset($_POST['id'])) { unset($_POST['id']); }
        
        if(isset($_POST['pseudoCode'])) { unset($_POST['pseudoCode']); }
        
        self::render();
        
    }
    
    /**
     * 
     */
    public static function askForHelp() {
        
        debug($_POST);
        
        if(isset($_POST['id']) && isset($_POST['helpMsg']) && AppController::getUser()) {
            
            $msg = new \Root\Src\Model\MailModel();
            $msg->setContent($_POST['helpMsg']);
            $msg->setSubjectId($_POST['id']);
            $msg->setOwnerId(AppController::getUser()->getId());
            debug($msg);
            $msg->send();
            
            AppController::setMsg("success", "Votre demande d'aide a bien été publiée.");
            
        } else {
            
            AppController::setMsg("warning", "Aucun message n'a été saisi, vous devez en saisir un pour obtenir de l'aide");
            
        }
        
        unset($_POST['askForHelp']);
        
        self::render();
        
    }
}