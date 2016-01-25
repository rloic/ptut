<script>

  $(document).ready(function(){
    $('ul.tabs').tabs();
  });
        
        $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
</script>

<div class="container">
    
    <h1>Mes outils</h1>
    
    <h2>Mes fonctions</h2>
    <table class="striped" style="margin-bottom: 10px">
        
        <thead>
            <tr>
                <th>
                    Nom
                </th>
                <th>
                    Label
                </th>
                <th>
                    Type retourné
                </th>
                <th>
                    Outils
                </th>
            </tr>
        </thead>
        <tobdy>
    
    <?php foreach($params['algorithms'] as $algorithm) { ?>
            <tr>
            
                <td>
                    <?php echo $algorithm->getName(); ?>
                </td>
                <td>
                    <?php echo nl2br($algorithm->getLabel()); ?>
                </td>
                <td>
                    <?php echo $algorithm->getType(); ?>
                </td>
                <td style="min-width: 240px">
                    <a href="<?php echo ROOT_FOLDER;?>code/open/<?php echo $algorithm->getId();?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a>
                    <a href="#modalDelete<?php echo $algorithm->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
        
                </td>
            </tr>
        
    <?php } ?>
        </tobdy>
    </table>
    
    <a class="waves-effect waves-light btn" style="float:right" href="<?php ROOT_FOLDER; ?>code"><i class="material-icons left">add</i>Ajouter</a>
    
    <h2 style="clear:both">Mes Structures</h2>
    
   
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
          
        <li class="tab col s2"><a href="#test3">Php</a></li>
        <li class="tab col s2"><a href="#test2">Java</a></li>
        <li class="tab col s2"><a href="#test4">Javascript</a></li>
        <li class="tab col s2"><a href="#test5">Python</a></li>
        <li class="tab col s2"><a href="#test1">C</a></li>
      </ul>
    </div>
    <div class="col l12" style="height: 600px; overflow:scroll;overflow-x: hidden; margin-bottom: 15px">
        <table class="striped">

                  <thead>

                      <tr>
                          <th>
                              Pseudo Code
                          </th>
                          <th>
                              Traduction
                          </th>
                          <th>
                              Outils
                          </th>
                      </tr>

                  </thead>
                  <tbody id="test1">
                  <?php foreach($params['structures'] as $structure) { ?>


                      <tr>

                          <td>
                              <?php echo $structure->getCode(); ?>
                          </td>
                          <td>
                  <?php if(isset($params['translations']['c'][$structure->getId()])) { echo $params['translations']['c'][$structure->getId()]->getCode(); } else echo 'Aucune traduction de correspond'; ?>
                          </td>
                          <td>
                              <a href="<?php echo ROOT_FOLDER; ?>structure/load/<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a>
                               <a href="#modalDeleteStructure<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
                          </td>

                      </tr>
                    <?php } ?>   
                  </tbody>

                  <tbody id="test2">
                  <?php foreach($params['structures'] as $structure) { ?>


                      <tr>

                          <td>
                              <?php echo $structure->getCode(); ?>
                          </td>
                          <td>
                  <?php if(isset($params['translations']['java'][$structure->getId()])) { echo $params['translations']['java'][$structure->getId()]->getCode(); } else echo 'Aucune traduction de correspond'; ?>
                          </td>
                          <td>
                              <a href="<?php echo ROOT_FOLDER; ?>structure/load/<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a>
                              <a href="#modalDeleteStructure<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
                          </td>

                      </tr>
                    <?php } ?>   
                  </tbody>

                  <tbody id="test3">
                  <?php foreach($params['structures'] as $structure) { ?>


                      <tr>

                          <td>
                              <?php echo $structure->getCode(); ?>
                          </td>
                          <td>
                  <?php if(isset($params['translations']['php'][$structure->getId()])) { echo $params['translations']['php'][$structure->getId()]->getCode(); } else echo 'Aucune traduction de correspond'; ?>
                          </td>
                          <td>
                            <a href="<?php echo ROOT_FOLDER; ?>structure/load/<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a>
                            <a href="#modalDeleteStructure<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
                          </td>

                      </tr>
                    <?php } ?>   
                  </tbody>

                  <tbody id="test4">
                  <?php foreach($params['structures'] as $structure) { ?>


                      <tr>

                          <td>
                              <?php echo $structure->getCode(); ?>
                          </td>
                          <td>
                  <?php if(isset($params['translations']['javascript'][$structure->getId()])) { echo $params['translations']['javascript'][$structure->getId()]->getCode(); } else echo 'Aucune traduction de correspond'; ?>
                          </td>
                          <td>
                               <a href="<?php echo ROOT_FOLDER; ?>structure/load/<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a> 
                               <a href="#modalDeleteStructure<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
                          </td>

                      </tr>
                    <?php } ?>   
                  </tbody>

                  <tbody id="test5">
                  <?php foreach($params['structures'] as $structure) { ?>


                      <tr>

                          <td>
                              <?php echo $structure->getCode(); ?>
                          </td>
                          <td>
                  <?php if(isset($params['translations']['python'][$structure->getId()])) { echo $params['translations']['python'][$structure->getId()]->getCode(); } else echo 'Aucune traduction de correspond'; ?>
                          </td>
                          <td>
                            <a href="<?php echo ROOT_FOLDER; ?>structure/load/<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn"><i class="material-icons">description</i></a>
                            <a href="#modalDeleteStructure<?php echo $structure->getId(); ?>" class="waves-effect waves-light btn modal-trigger red ligthen-1"><i class="material-icons">delete</i></a>
                          </td>

                      </tr>
                    <?php } ?>   
                  </tbody>

                </table>
    </div>
        
    <a class="waves-effect waves-light btn" style="float:right;margin-top: 15px;" href="<?php echo ROOT_FOLDER; ?>structure"><i class="material-icons left">add</i>Ajouter</a>
    
    
