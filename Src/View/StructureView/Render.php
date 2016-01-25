<div class="container">
    
    <h1>Edition des structures</h1>
    
</div>  
<div class="container">
        <h3>Ma structure</h3>
    </div>
<form action="<?php echo ROOT_FOLDER; ?>structure" method="POST">
    <input type="hidden" name="idStructure" value="<?php echo $params['idStructure']; ?>" />
    <table>
        
        <thead>
            
            <tr>
                <th>Structure de Traduction</td>
                <th>Php</th>
                <th>Java</th>
                <th>Javascript</th>
                <th>Python</th>
                <th>C</th>
            </tr>
            
        </thead>
        <tbody>
            <tr>
                
                <td class="input-field td-equal-6">
                    <textarea name="structure" class="materialize-textarea right-border"><?php echo $params['structure']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <textarea name="translationToPhp" class="materialize-textarea right-border"><?php echo $params['translationToPhp']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <textarea name="translationToJava" class="materialize-textarea right-border"><?php echo $params['translationToJava']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <textarea name="translationToJavascript" class="materialize-textarea right-border"><?php echo $params['translationToJavascript']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <textarea name="translationToPython" class="materialize-textarea right-border"><?php echo $params['translationToPython']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <textarea name="translationToC" class="materialize-textarea"><?php echo $params['translationToC']; ?></textarea>
                </td>
                
            </tr>
            
        </tbody>
        
    </table>
    <div class="container">
        <h3>Essayez-ici</h3>
    </div>
    <table>
        
        <thead>
            
            <tr>
                <th>Pseudo Code</td>
                <th>Php</th>
                <th>Java</th>
                <th>Javascript</th>
                <th>Python</th>
                <th>C</th>
            </tr>
            
        </thead>
        <tbody>
            <tr>
                
                <td class="input-field td-equal-6">
                    <textarea name="pseudoCodeToTest" class="materialize-textarea"><?php echo $params['pseudoCodeToTest']; ?></textarea>
                </td>
                <td class="input-field td-equal-6">
                    <pre><code class="language-php"><?php if($params['hadToTranslate']) {
                        
                        echo \Root\Src\Library\Translator::layout(
                        \Root\Src\Library\Translator::testTranslation($params['pseudoCodeToTest'], 'php', $params['structure'], $params['translationToPhp']));
                        
                    } ?></code></pre>
                </td>
                <td class="input-field td-equal-6">
                    <pre><code class="language-java"><?php if($params['hadToTranslate']) {
                        
                        echo \Root\Src\Library\Translator::layout(
                        \Root\Src\Library\Translator::testTranslation($params['pseudoCodeToTest'], 'java', $params['structure'], $params['translationToJava']));
                        
                        } ?></code></pre>
                </td>
                <td class="input-field td-equal-6">
                     <pre><code class="language-javascript"><?php if($params['hadToTranslate']) {
                        
                        echo \Root\Src\Library\Translator::layout(
                        \Root\Src\Library\Translator::testTranslation($params['pseudoCodeToTest'], 'javascript', $params['structure'], $params['translationToJavascript']));
                        
                    } ?></code></pre>
                </td>
                <td class="input-field td-equal-6">
                    <pre><code class="language-python"><?php if($params['hadToTranslate']) {
                        
                        echo \Root\Src\Library\Translator::layout(
                        \Root\Src\Library\Translator::testTranslation($params['pseudoCodeToTest'], 'python', $params['structure'], $params['translationToPython']));
                        
                    } ?></code></pre>
                </td>
                <td class="input-field td-equal-6">
                    <pre><code class="language-c"><?php if($params['hadToTranslate']) {
                        
                        echo \Root\Src\Library\Translator::layout(
                        \Root\Src\Library\Translator::testTranslation($params['pseudoCodeToTest'], 'c', $params['structure'], $params['translationToC']));
                    
                    } ?></code></pre>
                </td>
                
            </tr>
            
        </tbody>
        
    </table>
    
  <button class="btn waves-effect waves-light" type="submit" name="erase" style="margin-left:15px;">Nouveau
    <i class="material-icons right">note_add</i>
  </button> 
    
    
  <button class="btn waves-effect waves-light" type="submit" name="save" style="margin-left:15px;">Enregistrer
    <i class="material-icons right">save</i>
  </button>
 
  <button class="btn waves-effect waves-light orange lighten-2" type="submit" name="test"  style="margin-left:15px;">Tester
    <i class="material-icons right">play_arrow</i>
  </button>
    
    
</form>
