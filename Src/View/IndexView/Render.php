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

<div class="container">
    
    <h1>Accueil</h1>
    
    <h5>Dernières fonction publique</h5>
    
    <div class="row">
        
        
        
    </div>
    
    <?php if(Root\Src\Controller\AppController::getUser()) { ?>
    
    <h5>Demande d'aide</h5>
    
    <div class="row">
        <?php foreach($params["helpList"] as $help) { ?>
        <div class="col l6">
            <div class="card">
            <div class="card-image">
                <p class="pseudoCode code grey lighten-2" style="width:100%;max-height: 16em;text-overflow:ellipsis;overflow:hidden">
                    <?php echo nl2br($help->getContent()); ?>
                </p>
            </div>
            <div class="card-content">
                <p>
                    <?php
                        echo $params["helpMsg"][$help->getId()]["content"];
                    ?>
                </p>
            </div>
            <div class="card-action">
              <a href="#modalAskForHelp<?php echo $help->getId(); ?>" class="modal-trigger"><?php echo $params["helpMsg"][$help->getId()]["owner"] ?> a besoin d'aide !</a>
            </div>
          </div>
        </div>
       
         
        <!-- Modal de demande d'aide --------------------------- -->
        <div id="modalAskForHelp<?php echo $help->getId(); ?>" class="modal">

            <form action="index/giveHelp" method="POST">
            <div class="modal-content">
              <h4>Apporter de l'aide</h4>
              
              <div class="pseudCode" style="margin: 0 20%;width:60%; background-color: white;padding:10px;border:1px solid grey">
                  <?php echo nl2br($help->getContent()); ?>
              </div>
                  
              
              <!-- On affiche les aides déjà apportées -->
              <ul style="max-width:95%;height:310px;overflow:auto">
              <?php foreach(\Root\Src\Model\MailModel::getMsgBySubject($help->getId()) as $msg) { ?>
                    <div class="row" style="width:98%">
                    <!-- On affiche différemment en fonction de l'émetteur du message -->
                    <?php if($msg->getOwnerId()!=$help->getOwnerId()) { ?>
                    
                        <?php if(Root\Src\Controller\AppController::getUser()->getId() == $msg->getOwnerId()) { ?>
                        <li class='waves-effect waves-light btn left green lighten-2 white-text msgBtn'>
                        Vous
                        <?php } else { ?>
                        <li class='waves-effect waves-light btn left grey lighten-2 black-text msgBtn'>
                        <?php echo \Root\Src\Model\UserModel::getUser($msg->getOwnerId())->getName(); ?>
                        <?php } ?>
                        <br /><?php echo $msg->getContent(); ?></li>
                    <?php } else { ?>
                    <li class='waves-effect waves-light btn right light-blue darken-1 msgBtn-right'>
                        
                        <?php if($params["helpMsg"][$help->getId()]["owner"] == Root\Src\Controller\AppController::getUser()->getName()) {
                            echo "Vous";
                        } else {
                            echo $params["helpMsg"][$help->getId()]["owner"];
                        }?><br /><?php echo $msg->getContent(); ?></li>
                    <?php } ?>
                    </div>
              <?php } ?>
              </ul>
                    <p style="clear:both">Message :</p>
               <textarea name="helpMsg" class="materialize-textarea"></textarea>
               <input type='hidden' name='userId' value='<?php echo Root\Src\Controller\AppController::getUser()->getId(); ?>' />
               <input type="hidden" name="msgHelpedId" value="<?php echo $help->getId(); ?>" />

            </div>
            <div class="modal-footer">
                <p class="modal-close waves-effect waves-red btn-flat">Fermer</p>
                <button class=" modal-action waves-effect waves-green btn-flat" type="submit" name="askForHelp">Envoyer</button>
            </div>
            </form>
        </div>
        
        
        <?php } ?>
    </div>
    <?php } ?>
    
</div>


