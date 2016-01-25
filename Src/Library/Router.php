<?php

namespace Root\Src\Library;

class Router {
    
    static public function rout() {
        
        $rout = [];
        $url = $_SERVER['REQUEST_URI'];
   
        $url = substr($url, 6);
        $url = rtrim($url, '/');
        if($url) {
            
            $rout = explode('/', $url);
            
        }
        debug('Routage');
        debug($rout);
        
        if(!isset($rout[0]) || (isset($rout[0]) && $rout[0] == 'index.php')) {
           
            $rout = array('index');
            
        }
        
        if(\sizeof($rout) > 0 && !file_exists('Src/Controller/'.ucfirst($rout[0]).'Controller.php')) {
            
            $rout = [];
            
            
        } else {
            
            $controller = '\\Root\\Src\\Controller\\'.ucfirst($rout[0]).'Controller';
            
        }
        
        if(\sizeof($rout) >= 3) {
            
            $i = 2;
            $max = \sizeof($rout);
            
            $params = [];
            
            for($i = 2; $i < $max; $i++) {
                
                array_push($params, $rout[$i]);
                
            }
            
            if (method_exists($controller, $rout[1])) {
                
                if($controller::$isCallable) {
                $controller::$rout[1]($params);
                } else {
                    debug($controller.'n\'est pas accessible par routage.');
                    \Root\Src\Controller\PageDefaultController::render();
                }
                
            } else {
                
                debug($controller.'::'.$rout[1].'() La méthode appelée n\'existe pas');
                $controller::render();
                
            }
            
            
        } else if(\sizeof($rout) == 2) {
            
            if (method_exists($controller, $rout[1])) {
                
                $controller::$rout[1]();
                
            } else {
                
                debug($controller.'::'.$rout[1].'() La méthode appelée n\'existe pas');
                $controller::render();
                
            }
                
            
        } else if(\sizeof($rout) == 1) {
            
            if($controller::$isCallable) {
                $controller::render();
            } else {
                debug($controller.'n\'est pas accessible par routage.');
                \Root\Src\Controller\PageDefaultController::render();
            }
            
        } else {
            
            \Root\Src\Controller\PageDefaultController::render();
            
        }
        
    }
    
}

