<?php

namespace Root\Src\Controller;

class AppController {
    
    // Ne peut pas être appelé depuis l'url
    public static $isCallable = false;
    
    /**
     * Ajoute le fichier en tête à la réponse html
     */
    static public function getHeader() {

        $baseFolder = '';
        
        $urlLevel = count(explode('/', $_SERVER['REQUEST_URI'])) - 3;
        for($i = 0; $i < $urlLevel; $i++) {  
        
            $baseFolder .= '../';
            
        }
        
        $userMsgs = AppController::getMsg();
        if($userMsgs == Null) {
            
            $userMsgs = [];
            
        }
        
        $user = AppController::getUser();
        
        require 'Src/View/HeaderView.php';
        
    }
    
    /**
     * Ajoute le fichier pied de page à la réponse html
     */
    static public function getFooter() {
        
        require 'Src/View/FooterView.php';
        
    }
    
    /**
     * Appelle une vue et lui fournit une liste de paramètres
     * @param type $view
     * @param type $params
     */
    static public function call($view, $params = []) {
        
        $view = ucfirst($view);
        $class= substr(\get_called_class(),0,-10).'View/';
        $class= ucfirst(substr($class, 5));
        $class = str_replace("\\Controller\\", '\\View\\', $class);
        $class = str_replace('\\', '/', $class);
        $class = $class.$view.'.php';
        
        
        //debug($class);
        
        if(file_exists($class)) {
            
            require($class);
            
        } else {
            
            debug('Le fichier '.$class.' n\'existe pas');
            
        }
        
    }
    
    
    /**
     * Fonction de rendu html par défaut
     * @param type $params
     */
    static public function render($params = []) {
        
        AppController::getHeader();
        $class= substr(\get_called_class(),0,-10).'View/';
        $class= ucfirst(substr($class, 5));
        $class = str_replace("\\Controller\\", '\\View\\', $class);
        $class = str_replace('\\', '/', $class);
        $class = $class.'Render.php';
        
        
        if(file_exists($class)) {
            
            require($class);
            
        } else {
            
            debug('Le fichier '.$class.' n\'existe pas');
            
        }
        
        AppController::getFooter();
        
    }
    
    /**
     * Charge la session active
     * @return type
     */
    static public function loadSession() {
        
        return \Root\Src\Library\Session::getSession();
        
    }
    
    /**
     * Enregistre un utilisateur en session
     * @param type $user
     */
    static public function setUser($user) {
        
        \Root\Src\Library\Session::getSession()->setValue('user', $user);
        
    }
    
    /**
     * Récupère l'utilisateur de la session courante
     * @return type
     */
    static public function getUser() {
        
        return \Root\Src\Library\Session::getSession()->getValue('user')[0];
        
    }
    
    /**
     * Détruit l'utilisateur de la session courante
     * @return type
     */
    static public function destroyUser() {
        
        return \Root\Src\Library\Session::getSession()->getValue('user', \Root\Src\Library\Session::ERASE);
        \session_distroy();
        
    }
    
    /**
     * Récupère ET supprime tous les messages de la session
     * @return type
     */
    static public function getMsg() {
        
        return \Root\Src\Library\Session::getSession()->getValue('flash', \Root\Src\Library\Session::ERASE);
        
    }
    
    /**
     * Enregistre un message dans une catégorie de la session
     * @param type $category
     * @param type $msg
     */
    static public function setMsg($category, $msg) {
        
        \Root\Src\Library\Session::getSession()->setMsg($category, $msg);
        
    }
    
    /**
     * Vérifie si le champs message contient des erreurs
     * @return boolean true si vrai, false sinon
     */
    static public function hasError() {
        
        if(\Root\Src\Library\Session::getSession()->getValue('flash')) {
            
            return true;
            
        }
        
        return false;
        
    }
    
    /**
     * Renvoie la page sur le lien $link
     * @param type $link
     */
    static public function redirect($link) {
        ?>
        <script>

            document.location.href="<?php echo ROOT_FOLDER.$link; ?>"

        </script>
        
        <?php
        die();
    }
}