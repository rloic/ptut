<?php

/**
 * Classe de chargement dynamique des classes
 */
class Loader {
    
   
    static function register() {
        spl_autoload_register(array(__CLASS__, 'load'));
    }
    
    static public function load($class) {
        if(strpos($class, "Root\\") === 0) {
        
        $dir = $_SERVER['DOCUMENT_ROOT'];
        $class = str_replace("Root\\", '/PTUT/', $class);
        $class = str_replace('\\', '/', $class);
        //var_dump($dir.''.$class.'.php');
        require $dir.''.$class.'.php';
        
        }

    }
    
}

function debug($variable) {
    
    if(DISPLAY_ERROR) {
        ?><pre>
        <?php var_dump($variable); ?>
        </pre>
        <?php
        
    }
    
}

function dd($variable) {
    
    if(DISPLAY_ERROR) {
        ?><pre><?php var_dump($variable); die() ?></pre><?php
    }
    
}
