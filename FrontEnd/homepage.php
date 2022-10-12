<?php

require_once '../Required.php';

include '../FrontEnd/header.php';
startPage("Accueil",["carousel","detailedEvent"],["./Assets/Javascript/carousel"]);

//connect to database
$dbMain = new DataBase(DataBaseEnum::MAIN_WRITE);
//get the current season
$data = $dbMain->selectQueryAndFetch("SELECT * FROM `SEASONS` WHERE `DATE_START`<= NOW() AND NOW() <= `DATE_END`");


$isSeason = !(count($data)==0);
$idSeason=-1;
$idSeasonPrevious=-1;
if($isSeason){
    $idSeason=$data[0][0];
    $idSeasonPrevious = $idSeason-1;
    $data = $dbMain->selectQueryAndFetch("SELECT DISTINCT E.EVENT_ID, E.EVENT_NAME, I.IMAGE_PATH FROM `EVENTS` AS E JOIN `EVENTS_IMAGES` AS I ON E.EVENT_ID=I.EVENT_ID WHERE `SEASON_ID`= ? ",array($idSeason),"i");

}
else{
    $dataPrevious = $dbMain->selectQueryAndFetch("SELECT MAX(SEASON_ID) FROM `SEASONS`");
    $idSeasonPrevious = $dataPrevious[0][0];
}

?>

<main>
    <!-- It contains an article -->
    <article>
        <?php
            //TO DO : boolean need to get from the database if there is a season

            if ($isSeason){
        ?>
                <h1>venez voter pour votre évènement préféré !</h1>
                <section class="other_events">
                        <div class="other_events-cards">
                        <?php
                        foreach ($data as $event) {
                            ?>
                            <a class="other_events-cards-card" href="detailedEvent.php?id=<?php echo $event[0] ?>" style="background-image: url(<?php echo $event[2] ?>); background-size: cover;">
                                <div class="card-bottom">
                                    <h3 class="card-bottom-title"><?php echo $event[1]?></h3>
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </section>
        <?php
            }
            else{
        ?>
                <h1>la campagne est finie, mais voici les évènements de la saison précédente :</h1>
        <?php
            }
        ?>
        <br>
        <?php
            if($idSeasonPrevious > -1){
                $dataPrevious = $dbMain->selectQueryAndFetch("SELECT EVENT_ID FROM `EVENTS` WHERE SEASON_ID=?",array($idSeasonPrevious),"i");
                $best=array(array(0,0),array(0,0),array(0,0));
                $img=array("","");
                foreach ($dataPrevious as $key) {
                    $count = $dbMain->selectQueryAndFetch("SELECT COUNT(*) FROM `JURY_VOTE` WHERE EVENT_ID=?", array($key[0]), "i")[0][0];
                    for ($i = 0; $i < 3; $i++) {
                        if ($count > $best[$i][0]) {
                            $temp = $best[$i];
                            $best[$i] = array($count, $key[0]);
                            if ($i < 2) {
                                $best[$i + 1] = $temp;
                            }
                            break;
                        }
                    }
                }

                $dataPrevious = $dbMain->selectQueryAndFetch("SELECT IMAGE_PATH FROM `EVENTS_IMAGES` WHERE EVENT_ID=?",array($best[0][1]),"i");
                $img[0]=$dataPrevious[0][0];
                $dataPrevious = $dbMain->selectQueryAndFetch("SELECT IMAGE_PATH FROM `EVENTS_IMAGES` WHERE EVENT_ID=?",array($best[1][1]),"i");
                $img[1]=$dataPrevious[0][0];
        ?>
        <h1>Voici les évènements de la saison précédente :</h1>
        <div class="slideshow-container">
            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src=<?php echo "\"".$img[0]."\""; ?> style="width:100%">
                <div class="text">Caption Text</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src=<?php echo "\"".$img[1]."\""; ?> style="width:100%">
                <div class="text">Caption Two</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="https://images.assetsdelivery.com/compings_v2/tartila/tartila1904/tartila190400116.jpg" style="width:100%">
                <div class="text">Caption Three</div>
            </div>

            <!-- Next and previous buttons -->
            <a href="#" class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a href="#" class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <?php
            }
        ?>

        <!-- The dots/circles -->
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>

    </article>

</main>

<?php
include '../FrontEnd/footer.php';
endPage();
?>
