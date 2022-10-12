<?php
require_once '../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';
require_once Required::getMainDir() . '/BackEnd/Crypter/crypter.php';

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);
$eventsLists = $dbMain->selectQueryAndFetch('SELECT E.EVENT_ID, E.EVENT_NAME, E.DESCRIPTION, IFNULL(EP2.TOTAL_POINTS,0) AS TOTAL_POINTS
                                                    FROM SEASONS S,
                                                        EVENTS E
                                                    LEFT JOIN (SELECT EP.EVENT_ID AS EVENT_ID, IFNULL(SUM(EP.NB_POINTS),0) AS TOTAL_POINTS FROM EVENTS_POINTS EP GROUP BY EVENT_ID) AS EP2 ON EP2.EVENT_ID = E.EVENT_ID
                                                    WHERE E.SEASON_ID = S.SEASON_ID
                                                    AND S.SEASON_ID = (SELECT MAX(SEASON_ID) FROM SEASONS)
                                                    ORDER BY TOTAL_POINTS DESC');

include './header.php';
include './footer.php';
if ($_SESSION['roleId'] != 2) {
    header('Location: ./errorPage1.html');
}
startPage('Gestion des utilisateurs', array('juryVoteManager'), array());
?>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <main class="event_manager">
        <h2>Choix des gagnants</h2>
        <div class="container">
            <!-- Form 1 -->
            <form action="../BackEnd/BackOffice/JuryVote/juryVoteManagerForm.php" method="post"
                  class="event_manager_all_events"
                  onsubmit="return confirm('Voulez-vous vraiment voter pour cet évènement ?');">
                <span class="column_0"></span>
                <span class="column_1">Nom</span>
                <span class="column_2">Description</span>
                <span class="column_3">Points</span>
                <span class="column_4">Infos</span>
                <?php
                for ($i = 0; $i < sizeof($eventsLists); ++$i) {
                    ?>
                    <div style="<?php
                    if ($i % 2 != 0) {
                        ?>
                            background-color: var(--light_primary);
                        <?php
                    } else {
                        ?>
                            background-color: var(--light);
                        <?php
                    }
                    ?>" class="row_event">
                        <input type="radio" name="eventId[]" value="<?php echo $eventsLists[$i][0] ?>"/>
                        <input type="text" readonly name="nameEvents[]"
                               value="<?php echo $eventsLists[$i][1] ?>"/>
                        <input type="text" readonly name="descriptionEvents[]"
                               value="<?php echo $eventsLists[$i][2] ?>"/>
                        <input type="text" readonly name="pointsEvents[]"
                               value="<?php echo $eventsLists[$i][3]; ?>"/>
                        <a href="./detailedEvent.php?id=<?php echo $eventsLists[$i][0]; ?>" ><span class="material-symbols-outlined">info</span></a>
                    </div>
                    <?php
                }
                ?>
                <button class="submit_button" type="submit">
                    <span class="material-symbols-outlined">check</span>
                </button>
            </form>
        </div>
    </main>
<?php
if (isset($_GET['error'])) {
    $eventName = $dbMain->selectQueryAndFetch('SELECT EVENT_NAME FROM `EVENTS` JOIN `JURY_VOTE` ON `EVENTS`.EVENT_ID = `JURY_VOTE`.EVENT_ID  AND `JURY_VOTE`.USER_ID = ?', array(77), 'i');
    ?>
    <script>
        alert('Vous avez déjà voté pour l\'évènement suivant : ' + <?php echo json_encode($eventName[0][0]); ?>);
    </script>
    <?php
} else if (isset($_GET['vote'])) {
    $eventName = $dbMain->selectQueryAndFetch('SELECT EVENT_NAME FROM `EVENTS` JOIN `JURY_VOTE` ON `EVENTS`.EVENT_ID = `JURY_VOTE`.EVENT_ID  AND `JURY_VOTE`.USER_ID = ?', array(77), 'i');
    ?>
    <script>
        alert('Vous venez de voter pour l\'évènement suivant : ' + <?php echo json_encode($eventName[0][0]); ?>);
    </script>
    <?php
} else if (isset($_GET['date'])){
    ?>
    <script>
        alert('Le vote ne peut pas commencer tant que la saison n\'est pas terminé !');
    </script>
    <?php
}
endPage();