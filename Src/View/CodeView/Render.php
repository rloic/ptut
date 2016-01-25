<script>
 $(document).ready(function(){
    $('ul.tabs').tabs();
  });
  
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
  

  $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
        
</script>

<form class="row" action="<?php echo ROOT_FOLDER; ?>code" method="post">
   
    <div class="col l12 codeMenu">
        
        <a href="#modalAdd" class="btn waves-effect waves-light modal-trigger">
          Nouveau
          <i class="material-icons left">note_add</i>
        </a>  

        <a href="#<?php if($params['user']) { ?>modalOpen<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Ouvrir
          <i class="material-icons left">description</i>
        </a> 

        <a href="#<?php if($params['user']) { ?>modalSave<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Enregistrer
          <i class="material-icons left">save</i>
        </a> 

        <a href="#<?php if($params['user']) { ?>modalBackUp<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Restaurer
          <i class="material-icons left">restore</i>
        </a> 

        <a href="#<?php if($params['user']) { ?>modalShare<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Partager
          <i class="material-icons left">call_split</i>
        </a> 

        <a href="#<?php if($params['user']) { ?>modalAskForHelp<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Demander de l'aide
          <i class="material-icons left">info_outline</i>
        </a> 

        <a href="#<?php if($params['user']) { ?>modalStructure<?php } ?>" class="btn waves-effect waves-light<?php if(!$params['user']) {?> disabled <?php } else {?> modal-trigger <?php } ?>">
          Gérer mes structures
          <i class="material-icons left">settings</i>
        </a> 
        
    </div> 
    <div class="col l12 codeMenu" style="padding-top: 15px;margin-bottom: 20px">
        
        <input name="language" type="radio" id="php" <?php if ($params['selectedLanguage'] == "php") { ?> checked="checked" <?php } ?> value="php"/>
        <label for="php">Php</label>
        <input name="language" type="radio" id="java" <?php if ($params['selectedLanguage'] == "java") { ?> checked="checked" <?php } ?> value="java"/>
        <label for="java">Java</label>
        <input name="language" type="radio" id="javascript" <?php if ($params['selectedLanguage'] == "javascript") { ?> checked="checked" <?php } ?> value="javascript"/>
        <label for="javascript">Javascript</label>
        <input name="language" type="radio" id="python" <?php if ($params['selectedLanguage'] == "python") { ?> checked="checked" <?php } ?> value="python"/>
        <label for="python">Python</label>
        <input name="language" type="radio" id="C" <?php if ($params['selectedLanguage'] == "c") { ?> checked="checked" <?php } ?> value="c"/>
        <label for="C">C</label>
        <input name="language" type="radio" id="Executer" <?php if ($params['selectedLanguage'] == "executer") { ?> checked="checked" <?php } ?> value="executer"/>
        <label for="Executer">Executer</label>
        
    </div>
    
    <textarea 
        onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}"
        name="pseudoCode" class="col l6 materialize-textarea" style="min-height:400px"><?php echo $params['pseudoCode']; ?></textarea>
    <div class="col l4">
        
        
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
          <li class="tab col s3 <?php if(!$params['user']) { echo 'disabled'; } ?>"><a href="#test1">Mes Fonctions</a></li>
          <li class="tab col s3"><a class="active" href="#test2">Fonctions Publiques</a></li>
      </ul>
    </div>
      <div id="test1" class="col s12">
          <?php foreach($params['privateFunctions'] as $privateFunction) { ?>
          
          <input type="checkbox" name="privateFunctions[]" value="<?php echo $privateFunction->getId(); ?>" id="private<?php echo $privateFunction->getId(); ?>" <?php if(in_array($privateFunction->getId(), $params['selectedPrivateFunctions'])) { echo 'checked="true"'; } ?>/>
          <label for="private<?php echo $privateFunction->getId(); ?>"
                 class="tooltipped"
                 data-delay="50" data-tooltip="<?php echo nl2br($privateFunction->getLabel()); ?>"
                 ><?php echo $privateFunction->getName(); ?></label>
          <br />
          <?php } ?>
      </div>
      <div id="test2" class="col s12" style="text-align: right">
          <?php foreach($params['publicFunctions'] as $publicFunction) { ?>
          
          <input type="checkbox" name="publicFunctions[]" value="<?php echo $publicFunction->getId(); ?>" id="public<?php echo $publicFunction->getId(); ?>" <?php if(in_array($publicFunction->getId(), $params['selectedPublicFunctions'])) { echo 'checked="true"'; } ?>/>
          <label for="public<?php echo $publicFunction->getId(); ?>"
                 class="tooltipped"
                 data-delay="50" data-tooltip="<?php echo nl2br($publicFunction->getLabel()); ?>"
                 ><?php echo $publicFunction->getName(); ?></label>
          <br />
          <?php } ?>
          
          
      </div>
  </div>
        
        
    </div>
    <div class="col l2">
        <button class="btn waves-effect waves-light" type="submit" name="translate">Traduire
        <i class="material-icons right">code</i>
        </button>
    </div>
  
