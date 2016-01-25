<?php

namespace Root\Src\Controller;

class AccountController extends AppController {
    
    public static $isCallable = true;
    
    public static function render($params = []) {
        
        $user = AppController::getUser();
        
        if(!$user) {
            
            AppController::setMsg("warning", "Vous devez être connecté pour avoir accès à cette zone.");
            AppController::redirect("index");
            
        }
                
        if(isset($_POST['action'])) {
            
            self::update();
            $user = AppController::getUser();
            
        }
        
        parent::render([
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar()
            
        ]);
        
    }
    
    public static function update() {
        
        if(isset($_POST['oldPassword'])) {
            
            $validPassword = AppController::getUser();
            $validPassword->setPassword($_POST['oldPassword']);
            $validPassword = $validPassword->exist();
            
            if(!$validPassword) {
                
                AppController::setMsg("warning", "Le mot de passe saisit n'est pas correct.");
                
            }
            
            if($_POST['newPassword'] != $_POST['passwordConfirmation']) {
                
                AppController::setMsg("warning", "Les deux mots de passes ne sont pas les mêmes");
                
            }
            
            if(!AppController::hasError()) {
                
                $user = AppController::getUser();
                $user->setPassword($_POST['newPassword']);
                $user->updatePassword();
                
            }
            
        }
        
        $user = AppController::getUser();
        
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setAvatar('');
        
        $user->update();
        
        
        
        
    }
    
}
