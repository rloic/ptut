<?php
/**
 * Created by PhpStorm.
 * User: Xx-SmegmaLord--Xx

 * Date: 14/03/2016
 * Time: 23:25
 */

header('Content-type: text/html; charset=utf-8');
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<liste>';


$statement = \Root\Src\Model\ConnectionModel::getConnection()->query('Select * from notifications where idUser = :ownerId',
    ['ownerId' => AppController::getUser().getId()]);

//On boucle sur le resultat
while ($donnees = $statement->fetch())
{
    $xml .= '<notification>' . $donnees[0] . '</notification>';
}
$xml .= '<\liste>';

echo $xml;