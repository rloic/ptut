<div class="container">
    
    <h1>Connexion</h1>
    
    <form action="<?php echo ROOT_FOLDER; ?>connection/connect" method="POST">
        
        <div class="row">
            
            <div class="col l4">

                <input placeholder="" id="login" type="text" name="login">
                <label for="login">Identifiant</label>

            </div>
            <div class="col l4">

                <input placeholder="" id="password" type="password" name="password">
                <label for="password">Mot de Passe</label>

            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col l4">
                
                <a href="<?php echo ROOT_FOLDER; ?>connection/createAccount">Je n'ai pas encore de compte</a>
                
            </div>
            
            <div class="col l4">

                <button class="btn waves-effect waves-light" type="submit" name="action">Se connecter
                    <i class="material-icons right">send</i>
                </button>

            </div>
            
        </div>
        
    </form>
    
</div>