</div>
    
    
<?php foreach($params['algorithms'] as $algorithm) { ?>
    
    <div id="modalDelete<?php echo $algorithm->getId(); ?>" class="modal">
                    <div class="modal-content">
                        <h4>Confirmation</h4>
                        <p>Vous avez demandé de supprimer cette fonction. La suppression est définitive et supprime également toutes les versions de sauvegarde. Pour confirmer cette suppression
                            cliquez sur Supprimer.</p>
                        </div>
                    <div class="modal-footer">
                        <p class="modal-close waves-effect waves-red btn-flat">Annuler</p>
                        <a  href="<?php echo ROOT_FOLDER;?>tools/delete/function/<?php echo $algorithm->getId(); ?>" class=" modal-action modal-close waves-effect waves-green btn-flat ligthen-1" >Supprimer</a>
                    </div>
    </div>
    
<?php } ?>

<?php foreach($params['structures'] as $structure) { ?>
    
    <div id="modalDeleteStructure<?php echo $structure->getId(); ?>" class="modal">
                    <div class="modal-content">
                        <h4>Confirmation</h4>
                        <p>Vous avez demandé de supprimer une structure. Cette action entrainera également la suppression de toutes les traductions qui lui sont ratachées.
                            Une suppression ne peut pas être annulée. Cliquez sur supprimer pour confirmer la suppression ou cliquez sur annuler pour revenir à la page précédente</p>
                        </div>
                    <div class="modal-footer">
                        <p class="modal-close waves-effect waves-red btn-flat">Annuler</p>
                        <a  href="<?php echo ROOT_FOLDER;?>tools/delete/structure/<?php echo $structure->getId(); ?>" class=" modal-action modal-close waves-effect waves-green btn-flat ligthen-1" >Supprimer</a>
                    </div>
    </div>
    
<?php } ?>

    
   