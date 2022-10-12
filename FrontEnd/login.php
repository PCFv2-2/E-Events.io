<?php
include 'header.php';
startPage("Connexion", ["login"], []);
?>

<section class="login">
    <!-- Login form -->
    <div class="login-left_panel">
        <h1 class="login-title">connexion</h1>
        <form method="post" class="login-form" action="checkLogins.php">
            <div class="login-form-id">
                <label for="username" class="icon"><i class="fa fa-user-o fa-2x"></i></label>
                <input type="text" id="username" name="username" class="login-form-input <?php
                if (isset($_GET["error"])) {
                    echo "login-form-input-error";
                }
                ?>" placeholder="Nom d'utilisateur">
            </div>

            <div class="login-form-id">
                <label for="password" class="icon"><i class="fa fa-lock fa-2x"></i></label>
                <input type="password" id="password" name="password" class="login-form-input <?php
                if (isset($_GET["error"])) {
                    echo "login-form-input-error";
                }
                ?>
                " placeholder="Mot de passe">
            </div>
            <?php
            if (isset($_GET["error"])) {?>
                <p class="login-form-error_text">
                    Le nom d'utilisateur ou le mot de passe est incorrect.<br />
                    <a href="contact.php">J'ai oublié mon mot de passe.</a>
                </p>
                <?php
            }
            ?>

            <div class="login-form-submit">
                <a class="login-form-signup" href="contact.php">S'inscrire</a>
                <button type="submit" class="login-form-login">Se connecter</button>
            </div>

        </form>
    </div>
    <div class="login-right_panel"><img src="Assets/Images/login.jpg" alt="Picture showing someone connecting"></div>
</section>

<?php
include 'footer.php';
endPage();
?>