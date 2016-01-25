<?php

namespace Root\Src\Library;

class Translator {
   
public static function translate($pseudoCode, $language, $structures = []) {
        
        $result = $pseudoCode;
        $translations = \Root\Src\Model\TranslationModel::loadTranslationByLanguage($language);
        
        $publicStructures = \Root\Src\Model\StructureModel::loadStructureByUser(\Root\Src\Model\AlgorithmModel::PUBLIC_USER);
        foreach($publicStructures as $publicStructure) {
            
            if(!in_array($publicStructure, $structures)) {
                array_push($structures, $publicStructure);
            }
            
        }
        
        foreach($structures as $structure) {
            
           
            if(isset($translations[$structure->getId()])) {
                
                $result = preg_replace(self::interpret($structure->getCode()), $translations[$structure->getId()]->getCode(), $result);
         
            } else {
                
                $result = preg_replace(self::interpret($structure->getCode()), 'ERR', $result);
                
            }
        }
        
        return $result;
         
    }
 
    public static function interpret($structureCode) {
        
        $patterns = array();
        $remplacements = array();
        $patterns[0] =      '#(\$motClef|\$motCl(é|e))#i';
        $remplacements[0] = '\s(algorithme|procedure|fonction|si|sinon|fin_?si|tant_?que|fin_?tant_?que|selon|autrement|'
                .           'fin_?selon|pour|fin_?pour|et|ou|mod|div)\s';

        $patterns[1] =      '#\$variable#i';
        $remplacements[1] = '(\w+) ?';

        $patterns[2] =      '#\$op(é|e)rateur#i';
        $remplacements[2] = '(\+|\-|\/|\*|\sdiv\s|\smod\s)';

        $patterns[3]=       '#\$tout#i';
        $remplacements[3]=  '(.*)';

        $patterns[4] =      '#\$entier#i';
        $remplacements[4]=  '(-?[0-9]+)';

        $patterns[5]=       '#\$reel#';
        $remplacements[5]=  '[\-]?[0-9]+(\.[0-9]+)?';

        $patterns[6] =      '#\$caract(e|è)re#';
        $remplacements[6]=  "(\'\w\')";

        $patterns[7]=       '#\$cha(i|î)ne#';
        $remplacements[7]=  '\"(.*)\"';

        $patterns[8]=       '#\$bool(é|e)en#';
        $remplacements[8]=  '(vrai|faux|true|false)';

        $patterns[9]=       '#\$type#';
        $remplacements[9]=  '\s(entier|r(é|e)el|caract(e|è)re|cha(i|î)ne|bool(é|e)en)\s';

        $patterns[10]=      '#\$relation#';
        $remplacements[10]= '(==|\<|\>|\<=|\>=|\!=)';

        $patterns[11]=      '#\$logique#';
        $remplacements[12]=      '\s(et|ou|ouex|non)\s';



        $layout = preg_replace($patterns, $remplacements, $structureCode);
        $layout = '#'.$layout.'#iU';
        
        return $layout;
        
    }
    
    public static function layout($code, $python = false) {
        $code .=" \n ";
        $c = explode("\n", $code);
        $indentLvl = 1;
        $result = '';
        
        if(!$python) {
            
            $result .= "{\n";
            
        } else {
            
            $result .= ":\n";
            
        }
        
        foreach($c as &$line) {
            
            // Supprime les espaces en début de ligne
            $line = preg_replace('#^(\s+)#',"", $line);
            
            // Supprime les doubles espaces
            $line = preg_replace('#(\s+)#'," ", $line);
            
            
            //Diminution l'indentation
            if(preg_match('#\[\/indent\]#', $line)) {
                $line = preg_replace('#\[\/indent\]#', '', $line);
                if($indentLvl > 1) { $indentLvl -= 1; }
            }
            
            for($i = 0; $i < $indentLvl; $i++) {
                $line = preg_replace('#^(.*)#', '   $1', $line);
            }
            
            //Augmentation de l'indentation
            if(preg_match('#\[indent\]#', $line)) {
            $line = preg_replace('#\[indent\]#', '', $line);
            $indentLvl += 1;
            }
            
            //Efface les lignes vide
            $line = preg_replace("#^(\s+)$#", '', $line);
            
            //Ajoute les ; en fin de ligne si le langage != python
            if(!$python) {
                $line = preg_replace("#([^\{|\}|\;]) $#", '$1;', $line);
            }
            if(!($line == ';' || $line == '')) {
                $result .= $line."\n";
            }
            
        }
        
        if(!$python) {
            
            $result .= "}";
            
        }
        
        return $result;
    }
     
    
    public static function testTranslation($pseudoCode, $language, $structure, $translation) {
        
        $result = preg_replace(self::interpret($structure), $translation, $pseudoCode);
        
        return (self::translate($result, $language));
         
    }
    
    public static function getMainHeader($language) {
        
        if($language == 'c') {
            
            return 'int main (int argc, char *argv[]) ';
            
        } else if ($language == 'java') {
            
            return 'public static void main (String[] args) ';
            
        } else if ($language == 'javascript') {
            
            return 'function main() ';
            
        } else if ($language == 'python') {
            
            return "if __name__ == '__main__' ";
            
        } else {//php
            
            return "function main() ";
            
        }
        
    }
    
    public static function getFunctionHeader($language, $functionType) {
        
        $type = self::translate($functionType.' ', $language);
        
        if($language == 'c') {
            
            return $type;
            
        } else if ($language == 'python') {
            
            return 'def ';
            
        } else if ($language == 'java') {
            
            return 'public '.$type;
            
        } else {
            
            return 'function ';
            
        }
        
    }
    
    
}
