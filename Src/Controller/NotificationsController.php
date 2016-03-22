<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Sokolov
 * Date: 21/03/2016
 * Time: 13:21
 */

namespace Root\Src\Controller;


class NotificationsController extends AppController
{

    public static $isCallable = true;

    public static function render($params = [])
    {

        /*header('Content-type: text/html; charset=utf-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<liste>';

        $statement = \Root\Src\Model\ConnectionModel::getConnection()->query('Select * from notification where idUser = :ownerId',
            ['ownerId' => AppController::getUser()->getId()]);

//On boucle sur le resultat
        while ($donnees = $statement->fetch())
        {
            $xml .= '<notification>' . $donnees[0] . '</notification>';
        }
        $xml .= '<\liste>';

        echo $xml;*/
        $statement = \Root\Src\Model\ConnectionModel::getConnection()->query('Select * from notification where idUser = :ownerId',
            ['ownerId' => AppController::getUser()->getId()]);

        foreach ($statement as $notif) {
            echo $notif[0];
        }

    }

}