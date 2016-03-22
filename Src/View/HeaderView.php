<!DOCTYPE>

<html>
    <head>
        <title> </title>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="<?php echo $baseFolder; ?>Web/css/materialize.css"  media="screen,projection"/>
        <link href="<?php echo $baseFolder; ?>Web/css/mycss.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseFolder; ?>Web/css/prism.css" rel="stylesheet" type="text/css"/>
       
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
<body>
    
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo $baseFolder; ?>Web/js/materialize.js"></script>
<script type="text/javascript" src="<?php echo $baseFolder; ?>Web/js/prism.js"></script>
               
<?php if($user) { ?>

<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">PTUT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="<?php echo ROOT_FOLDER; ?>index">Accueil</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>tutorial">Tutorial</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>progress">Progresser</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>code">Coder</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>download">Télécharger</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>tools">Mes Outils</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>account">Mon Compte</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>connection/disconnect"><i class="material-icons right">lock_outline</i>Deconnexion</a></li>
      </ul>
    </div>
</nav>
    <!-- script pour carry -->
    <script type="text/javascript" src="<?php echo $baseFolder; ?>Web/js/checkNotifications.js"></script>

<?php } else { ?>
        
<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">PTUT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="<?php echo ROOT_FOLDER; ?>index">Accueil</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>tutorial">Tutorial</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>progress">Progresser</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>code">Coder</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>download">Télécharger</a></li>
        <li><a href="<?php echo ROOT_FOLDER; ?>connection"><i class="material-icons right">lock_open</i>Connexion</a></li>
      </ul>
    </div>
  </nav>

<?php } ?>

<div class="container" style="margin-top:15px">
<?php debug($userMsgs); ?>
<?php foreach($userMsgs as $key => $msgs) { ?>
    <?php foreach($msgs as $msg) {?>
    <div class="row">
                    
        <div class="chip <?php echo $key; ?>">
              <i class="material-icons">close</i>
              <?php echo $msg; ?>
        </div>
            
    </div>
    <?php } ?>
    
<?php } ?>
</div>
<div id="separateur"></div>

