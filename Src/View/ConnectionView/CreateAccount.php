<div class="container">
    <h3>Inscription</h3>
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s12 l3">
                    <input id="name" type="text" name="name" required="true">
                  <label for="name" data-error="Pseudo incorrect">Identifiant</label>
                </div>
                <div class="input-field col s12 l3">
                  <input id="email" type="email" class="validate" name="email" required="true">
                  <label for="email" data-error="Adresse mail incorrect" class="active">Email</label>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="input-field col s12 l3">
                  <input id="password" type="password" name="password" required="true">
                  <label for="password" class="active">Mot de passe</label>  
                </div>
                <div class="input-field col s12 l3">
                      <input id="passwordConfirmation" type="password" name="passwordConfirmation" required="true">
                      <label for="passwordConfirmation" class="active">Confirmation mot de passe</label>  
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