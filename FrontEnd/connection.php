<?php
    include '../FrontEnd/header.php';
    startPage("Connexion",["form"],[]);
?>

<main>
    <!-- It contains an article -->
    <article>
        <!-- Registration form -->
        <!-- subject, fist-name, last-name, email, details -->
        <form method="post">
            <div>
                <p id="title">connexion</p>
                <div>
                    <div class="connexion">
                        <label for="user-name" class="icon"><i class="fa fa-user-o fa-lg"></i></label>
                        <input type="text" id="user-name" name="user-name" class="input" placeholder="nom d'utilisateur">
                        <br>
                    </div>
                    <br/>
                    <div class="connexion">
                        <label for="password" class="icon"><i class="fa fa-lock fa-lg"></i></label>
                        <input type="text" id="password" name="password" class="input" placeholder="mot de passe">
                        <br>
                    </div>
                    <br/>
                    <div id="validate">
                        <button class="inscription input">S'inscrire</button>
                        <input type="submit" value="Envoyer" class="input2" id="contact-submit"/>
                    </div>
                    <br/>
                </div>
            </div>
        </form>
    </article>

</main>

<?php
    include '../FrontEnd/footer.php';
    endPage();
?>
