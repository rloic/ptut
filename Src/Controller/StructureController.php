<?php

namespace Root\Src\Controller;

/**
 * Controller de la page de creation/modification de structure
 */
class StructureController extends AppController {
    
    // Peut être appelé depuis l'url
    public static $isCallable = true;
    
    public static function render($params = []) {
        
        isset($_POST['idStructure']) ? $idStructure = $_POST['idStructure'] : $idStructure = '';
        isset($_POST['structure']) ? $structure = $_POST['structure'] : $structure = '';
        isset($_POST['translationToC']) ? $translationToC = $_POST['translationToC'] : $translationToC = '';
        isset($_POST['translationToJava']) ? $translationToJava = $_POST['translationToJava'] : $translationToJava = '';
        isset($_POST['translationToJavascript']) ? $translationToJavascript = $_POST['translationToJavascript'] : $translationToJavascript = '';
        isset($_POST['translationToPython']) ? $translationToPython = $_POST['translationToPython'] : $translationToPython = '';
        isset($_POST['translationToPhp']) ? $translationToPhp = $_POST['translationToPhp'] : $translationToPhp = '';
        isset($_POST['pseudoCodeToTest']) ? $pseudoCodeToTest = $_POST['pseudoCodeToTest'] : $pseudoCodeToTest = '';
        isset($_POST['test']) ? $hadToTranslate = true : $hadToTranslate = false;
        
        $user = AppController::getUser();
        if(!$user) {
            
            AppController::setMsg("warning", "Vous devez être connecté pour avoir accès à cette partie du site");
            AppController::redirect('index');
            
        }
        
        if(isset($_POST['erase'])) {
            unset($_POST['erase']);
            self::erase();
            die();
            
        }
        
        if(isset($_POST['save'])) {
            unset($_POST['save']);
            self::save(['idStructure' => $idStructure]);
            die();
            
        }
        
        parent::render([
                'idStructure' => $idStructure,
                'structure' => $structure,
                'pseudoCodeToTest' => $pseudoCodeToTest,
                'translationToC' => $translationToC,
                'translationToJava' => $translationToJava,
                'translationToJavascript' => $translationToJavascript,
                'translationToPhp' => $translationToPhp,
                'translationToPython' => $translationToPython,
                'hadToTranslate' => $hadToTranslate]);
    }
    
    /**
     * Méthode de sauvegarde
     * @param type $params
     */
    public static function save($params = []) {
        
        isset($params['idStructure']) ? $idStructure = $params['idStructure'] : $idStructure = '';
        
        $user = AppController::getUser();
        if($user) {
        
            if(!(isset($_POST['structure']) && $_POST['structure'] != '')) {
                
                AppController::setMsg("warning", "La champs structure doit être rempli.");
                
            }
            
            if($idStructure != '') {
                $test = \Root\Src\Model\StructureModel::loadStructureById($idStructure);
                
                if($test->getOwnerId() != $user->getId()) {
                
                AppController::setMsg("error", "Vous n'êtes pas propriétaire de cette structure vous ne pouvez pas la modifier");
                
                }
            }
                
            
            
            if(!AppController::hasError())  {
                
                $structure = new \Root\Src\Model\StructureModel($user->getId(), $_POST['structure']);
                $structure->setId($idStructure);
                $structure->record();
                
                if($idStructure == '') {
                    $idStructure = \Root\Src\Model\ConnectionModel::getConnection()->lastInsertId();
                }
                
                $translation = new \Root\Src\Model\TranslationModel();
                $translation->setLayoutId($idStructure);
                
                $translation->setLanguage('c');
                $translation->setCode($_POST['translationToC']);
                $translation->record();
                
                $translation->setLanguage('java');
                $translation->setCode($_POST['translationToJava']);
                $translation->record();
                
                $translation->setLanguage('javascript');
                $translation->setCode($_POST['translationToJavascript']);
                $translation->record();
                
                $translation->setLanguage('python');
                $translation->setCode($_POST['translationToPython']);
                $translation->record();
                
                $translation->setLanguage('php');
                $translation->setCode($_POST['translationToPhp']);
                $translation->record();
                self::load([$idStructure]);
                die();
            }
                
                
                
        }
        
        
        self::render();
        
        
    }
    
    /**
     * Méthode de chargement d'une structure
     * @param type $params
     */
    public static function load($params = []) {
        
        if(isset($params[0])){
            
            $_POST['idStructure'] = $params[0];
            $structure = \Root\Src\Model\StructureModel::loadStructureById($_POST['idStructure']);
            
            $user = AppController::getUser();
            if($structure && $user && $structure->getOwnerId() == $user->getId()) {
                
                $_POST['idStructure'] = $structure->getId();
                $_POST['structure'] = $structure->getCode();
                
                $tranlsationToC = \Root\Src\Model\TranslationModel::loadTranslationByIdAndLanguage($structure->getId(), 'c');
                if($tranlsationToC) {
                    $_POST['translationToC'] = $tranlsationToC->getCode();
                    
                }
                
                $tranlsationToPhp = \Root\Src\Model\TranslationModel::loadTranslationByIdAndLanguage($structure->getId(), 'php');
                if($tranlsationToPhp) {
                    $_POST['translationToPhp'] = $tranlsationToPhp->getCode();
                    
                }
                
                $tranlsationToJava = \Root\Src\Model\TranslationModel::loadTranslationByIdAndLanguage($structure->getId(), 'java');
                if($tranlsationToJava) {
                    $_POST['translationToJava'] = $tranlsationToJava->getCode();
                    
                }
                
                $tranlsationToJavascript = \Root\Src\Model\TranslationModel::loadTranslationByIdAndLanguage($structure->getId(), 'javascript');
                if($tranlsationToJavascript) {
                    $_POST['translationToJavascript'] = $tranlsationToJavascript->getCode();
                    
                }
                
                $tranlsationToPython = \Root\Src\Model\TranslationModel::loadTranslationByIdAndLanguage($structure->getId(), 'python');
                if($tranlsationToPython) {
                    $_POST['translationToPython'] = $tranlsationToPython->getCode();
                    
                } else {
                    
                    unset($_POST['idStructure']);
                    
                }
                
            }
        }
        
        self::render();
        
    }
    
    /**
     * Méthode d'effacement des champs (nouvelle structure)
     */
    public static function erase() {
        
        unset($_POST);
        
        self::render();
        
    }
}