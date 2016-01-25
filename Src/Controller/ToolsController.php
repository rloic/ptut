<?php

namespace Root\Src\Controller;

/**
 * Controller de la modification des outils
 */
class ToolsController extends AppController {
    
    //Peut être appelé depuis l'url
    public static $isCallable = true;
    
    public static function render($params = []) {
        
        $user = AppController::getUser();
        
        if(!$user) {
            
            AppController::setMsg('warning', "La zone demandée n'est pas autorisé pour les personnes non inscrites.");
            AppController::redirect('index');
        }
        
        $algorithms = \Root\Src\Model\AlgorithmModel::loadFunctionByUser($user->getId());
        $structures = \Root\Src\Model\StructureModel::loadStructureByUser($user->getId());
        
        $translationOfC = \Root\Src\Model\TranslationModel::loadTranslationByLanguage('c');
        $translationOfJava = \Root\Src\Model\TranslationModel::loadTranslationByLanguage('java');
        $translationOfJavascript = \Root\Src\Model\TranslationModel::loadTranslationByLanguage('javascript');
        $translationOfPhp = \Root\Src\Model\TranslationModel::loadTranslationByLanguage('php');
        $translationOfPython = \Root\Src\Model\TranslationModel::loadTranslationByLanguage('python');
        
        parent::getHeader();
        self::call('Render',
            ['algorithms' => $algorithms,
             'structures' => $structures,
              'translations' => ['c' => $translationOfC,
                                 'java' => $translationOfJava,
                                 'javascript' => $translationOfJavascript,
                                 'php' => $translationOfPhp,
                                 'python' => $translationOfPython]]);
        parent::getFooter();
    }    
    
    /**
     * Méthode de suppression d'une fonction/traduction
     * @param type $params
     */
    public static function delete($params = []) {
        
        $id = false;
        
        if(isset($params[0]) && isset($params[1])) {
            
            $type = $params[0];
            $id = $params[1];
            
        }
        
        $user = CodeController::getUser();
        
        if($type == 'structure') {
            
            if($id && $user) {
                
                $structure = \Root\Src\Model\StructureModel::loadStructureById($id);
                if($structure->getId() != Null) {
                    
                    if($structure->getOwnerId() != $user->getId()) {
                        
                        AppController::setMsg('error', "La structure n'appartient pas à votre compte. Vous ne pouvez pas la modifier.");
                        
                    } else {
                        
                        $translation = new \Root\Src\Model\TranslationModel();
                        $translation->setLayoutId($structure->getId());
                        
                        if(!$translation->delete()) {
                            
                            AppController::setMsg("error", "Une erreur est survenue lors de la suppression d'une des traductions.");
                            
                        }
                        
                        if(!$structure->delete()) {
                            
                            AppController::setMsg("error", "Une erreur est survenue lors de la suppression de la structure de traduction.");
                           
                        } else {
                            
                            AppController::setMsg('success', "La structure de traduction a bien été supprimée");
                            
                        }
                        
                        
                    }
                    
                } else {
                    
                    AppController::setMsg("warning", "La structure n'existe pas ou a déjà été supprimée");
                    
                }
                
            }
            
        } else if ($type == 'function') {
            
           
            if($id && $user) {
            $function = \Root\Src\Model\AlgorithmModel::loadFunctionById($id);
            if($function) {

                if($function->getOwnerId() == $user->getId()) { 

                    if($function->delete()) {
                        
                        AppController::setMsg("success", "La fonction a bien été supprimée.");
                        
                    } else {
                        AppController::setMsg("error", "Un problème est survenu lors de la suppression. Veuillez reessayer plus tard.");
                    }
                    

                } else {
                    
                    AppController::setMsg("error", "La fonction n'appartient pas à votre compte, vous ne pouvez pas la supprimer");
                    
                }
                
            } else {
                
                AppController::setMsg("warning", "La fonction n'existe pas ou a déjà été supprimée.");
                
            }
            
            } else {
            
            AppController::setMsg("warning", "Vous ne pouvez pas supprimer la ressource demandée.");
            
            }
        
        }
        
        
        
        self::render();
    }
}
