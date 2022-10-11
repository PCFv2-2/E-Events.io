<?php
include '../FrontEnd/header.php';
startPage("Accueil",["carousel","detailedEvent"],["./Assets/Javascript/carousel"]);

$listNamesOfEvents = array("Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement", "Titre de l'évènement")

?>

<main>
    <!-- It contains an article -->
    <article>
        <?php
            //TO DO : boolean need to get from the database if there is a season
            $isSeason = true;

            if ($isSeason){
        ?>
                <h1>venez voter pour votre évènement préféré !</h1>
                <section class="other_events">
                        <div class="other_events-cards">
                        <?php
                        foreach ($listNamesOfEvents as $eventName) {
                            ?>
                            <a class="other_events-cards-card" href="#">
                                <div class="card-bottom">
                                    <h3 class="card-bottom-title"><?php echo $eventName?></h3>
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
        <br/>
        <h1>Voici les évènements de la saison précédente :</h1>
        <div class="slideshow-container">
            <!-- Full-width images with number and caption text -->
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" style="width:100%">
                <div class="text">Caption Text</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="https://thumbs.dreamstime.com/b/belle-for%C3%AAt-tropicale-%C3%A0-l-itin%C3%A9raire-am%C3%A9nag%C3%A9-pour-amateurs-de-la-nature-de-ka-d-ang-36703721.jpg" style="width:100%">
                <div class="text">Caption Two</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="https://images.ctfassets.net/hrltx12pl8hq/a2hkMAaruSQ8haQZ4rBL9/8ff4a6f289b9ca3f4e6474f29793a74a/nature-image-for-website.jpg?fit=fill&w=480&h=320" style="width:100%">
                <div class="text">Caption Three</div>
            </div>

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

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
