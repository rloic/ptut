<div class="container">

    <h3> Tutoriel</h3>
    
    <h4>Utilisation du Traducteur</h4>
    <p>Le traducteur permet de traduire du pseudo-code en différents langages de programmations :</p>
    <ul>
        <li>C</li>
        <li>Javascript</li>
        <li>Java</li>
        <li>Python</li>
        <li>Php</li>
    </ul>

    <p> Il est également possible d'exécuter le code directement via une console virtuelle.</p>
    
    <p>Les structures de pseudo code sont indiquées dans le tutoriel ci-dessous.</p>
    
    
<h4>La déclaration de variables</h4>
    
    <p>Pour déclarer une variable, il faut tout d'abord déclarer son type, puis le nom de la variable précédé d'un dollar.</p>
    <h6>Modèle : </h6>
        <p class="tuto code">type $variable = valeur</p>
    <p>Il y a différents types de variables :</p>
    <ul>
        <li>caractère</li>
        <li>chaîne</li>
        <li>entier</li>
        <li>réel</li>
        <li>booléen</li>
    </ul>
    <p>Les valeurs peuvent prendre différente forme, en effet, elles peuvent être une valeur précise donnée directement par vous, une autre variable ou encore le résultat d'une fonction.</p>
    <h6>Exemple :</h6>
    <p class="tuto code">caractère maLettre = 'o'</p>
    <p>La variable malettre de type caractère aura la valeur 'o'.</p>
    <p class="tuto code">caractère maLettreCopie = maLettre</p>
    <p>La variable malettre de type caractère aura la même valeur que la variable maLettre.</p>
    <p class="tuto code">chaîne maChaîne = concat("Vous avez tapé :", maLettreCopie)</p>
    <p>La variable maChaîne de type chaîne aura la valeur : Vous avez tapé:o</p>
    
    <p class="tuto warning"> Attention, lors des opérations entre les variables, il est important que les deux variables soient de même type.</p>
     
 
