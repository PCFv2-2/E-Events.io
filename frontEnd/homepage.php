<?php
include '../FrontEnd/header.php'
startPage("Connexion",["carousel"],["https://kit.fontawesome.com/2c7fc28a2f","../assets/javascript/carousel"]);
?>

<main>
    <!-- It contains an article -->
    <article>
        <?php
            //TO DO : boolean need to get from the database if there is a season
            $isSeason = false;

            if ($isSeason){
        ?>
                <h1>venez voter pour votre évènement préféré !</h1>
        <?php
            }
            else{
        ?>
                <h1>la campagne est finie, mais voici les évènements de la saison précédente :</h1>
        <?php
            }
        ?>
        <br/>
        <div id="container">
            <div id="galleryView">
                <div id="galleryContainer">
                    <div id="leftView"></div>
                    <button id="navLeft" class="navBtns"><i class="fas fa-arrow-left fa-3x"></i></button>
                    <a id="linkTag">
                        <div id="mainView"></div>
                    </a>
                    <div id="rightView"></div>
                    <button id="navRight" class="navBtns"><i class="fas fa-arrow-right fa-3x"></i></button>
                </div>
            </div>
            <div id="tilesView">
                <div id="tilesContainer"></div>
            </div>
        </div>

    </article>

</main>

<?php
include '../FrontEnd/footer.php';
endPage();
?>