<!-- POPUP REDIRECTION --------------------------------------------------------------------------------------------------------------------------- -->
<div id="modalAdd" class="modal">
    <div class="modal-content">
      <h4>Demande de confirmation</h4>
      <p>Vous avez demandé à créer une nouvelle page. Si vous continuer votre travail en cours ne sera pas sauvegardé.</p>
    </div>
    <div class="modal-footer">
       <p class="modal-close waves-effect waves-red btn-flat">Annuler</p>
      <a  href="<?php echo ROOT_FOLDER;?>code/erase" class=" modal-action modal-close waves-effect waves-green btn-flat" >Continuer</a>
    </div>
</div>

<div id="modalSave" class="modal">
    
    <div class="modal-content">
        <h1>Sauvegarder</h1>
        <div class="row">
            <input type="hidden" name="idToSave" value="<?php if($params['activeFunction']) { echo $params['activeFunction']->getId(); } ?>">
            <div class="col l6">
                <div class="input-field">
                    <input id="name" type="text" name="name" class="validate" value="<?php if($params['activeFunction']) { echo $params['activeFunction']->getName(); } ?>">
                    <label for="name">En-tête de la fonction</label>
                </div>
            </div>
            <div class="col l2">
                <div class="input-field">
                    <input id="type" type="text" name="type" class="validate" value="<?php if($params['activeFunction']) { echo $params['activeFunction']->getType(); } ?>">
                    <label for="type">Type retourné</label>
                </div>
            </div>
        </div>
        
        <textarea name="label" placeholder="Documentation de la fonction" class="materialize-textarea"><?php if($params['activeFunction']) { echo $params['activeFunction']->getLabel(); } ?></textarea>
        
        <p class="modal-close waves-effect waves-red btn-flat">Annuler</p>
        <button class=" modal-action waves-effect waves-green btn-flat" type="submit" name="save">Sauvegarder</button>
        
    </div>
    
</div>

<div id="modalOpen" class="modal">
    <div class="modal-content">
      <h4>Choisissez la fonction a chargér.</h4>
      <table class="striped">
          <thead>
              
              <tr>
                  
                  <th>Titre</th>
                  <th>Label</th>
                  <th>Date</th>
                  <th></th>
              </tr>
              
          </thead>
          <tbody>
              
              <?php foreach($params['privateFunctions'] as $privateFunction) { ?>
              <tr>
                  
                  
                  <td><?php echo $privateFunction->getName(); ?></td>
                  <td><?php echo nl2br($privateFunction->getLabel()); ?></td>
                  <td><?php echo $privateFunction->getDate(); ?></td>
                  <td><a href="<?php echo ROOT_FOLDER; ?>code/open/<?php echo $privateFunction->getId(); ?>" class="waves-effect waves-light btn">Ouvrir</a></td>
                  
              </tr>
              <?php } ?>
              
          </tbody>
      </table>
    </div>
    <div class="modal-footer">
       <p class="modal-close waves-effect waves-red btn-flat">Fermer</p>
    </div>
</div>

<div id="modalStructure" class="modal">
    <div class="modal-content">
      <h4>Activer mes structures de traductions</h4>
      <table class="striped">
          <thead>
              
              <tr>
                  <th>Structure<th>
              </tr>
              
          </thead>
          <tbody>
              
              <?php foreach($params['userStructures'] as $userStructure) { ?>
              <tr>
                  
                  <td>
                      <input type="checkbox" id="userStructure<?php echo $userStructure->getId(); ?>"
                        value="<?php echo $userStructure->getId(); ?>"
                        name="selectedUserStructures[]"
                        <?php if(in_array($userStructure->getId(), $params['selectedUserStructures'])) { ?> checked="true" <?php } ?>/>
                        <label for="userStructure<?php echo $userStructure->getId(); ?>"><?php echo $userStructure->getCode(); ?></label>
                  </td>
                  
              </tr>
              <?php } ?>
              
          </tbody>
      </table>
    </div>
    <div class="modal-footer">
        <p class="modal-close waves-effect waves-red btn-flat">Fermer</p>
    </div>
</div>
    
    
<input type="hidden" name="id" value="<?php echo $params['id']; ?>" />

</form>



