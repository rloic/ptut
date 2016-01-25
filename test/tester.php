<?php

function interpret() {

    $structureTest = "\$fonction";
    $tradToC = " --$1-- ";
    $code = ' (10 < 20) ';

    $layout = [];

    $translation = [];

    $layout['function'] = '#\$fonction#';
    $translation['function'] = '(\w+\((([^()]*|(?R))*)\))';

    $layout['condition'] = '#\$condition#';
    $translation['condition'] = "\((([^()]*|(?R))*)\)";

    $layout['values'] = '#\$valeur#';
    $translation['values'] = "\$variable|\$reel|\$entier|\$fonction|\$caractere|\$chaine|\$tableau|\$booleen";

    $layout['constant'] = '#\$constante#';
    $translation['constant'] = '[ |\(|\[]([A-Z_]+[A-Z0-9]{1}[A-Z_0-9]+)[ |\)|\]]';

    $layout['variable'] = '#\$variable#';
    $translation['variable'] = '[ |\(|\[]([a-zA-Z_]+[a-zA-Z0-9]{1}[a-zA-Z_0-9]+)[ |\)|\]]';

    $layout['operator'] = '#\$operateur#';
    $translation['operator'] = "([+|-|\/|*]|mod(.*)|div(.*))";

    $layout['relation'] = '#\$relation#';
    $translation['relation'] = "(<=|==|<|>=|>|!=)";

    $layout['logical'] = '#\$logique#';
    $translation['logical'] = "(et|ou|non)";

    $layout['boolean'] = '#\$bool(é|e)en#';
    $translation['boolean'] = "(vrai|faux|true|false)";

    $layout['string'] = '#\$cha(î|i)ne#';
    $translation['string'] = '("(.*)")';

    $layout['float'] = '#\$r(é|e)el#';
    $translation['float'] = "([\-]?[0-9]+(\.[0-9]+)?)";

    $layout['integer'] = '#\$entier#';
    $translation['integer'] = "(-?[0-9]+)";

    $layout['char'] = '#\$caract(é|e|è)re#';
    $translation['char'] = "(\'\w\\')";

    $layout['array'] = '#\$tableau#';
    $translation['array'] = "(\[(([\w+(,\w)?]*|(?R))*)\])";

    foreach($layout as $key => $value) {

        $structureTest = preg_replace($value, $translation[$key], $structureTest);

    }

    echo($structureTest).'<br /><br />';
    echo preg_replace('#'.$structureTest.'#', $tradToC, $code);

}


interpret();

 ?>



/**
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

*/
