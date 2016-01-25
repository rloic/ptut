<?php

require 'Settings/AppSettings.php';

require 'Src/Library/Loader.php';
Loader::register();

use \Root\Src\Library\Router;

debug('Debug Mod Active');

\Root\Src\Controller\AppController::loadSession();
Router::rout();
