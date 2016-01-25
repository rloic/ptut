<div class="container">
    
    <h3>Mon Compte</h3>
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12 l3">
                    <input id="name" type="text" name="name" required="true" value="<?php echo $params['name'];?>">
                  <label for="name" data-error="Pseudo incorrect">Identifiant</label>
                </div>
                <div class="input-field col s12 l3">
                  <input id="email" type="email" class="validate" name="email" required="true" value="<?php echo $params['email'];?>">
                  <label for="email" data-error="Adresse mail incorrect" class="active">Email</label>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="input-field col s12 l3">
                  <input id="password" type="password" name="oldPassword">
                  <label for="oldPassword" class="active">Ancien mot de passe</label>  
                </div>
                <div class="input-field col s12 l3">
                      <input id="passwordConfirmation" type="password" name="newPassword">
                      <label for="newPassword" class="active">Nouveau mot de passe</label>  
                </div>
                <div class="input-field col s12 l3">
                      <input id="passwordConfirmation" type="password" name="passwordConfirmation">
                      <label for="passwordConfirmation" class="active">Confirmation nouveau mot de passe</label>  
                </div>
            </div>
            <br />
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Avatar</span>
                        <input type="file" name="avatar">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="action">Envoyer
                <i class="material-icons right">send</i>
            </button>

        </form>
    </div>
    
</div>