<h4>Les structures conditionelles</h4>
 
    <p>Ce sont des instructions qui sont exécutées que sous certaines conditions qu'il faudra spécifier entre le Si et le Alors.</p>   
    <h5>Les conditions simples</h5>
    <h6>Modèle :</h6>
    <p class="tuto code">Si $condition Alors<br />[instruction à effectué]<br />FinSi</p>
    <h6>Exemple :</h6>
    <p class="tuto code">Si maVariable < 0 Alors<br />afficher(entier maVariable)<br />afficher(" est négatif")<br />FinSi</p>
    <p>Les instructions entre SI et FINSI ne sont exécutés que si les conditions sont remplies.</p>
    <h5>Les conditions successives</h5>
    
     <h6>Modèle :</h6>
    <p class="tuto code">
        Si $condition Alors<br />
        ...code...<br />
        Sinon Si $condition Alors<br />
        ...code...<br />
        Sinon $condition<br />
        ...code...<br />
        FinSi
    </p>
    
    
    <h6>Exemple</h6>
    <p class="tuto code">
        Si nombre < 0 Alors <br />
        afficher("votre nombre est trop petit)<br />
        Sinon si nombre < 10 <br />
        afficher("le nombre est inférieur à 10<br />
        Sinon <br />
        afficher("Le nombre est supérieur ou égal à 10")<br />
        FinSi
    </p>
   
    <h5>Les conditions multiples</h5>
    <p>Il se peut qu'il faut plusieurs conditions afin d'effectuer les instructions suivantes.</p>
    <h6>Exemple :</h6>
    <p class="tuto code">
        Si (maNote < 0) ou (maNote > 20) Alors<br />
        afficher("La note n'est pas correcte")<br />
        FinSi
    </p>
    <p class="tuto warning">Attention : les parenthèses on une importance pour la priorité des conditions. [(condition 1 et condition2) ou condition 3] n'a pas la même signification que [condition1 et (condition2 ou condition 3)].</p>
    <p>Les deux opérateurs de conditions sont "et", "ou" et "non"</p>
    <h6>Exemple</h6>
    <p class="tuto code">
        Entier nombre = 4<br />
        Si (nombre < 2) ou (estPair(nombre)) Alors<br />
        Afficher("vrai")<br />
        Sinon<br />
        Afficher("faux")<br />
        FinSin
    </p>
    <p> Résultat :</p>
    <p class="tuto result">vrai</p>
    
    <p class="tuto code">
        Entier nombre = 4<br />
        Si (nombre < 2) et (estPair(nombre)) Alors<br />
        Afficher("vrai")<br />
        Sinon<br />
        Afficher("faux")<br />
        FinSin
    </p>
    <p> Résultat :</p>
    <p class="tuto result">faux</p>
    
    <p class="tuto code">
        Entier nombre = 4<br />
        Si non(nombre < 2) et (estPair(nombre)) Alors<br />
        Afficher("vrai")<br />
        Sinon<br />
        Afficher("faux")<br />
        FinSin
    </p>
    <p> Résultat :</p>
    <p class="tuto result">vrai</p>
    
    <p>1 renvoie vrai car au moins un des conditions est vraie, ici estPair(nombre).</p>
    <p>2 renvoie faux car il faut que les deux conditions soient vraies, or nombre < 2 est faux.</p>
    <p>3 renvoie vrai, car non(nombre < 2) et équivalent à (nombre >= 2), or 4 >= 2 et 4 est pair.</p>
 
    <h5>La structure Selon</h5>
    <p> Cette structure est utilisé en cas de nombreuses conditions successives</p>
    <h6>Modèle :</h6>
    <p class="tuto code">
        Selon ($variable) Alors<br />
            Cas $condition: <br />[instructions]<br />
            Sortir<br />
            Cas $condition:<br /> [instructions]<br />
            Sortir<br />
            Defaut:<br /> [instructions]<br />
        FinSelon
    </p>
    <h6>Exemple :</h6>
    <p class="tuto code">
        Selon (maVariable) Alors<br />
            Cas (maVariable == 1): <br />[instructions]<br />
            Sortir<br />
            Cas (maVariable == 2):<br /> [instructions]<br />
            Sortir<br />
            Defaut:<br /> [instructions]<br />
        FinSelon
    </p>
    <p>Le code ci-dessus est équivalent à : </p>
    <p class="tuto code">
        Si maVariable == 1 Alors<br />
        [instructions]<br />
        Sinon si maVariable == 2 Alors<br />
        [instructions]<br />
        Sinon<br />
        [instructions]<br />
        FinSi
    </p>
    <p class="tuto warning">Les injonctions sortir ne sont pas obligatoires, elles permettent d'indiquer au programme qu'il ne doit pas vérifier les autres conditions.</p>
    <h6>Exemple :</h6>
    <p class="tuto code">
        Entier age = 17<br />
        Selon (age) Alors<br />
        Cas (age < 12):<br />
        afficher("Vous êtes un enfant")<br />
        Cas (age < 18):<br />
        afficher("Vous êtes un adolescent")<br />
        Cas (age < 99):
        afficher("Vous êtes un adulte")<br />
        Defaut:
        afficher("Trop vieux")<br />
        FinSelon
        
    </p>
    <p> Résultat :</p>
    <p class="tuto result">
        Vous êtes un adolescent<br />
        Vous êtes un adulte<br />
        Trop vieux<br />
    </p>
    <p> Alors que le code suivant :</p>
    <p class="tuto code">
        Entier age = 17<br />
        Selon (age) Alors<br />
        Cas (age < 12):<br />
        afficher("Vous êtes un enfant")<br />
        Sortir<br />
        Cas (age < 18):<br />
        afficher("Vous êtes un adolescent")<br />
        Sortir<br />
        Cas (age < 99):
        afficher("Vous êtes un adulte")<br />
        Sortir<br />
        Defaut:
        afficher("Trop vieux")<br />
        FinSelon
        
    </p>
    <p> Résultat :</p>
    <p class="tuto result">
        Vous êtes un adolescent
    </p>
<h4>Les boucles</h4>

    <p>Il existe plusieurs types de boucles :</p>
    <ul>
        <li>Les boucles "TantQue"</li>
        <li>Les boucles "Pour"</li>
    </ul>
    <h5>Tant Que</h5>
    <p>Les boucles "TantQue" exécutent le code tant que la condition est vérifiée.</p>
    <h6>Modèle :</h6>
    <p class="tuto code"> TantQue $condition Faire<br />
        ...code...<br />
        FinTantQue
    </p>
    
    <h6>Exemple :</h6>
    <p class="code">
        entier nombre = 0<br />
        TantQue nombre<100 Alors<br />
        Afficher(entier nombre)<br />
        nombre=nombre+1<br />
        FinTantQue
    </p>
    <p>Tant que la variable nombre sera inférieure à 100, elle sera affichée et incrémentée de 1.</p>
    <p class="tuto warning">Il est important de faire attention à ne pas créer des boucles infinis avec les TantQue.</p>
 
    <h5>Pour</h5>
    <p> Les boucles Pour sont utilisées pour un parcourir un intervalle de données.</p>
    <h6>Modèle :</h6>
    <p class="tuto code">
        Pour $variable dans [$elementLePlusPetit, $elementLePlusGrand] Faire<br />
        ...code...<br />
        FinPour
    </p>
    
    <p> Pour parcours un intervalle dans le sens contraire (du plus grand au plus petit) on utilisera :</p>
    <p class="tuto code">
         Pour $variable dans [$elementLePlusPetit, $elementLePlusGrand] inverse Faire<br />
        ...code...<br />
        FinPour
    </p>
    
    <h6>Exemple :</h6>
    <p class="tuto code">
        Pour x dans [0,5] Faire<br />
        Afficher(entier x)<br />
        FinPour
    </p>
    <p> Résultat :</p>
    <p class="tuto result">
        0<br />
        1<br />
        2<br />
        3<br />
        4<br />
        5<br />   
    </p>
    
    <p class="tuto code">
        Pour x dans [0,5] inverse Faire<br />
        Afficher(entier x)<br />
        FinPour
    </p>
    <p> Résultat :</p>
    <p class="tuto result">
        5<br />
        4<br />
        3<br />
        2<br />
        1<br />
        0<br />   
    </p>
 
<h4>Les tableaux</h4>
 
    <p>Un tableau est un type particulier : il est composé de variables d'un même type.On peut le parcourir à l'aide d'un indice qui correspond à chaque case du tableau.On peut le parcourir à l'aide de la boucle "Pour" que l'on a vu précédemment.Pour créer un tableau avec plusieurs lignes, il faut un nouvel indice afin de parcourir chaque colonne, puis chaque ligne.</p>
    <p style='margin-left:30px'>Modèle 1 : $type $variable[$entier] = $elements</p>
    <p style='margin-left:30px'>Modèle 2 : $type $variable[$entier][$entier] = $elements1 $elements2</p>
 
 
<h5>Création et appel de fonctions et procédures</h5>
     
<h4> Créer ses propres structures</h4>

<p>Les structures fonctionnent sur le principe de remplacement de chaîne.</p>
<h6>Exemple :</h6>
<p> On utilisera la structure de traduction de déclaration de variable </p>
<p> Structure </p>
<p class="tuto code">
    caractère $variable = $caractère
</p>
<p> Traduction en C </p>
<p class="tuto code">
    char $1 = $2
</p>
<p>Chaque mot clé commençant par $ sera capturé et enregistré en tant que $ordre. Ici le mot à la place de $variable sera capturé et restitué en tant que $1.</p>
<p>Dans notre exemple </p>
<p class="tuto code">
    caractère nom = 'c'<br />
</p>
<p> nom est enregistré par $variable en tant que $1, car il est le premier mot cké</p>
<p> c est enregistré par $caractère en tant que $2, car il apparait en second</p>

<p> La liste des mots clé est :</p>
<ul class="tuto code">
    <li>$variable : capture un nom de variabel</li>
    <li>$constante : capture un nom de constante </li>
    <li>$type : capture un type (entier, réel, caractère, chaîne, nul et booléen</li>
    <li>$condition : capture un ensemble de variables, opérateurs et valeurs</li>
    <li>$opérateur : capture un opérateur (+, -,/ ,* ,mod, ,div)</li>
    <li>$relation : capture un opérateur de relation (<, <=, >, >=, !=, ==)</li>
    <li>$logique : capture un opérateur logique (et, ou, ouex, non)</li>
</ul>

</div>