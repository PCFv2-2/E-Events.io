<?php
require_once "header.php";
require_once "footer.php";
require_once '../Required.php';
require_once Required::getMainDir() . '/BackEnd/Constants/keyConstants.php';

if (!isset($_GET['id'])) {
    header("Location: errorPage1.html");
}


$id = intval($_GET["id"]);

$dbMain = new DataBase(DataBaseEnum::MAIN_READ);

// Redirect to error page if id is unknown
if (empty($dbMain->selectQueryAndFetch('SELECT EVENT_ID FROM EVENTS WHERE EVENT_ID=?', array($id), 'i'))) {
    header('Location: errorPage1.html');
}

$event = $dbMain->selectQueryAndFetch('SELECT * FROM EVENTS WHERE EVENT_ID=?', array($id), "i")[0];
$maxPoints = $dbMain->selectQueryAndFetch('SELECT MAX(REQUIRE_NB_POINTS) FROM EVENTS_GOALS WHERE EVENT_ID=?', array($id), 'i')[0][0];

startPage($event[3], array('detailedEvent'), array());
//$points = $_SESSION["nbPoints"];
$points = 3;

//connect to database
$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
//get the current season
$data = $dbMain->selectQueryAndFetch("SELECT * FROM `SEASONS` WHERE `DATE_START`<= NOW() AND NOW() <= `DATE_END`");
$isSeason = !(count($data)==0);

if($isSeason){
    $idSeason=$data[0][0];
    $data = $dbMain->selectQueryAndFetch("SELECT DISTINCT E.EVENT_ID, E.EVENT_NAME, I.IMAGE_PATH FROM `EVENTS` AS E JOIN `EVENTS_IMAGES` AS I ON E.EVENT_ID=I.EVENT_ID WHERE `SEASON_ID`= ? ",array($idSeason),"i");
}


?>
<section class="detailed_event">
    <div class="detailed_event-left_panel">
        <h1 class="detailed_event-left_panel-title"><?php echo $event[3]; ?></h1>
        <img src="<?php
        $eventImage = $dbMain->selectQueryAndFetch('SELECT IMAGE_PATH FROM EVENTS_IMAGES WHERE EVENT_ID=?', array($id), 'i')[0][0];
        echo $eventImage;
        ?>" class="detailed_event-left_panel-image"
             alt="An image relative to the event"/>
        <p class="detailed_event-left_panel-description">
            <?php echo $event[4]; ?>
        </p>
    </div>
    <aside class="detailed_event-right_panel">
        <?php
        $points = $dbMain->selectQueryAndFetch('SELECT SUM(NB_POINTS) FROM EVENTS_POINTS WHERE EVENT_ID=?', array($id), 'i')[0][0];
        if (isset($_SESSION['roleId'])) {
            if ($_SESSION['roleId'] == 4) {
                ?>
                <form action="../BackEnd/BackOffice/Donor/donorManagerForm.php?id=<?php echo $_GET['id']?>" class="detailed_event-right_panel-vote" method="post">
                    <h2 class="vote-title">Voter pour l'évènement</h2>
                    <div class="vote-donate_selector">
                        <input name="points" type="range" id="donate_selector_slider" min="1" max="<?php echo getRemainPoints($_SESSION['userId']); ?>"
                               oninput="donate_selector_number.value=donate_selector_slider.value"/>
                        <input name="points" type="number" id="donate_selector_number" value="4" min="0" max="<?php
                            echo getRemainPoints($_SESSION['userId']);
                        ?>
                    15" oninput="donate_selector_slider.value=donate_selector_number.value"/>
                    </div>
                    <?php

                    $currentPoints = $dbMain->selectQueryAndFetch('SELECT SUM(NB_POINTS) FROM EVENTS_POINTS WHERE EVENT_ID=?', array($id), 'i')[0][0];
                    if ($maxPoints != 0) {
                        ?>
                        <div class="vote-progress_bar">
                            <div class="vote-progress_bar-value" style="width: <?php
                            $percentage = ($currentPoints / $maxPoints) * 100;
                            if ($percentage > 100) {
                                echo 100;
                            }
                            if ($percentage < 0) {
                                echo 0;
                            }
                            echo $percentage + 5;
                            ?>%"><?php echo ($currentPoints / $maxPoints) * 100 . '%'; ?></div>
                        </div>
                    <?php } ?>
                    <p class="vote-text">
                        <?php
                        if ($maxPoints == 0) {
                            echo 'Pas de paliers, mais vous pouvez quand même voter';
                        } else if ($currentPoints < $maxPoints) {
                            echo 'Encore ' . ($maxPoints - $currentPoints) . ' points avant d\'atteindre le niveau suivant';
                        } else if ($currentPoints > $maxPoints) {
                            echo 'Le dernier palier à été atteint, mais vous pouvez quand même voter !';
                        }

                        echo '<br />Points totaux de l\'évènement : ' . $currentPoints;
                        ?>
                    </p>
                    <button type="submit" class="vote-submit_btn btn">Je vote</button>
                </form>
                <?php
            }
        }

        if ($maxPoints > 0) {
            ?>
            <div class="detailed_event-right_panel-steps">
                <h2 class="steps-title">les paliers</h2>
                <div class="steps-main">
                    <?php
                    $goals = $dbMain->selectQueryAndFetch('SELECT DESCRIPTION, REQUIRE_NB_POINTS FROM EVENTS_GOALS WHERE EVENT_ID=?', array($id), 'i');
                    ?>
                    <span class="steps-main-progress">
                        <?php
                            foreach ($goals as $goal) {
                                echo '<span class="steps-main-progress-number">' . $goal[1] . '</span>' . PHP_EOL;
                            }
                        ?>
                    </span>
                    <div class="steps-main-container">
                        <?php
                        foreach ($goals as $goal) {
                            echo '<div class="steps-main-text">' . $goal[0] . '</div>' . PHP_EOL;
                        }
                        ?>
                    </div>
                </div>
                <!--<button class="steps-add_btn">+</button>-->
            </div>
            <?php
        }
        ?>

    </aside>
</section>
<section class="other_events">
    <h1 class="other_events-title">D'autres évènements qui pourraient vous plaire</h1>
    <div class="other_events-cards">
        <?php
        foreach ($data as $otherevent) {
            ?>
            <a class="other_events-cards-card" href="detailedEvent.php?id=<?php echo $otherevent[0] ?>" style="background-image: url(<?php echo $otherevent[2] ?>); background-size: cover;">
                <div class="card-bottom">
                    <h3 class="card-bottom-title"><?php echo $otherevent[1]?></h3>
                    <i class="fa fa-arrow-right"></i>
                </div>
            </a>
            <?php
        }
        ?>
    </div>
</section>
<?php
if (isset($_GET['error'])){
    ?>
    <script>
        alert('Le vote ne c\'est pas passé comme prévu, veuiller recommencer !');
    </script>
    <?php
} else if (isset($_GET['valid'])){
    ?>
    <script>
        alert('Votre vote a bien été enregistré !');
    </script>
    <?php
}

endPage();
?>
