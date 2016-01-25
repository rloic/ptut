<?php

namespace Root\Src\Controller;

class ConnectionController extends AppController {
    
    public static $isCallable = true;
    
    public static function createAccount() {
       
        if(isset($_POST['action'])) {
            
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordConfirmation = $_POST['passwordConfirmation'];
            $avatar = ' ';
            if($_POST['avatar'] != '') {
                
                $avatar = $_POST['avatar'];
                
            }
            
            $user = new \Root\Src\Model\UserModel($name, $password);
            $user->setEmail($email);
            $user->setAvatar($avatar);
            
            if(AppController::getUser()) {
                
                AppController::setMsg('warning', 'Vous êtes déjà connecté. Veuillez vous déconnecter avant de créer un nouveau compte.');
                
            }
            
            if(!$user->canUse('name') || !$user->canUse('email')) {
                
                AppController::setMsg("warning", "Le nom d'utilisateur ou l'adresse mail est déjà utilisé.");
                
            }
            
            if($password != $passwordConfirmation) {
                
                AppController::setMsg("warning", "Les deux mots de passe ne sont pas les mêmes.");
                
            } else {
                
                $user->setPassword($password);
                
            }
            
            if(!AppController::hasError()) {
                
                if($user->record()) {
                    $user = $user->exist(true);
                    if($user) {
                        //self::sendMail($user);
                        AppController::setMsg("success", "Le compte a bien été crée.");
                        AppController::redirect("connection");
                    }
                
                } else {
                    
                    AppController::setMsg("error", "Une erreur s'est produite avec la connexion serveur. Veuillez recommencer plus tard.");
                    
                }
            }
            
            
        }
        
        parent::getHeader();
        self::call('createAccount');
        parent::getFooter();
        
    }
    
    public static function connect() {
        
        if(AppController::getUser() != Null) {
            
            AppController::setMsg("warning", "Vous êtes déjà connecté. Veuillez vous déconnecter pour changer de compte.");
            
        } else {

            $login = '';
            $password = '';

            if(isset($_POST['login']) && isset($_POST['password'])) {

                $login = $_POST['login'];
                $password = $_POST['password'];

            }

            
            $user = new \Root\Src\Model\UserModel($login, $password);
            $user = $user->exist();
            
          
            
            if($user) {

                AppController::setUser($user);
                AppController::setMsg("success" ,"Vous avez bien été connecté.");
                parent::redirect('index');
                
            } else {
                
                AppController::setMsg("warning" ,"Le mot de passe ou l'identifiant est incorrect.");
                self::render();
                
            }
            
                    
        }
    
        
    }
    
    public static function disconnect() {
        
        $user = AppController::destroyUser();
        if($user != Null) {
            AppController::setMsg("success", "Vous êtes maintenant déconnecté.");
        }
        self::render();
        
    }
    
    public static function confirmAccount($params = []) {
        
        $id = null;
        $confirmToken = null;
        
        if(isset($params[0]) && isset($params[1])) {
            $id = $params[0];
            $confirmToken = $params[1];
        }
        
        $user = new \Root\Src\Model\UserModel('','');
        $user->setId($id);
        $user->setConfirmToken($confirmToken);
        $validAccount = $user->activate();
        if($validAccount) {
            
            AppController::setMsg("success", "Votre compte a bien été validé.");
            AppController::setMsg("success", "Votre êtes maintenant connecté.");
            AppController::setUser($validAccount);
            
            
        } else {
            
            AppController::setMsg("warning", "Information du compte non valide.");
            
        }
        AppController::render();
        
    }
    
    public static function sendMail($user) {
        
          $message = "Bonjour veuillez confirmer votre inscription en cliquant sur le lient suivant :";
          $message .= "\n http://localhost/ptut/connection/confirmAccount/".$user->getId();
          $message .= "/".$user->getConfirmToken();

        $message = wordwrap($message, 70, "\r\n");
        
        return mail($user->getEmail(), 'EMail de confirmation', $message);
        
    }
    
}