<?php

namespace Root\Src\Model;

/**
 * Classe modèle standard, implémentation de la fonction d'hydratation
 */
class DefaultModel {
    
    public function hydrate($donnees) {
        
        $donnees = get_object_vars($donnees);
        
	foreach ($donnees as $key => $value) {
            
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe
            if (method_exists($this, $method))
            {
                // On appelle le setter

                $this->$method($value);
            } else {
                
                
                
            }
        }
    }
    
}
