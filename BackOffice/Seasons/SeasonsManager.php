<?php

require_once '../../Required.php';

function addSeason(Season $season){

    echo 'Date start' . "\n";
    print_r($season->getDateStart());

    echo 'Date end' . "\n";
    print_r($season->getDateEnd());

    //Vérification de la date
    if ($season->getDateStart() >= $season->getDateEnd()) {
        throw new \http\Exception\RuntimeException('Bad date selection');
    }

    //Récupération du dernier evènement dans la BDD
    $db = new DataBase(DataBaseEnum::MAIN_WRITE);
    $lastSeason = $db->queryAndFetch('SELECT * FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`);');
}

$dateStart = new DateTime('2022-05-01');
$dateEnd = new DateTime('2022-05-01');

addSeason(new Season(-1, $dateStart, $dateStart));