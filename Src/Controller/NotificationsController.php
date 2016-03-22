<?php

namespace Root\Src\Controller;


class NotificationsController extends AppController
{

    public static $isCallable = true;

    public static function render($params = [])
    {

        header('Content-type: application/xml; charset=utf-8');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<liste>';


        $statement = \Root\Src\Model\ConnectionModel::getConnection()->query('Select * from notification where idUser = :ownerId',
            ['ownerId' => AppController::getUser()->getId()]);

        //$donnees = $statement->fetchAll();

        foreach($statement as $notif) {

            $xml .= '<notification>' . $notif->nomNotif . ' : ' . $notif->contenuNotif . '</notification>';

        }

        $xml .= '</liste>';

        echo $xml;
    }

}