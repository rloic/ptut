<?php

namespace Root\Src\Library;

/**
 * Permet d'encoder les mots de passe
 */
class Encoder {
    
    /**
     * Fonction de génération de token aléatoire
     * @return type
     */
    public static function generateToken() {
        
        $alphabet = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789';
        $alphabet = str_repeat($alphabet, 255);
        $alphabet = str_shuffle($alphabet);
        return substr($alphabet, 0, 255);
        
    }
    
    /**
     * Encode un mot de passe
     * @param type $password le mot de passe à encoder
     * @return string le mot de passe encodé
     */
    static function encode($password) {
        $key = $password;
        $algorithm = \MCRYPT_RIJNDAEL_128;
        $mode = 'cbc';
        
         $keyHash = \md5($key);
         $key = \substr($keyHash, 0, \mcrypt_get_key_size($algorithm, $mode) );
         $iv  = \substr($keyHash, 0, \mcrypt_get_block_size($algorithm, $mode) );
         $data = \mcrypt_encrypt($algorithm, $key, $password, $mode, $iv);
         return \base64_encode($data);
    }
    
    /**
     * Décode le mot de passe avec la clé $key
     * @param type $password le mot de passe à décoder
     * @param type $key la clé de décodage
     * @return type la chaine décodée
     */
    static function decode($password, $key) {
        
        
        $keyHash = \md5($key);
        $algorithm = \MCRYPT_RIJNDAEL_128;
        $mode = 'cbc';
        
        $key = \substr($keyHash, 0, \mcrypt_get_key_size($algorithm, $mode) );
        $iv  = \substr($keyHash, 0, \mcrypt_get_block_size($algorithm, $mode) );
 
        $data = \base64_decode($password);
        $data = \mcrypt_decrypt($algorithm, $key, $data, $mode, $iv);
        
        return \rtrim($data);
    
    }
    
}
