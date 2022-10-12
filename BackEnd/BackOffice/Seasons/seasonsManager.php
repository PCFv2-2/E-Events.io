<?php
//require_once '../../../Required.php';

function addSeason(Season $season){
    try {
        $currentDate = date("Y-m-d");
        $selectionQuery = 'SELECT DATE_END FROM `SEASONS` WHERE SEASON_ID = (SELECT MAX(SEASON_ID) FROM `SEASONS`)';
        $insertionQuery = 'INSERT INTO `SEASONS` (DATE_START,DATE_END, DEFAULT_POINTS) VALUES (?,?,?)';

        //Vérification de la date
        if ($season->getDateStart() > $season->getDateEnd()) {
            header('Location: ../../../FrontEnd/seasonsManager.php?error');
            throw new RuntimeException('Bad date selection');
        }

        //Récupération du dernier evènement dans la BDD
        $db = new DataBase(DataBaseEnum::MAIN_WRITE);
        $lastSeasonEndDate = $db->selectQueryAndFetch($selectionQuery);

        $diff = $season->getDateStart()->diff(new DateTime($lastSeasonEndDate[0][0]));

        if ($diff->invert == 0 && $currentDate < $season->getDateStart()) {
            header('Location: ../../../FrontEnd/seasonsManager.php?error');
            throw new RuntimeException('Bad date selection');
        }

        $db->insertQueryAndFetch($insertionQuery,array($season->getDateStart()->format('Y/m/d'),$season->getDateEnd()->format('Y/m/d'),$season->getDefaultPoint()),'ssi');
        header('Location: ../../../FrontEnd/seasonsManager.php?valid');
    } catch (Exception $e){
        echo $e;
    }
}