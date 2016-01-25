<?php

namespace Root\Src\Model;

/**
 * Classe modèle des traductions
 */
class TranslationModel extends DefaultModel{
    
    private $_layoutId;
    private $_language;
    private $_code;
    
    public function __construct() {
        
    }
    
    public function getLayoutId() {
        
        return $this->_layoutId;
        
    }
    
    public function getLanguage() {
        
        return $this->_language;
        
    }
    
    public function getCode() {
        
        return $this->_code;
    
    }
    
    public function setLayoutId($layoutId) {
        
        $this->_layoutId = $layoutId;
        
    }
    
    public function setLanguage($language) {
        
        $this->_language = $language;
        
    }
    
    public function setCode($code) {
        
        $this->_code = $code;
        
    }
    
    /**
     * Renvoie la liste des traductions pour un langage
     * @param type $language
     * @return \Root\Src\Model\TranslationModel
     */
    public static function loadTranslationByLanguage($language) {
        
        $result = [];
        
        $resultStatement = ConnectionModel::getConnection()->query('Select * From translation where language = :language',
            ['language' => $language]);
        $i = 0;
        
        while($i < \sizeof($resultStatement)) {
            
            $newTranslation = new TranslationModel();
            $newTranslation->hydrate($resultStatement[$i]);
            
            $result[$newTranslation->getLayoutId()] = $newTranslation;
            
            $i += 1;
        }
        
        return $result;
        
    }
    
    /**
     * Renvoie la traduction pour un id de structure et un langage
     * @param type $id
     * @param type $language
     * @return \Root\Src\Model\TranslationModel
     */
    public static function loadTranslationByIdAndLanguage($id, $language) {
        
        $result = false;
        
        $statement = ConnectionModel::getConnection()->query('Select * from translation where layoutId = :id and language = :language',
                ['id' => $id,
                 'language' => $language]);
        if($statement) {
            
            $result = new TranslationModel();
            $result->hydrate($statement[0]);
            
        }
        
        return $result;
        
    }
    
    /**
     * Enregistre la traduction dans la base si elle n'existe pas, sinon la met à jour
     * @return type
     */
    public function record() {
        
        if(self::loadTranslationByIdAndLanguage($this->_layoutId, $this->_language)) {
            //Update
            
            return ConnectionModel::getConnection()->query('Update translation set code = :code where layoutId = :layoutId and language = :language',
                    ['layoutId' => $this->_layoutId,
                     'language' => $this->_language,
                     'code'  => $this->_code]);
            
            
        } else {
            //Nouveau
            return ConnectionModel::getConnection()->query('Insert into translation values(:layoutId, :language, :code)',
                    ['layoutId' => $this->_layoutId,
                     'language' => $this->_language,
                     'code'  => $this->_code]);
            
        }
        
        
    }
    
    /**
     * Supprime la traduction de la base de données
     * @return type
     */
    public function delete() {
        
        return ConnectionModel::getConnection()->query('Delete from translation where layoutId = :layoutId',
                ['layoutId' => $this->_layoutId]);
        
    }
    
}
