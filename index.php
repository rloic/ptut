<?php

require 'Settings/AppSettings.php';

require 'Src/Library/Loader.php';
//Chargement de la classe de chargement dynamique des classes
Loader::register();

use \Root\Src\Library\Router;

debug('Debug Mod Active');

//Initialisation de la session
\Root\Src\Controller\AppController::loadSession();
//Routage de l'url
Router::rout();
