<form class="row" action="code" method="post">
   
    <div class="col l12 codeMenu">
        
        <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Nouveau
          <i class="material-icons left">note_add</i>
        </button> 

        <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Ouvrir
          <i class="material-icons left">description</i>
        </button>  

        <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Enregistrer
          <i class="material-icons left">save</i>
        </button>

        <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Restaurer
          <i class="material-icons left">restore</i>
        </button>

        <button class="btn waves-effect waves-idlight" type="submit" name="action" disabled="true">Partager
          <i class="material-icons left">call_split</i>
        </button>

        <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Demander de l'aide
          <i class="material-icons left">info_outline</i>
        </button>

          <button class="btn waves-effect waves-light" type="submit" name="action" disabled="true">Gérer mes structures
          <i class="material-icons left">settings</i>
        </button>
        
    </div>
    
    <div class="col l12 codeMenu" style="padding-top: 15px;margin-bottom: 20px">
        
        <input name="language" type="radio" id="php" <?php if ($params['selectedLanguage'] == "php") { ?> checked="checked" <?php } ?> value="php" disabled="true"/>
        <label for="php">Php</label>
        <input name="language" type="radio" id="java" <?php if ($params['selectedLanguage'] == "java") { ?> checked="checked" <?php } ?> value="java" disabled="true"/>
        <label for="java">Java</label>
        <input name="language" type="radio" id="javascript" <?php if ($params['selectedLanguage'] == "javascript") { ?> checked="checked" <?php } ?> value="javascript" disabled="true"/>
        <label for="javascript">Javascript</label>
        <input name="language" type="radio" id="python" <?php if ($params['selectedLanguage'] == "python") { ?> checked="checked" <?php } ?> value="python" disabled="true"/>
        <label for="python">Python</label>
        <input name="language" type="radio" id="C" <?php if ($params['selectedLanguage'] == "c") { ?> checked="checked" <?php } ?> value="c" disabled="true"/>
        <label for="C">C</label>
        <input name="language" type="radio" id="Executer" <?php if ($params['selectedLanguage'] == "executer") { ?> checked="checked" <?php } ?> value="executer" disabled="true"/>
        <label for="Executer">Executer</label>
        <input name="language" type="hidden" value="<?php echo $params['selectedLanguage']; ?>" />
        <input name="pseudoCode" type="hidden" value="<?php echo htmlspecialchars($params['pseudoCode']); ?>" />
    </div>
    
     <div class="col l10">
        <ul class="collapsible" data-collapsible="expendable">  
        <?php foreach($params['publicFunctions'] as $publicFunction) { ?>
            <input type="hidden" name="publicFunctions[]" value="<?php echo $publicFunction->getId(); ?>" />
            <li>
                <div class="collapsible-header"><i class="material-icons">code</i>
                    <?php echo nl2br($publicFunction->getName()); ?>
                </div>
                
                <div class="collapsible-body">
                    <table>
                        
                        <tr>
                            
                            <td class="pseudoCode">
                            <?php echo nl2br($publicFunction->getContent());?>    
                            </td>
                            <td>
                                <pre><code class="language-<?php echo $params['selectedLanguage']; ?>"><?php
                                echo \Root\Src\Library\Translator::getFunctionHeader($params['selectedLanguage'], $publicFunction->getType());
                                echo preg_replace("#(\s+)#", " ",\Root\Src\Library\Translator::translate($publicFunction->getName(), $params['selectedLanguage'], $params['selectedStructures']));
                                echo \Root\Src\Library\Translator::layout(\Root\Src\Library\Translator::translate($publicFunction->getContent(), $params['selectedLanguage'], $params['selectedStructures']), ($params['selectedLanguage']=='python'));  ?></code></pre>
                                
                            </td>
                        </tr>
                        
                    </table>
                    
                </div>
            </li>

        
        <?php } ?>
        <?php foreach($params['privateFunctions'] as $privateFunction) { ?>
            <input type="hidden" name="privateFunctions[]" value="<?php echo $privateFunction->getId(); ?>" />
            <li>
                <div class="collapsible-header"><i class="material-icons">code</i>
                    <?php echo nl2br($privateFunction->getName()); ?>
                </div>
                
                <div class="collapsible-body">
                    <table>
                        
                        <tr>
                            
                            <td class="pseudoCode">
                            <?php echo nl2br($privateFunction->getContent());?>    
                            </td>
                            <td>
                                <pre><code class="language-<?php echo $params['selectedLanguage']; ?>"><?php
                                echo \Root\Src\Library\Translator::getFunctionHeader($params['selectedLanguage'], $privateFunction->getType());
                                echo preg_replace("#(\s+)#", " ",\Root\Src\Library\Translator::translate($privateFunction->getName(), $params['selectedLanguage'], $params['selectedStructures']));
                                echo \Root\Src\Library\Translator::layout(\Root\Src\Library\Translator::translate($privateFunction->getContent(), $params['selectedLanguage'], $params['selectedStructures']), ($params['selectedLanguage']=='python'));  ?></code></pre>
                                
                            </td>
                        </tr>
                        
                    </table>
                    
                </div>
            </li>

        
        <?php } ?>
            <li>
                
                <div class="collapsible-header active"><i class="material-icons">code</i>Main</div>
                
                <div class="collapsible-body">
                    <table>
                        
                        <tr>
                            
                            <td class="pseudoCode">
                            <?php echo nl2br($params['pseudoCode']); ?>   
                            </td>
                            <td>
                                <pre><code class="language-<?php echo $params['selectedLanguage']; ?>"><?php
                                echo preg_replace("#\s+#", " ",\Root\Src\Library\Translator::getMainHeader($params['selectedLanguage']));
                                echo \Root\Src\Library\Translator::layout(\Root\Src\Library\Translator::translate($params['pseudoCode'], $params['selectedLanguage'], $params['selectedStructures']), ($params['selectedLanguage']=='python'));  ?></code></pre>
                            </td>
                        </tr>
                        
                    </table>
                    
                </div>
                
            </li>
        
        </ul>
    </div>
    
    <div class="col l2">
        <button class="btn waves-effect waves-light" type="submit" name="">Retour mode édition<i class="material-icons right">replay</i></button>
    </div>
    
    <?php foreach($params['selectedStructures'] as $selectedStructure) { ?>
    
    <input type="hidden" name="selectedStructures[]" value="<?php echo $selectedStructure->getId(); ?>" />
    
    <?php } ?>
    
    <input type="hidden" name="id" value="<?php echo $params['id']; ?>" />
    
</form>