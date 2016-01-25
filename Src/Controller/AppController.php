<?php

namespace Root\Src\Controller;

class AppController {
    
    public static $isCallable = false;
    
    
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
    
    static public function getFooter() {
        
        require 'Src/View/FooterView.php';
        
    }
    
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
    
    static public function loadSession() {
        
        return \Root\Src\Library\Session::getSession();
        
    }
    
    static public function setUser($user) {
        
        \Root\Src\Library\Session::getSession()->setValue('user', $user);
        
    }
    
    static public function getUser() {
        
        return \Root\Src\Library\Session::getSession()->getValue('user')[0];
        
    }
    
    static public function destroyUser() {
        
        return \Root\Src\Library\Session::getSession()->getValue('user', \Root\Src\Library\Session::ERASE);
        \session_distroy();
        
    }
    
    static public function getMsg() {
        
        return \Root\Src\Library\Session::getSession()->getValue('flash', \Root\Src\Library\Session::ERASE);
        
    }
    
    static public function setMsg($category, $msg) {
        
        \Root\Src\Library\Session::getSession()->setMsg($category, $msg);
        
    }
    
    static public function hasError() {
        
        if(\Root\Src\Library\Session::getSession()->getValue('flash')) {
            
            return true;
            
        }
        
        return false;
        
    }
    
    static public function redirect($link) {
        ?>
        <script>

            document.location.href="<?php echo ROOT_FOLDER.$link; ?>"

        </script>
        
        <?php
        die();
    }
}