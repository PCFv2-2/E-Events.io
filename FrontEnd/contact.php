<?php
    include '../FrontEnd/header.php';
    startPage("Contact",["form"],[]);
?>


<!-- Here is our page's main content -->
<main>
    <!-- It contains an article -->
    <article>
        <!-- Registration form -->
        <!-- subject, fist-name, last-name, email, details -->
        <form id="formContact">
            <div>
                <p id="title">contact</p>
                <div class="form-global">
                    <div id="form-left">
                        <label for="subject">Sujet</label><br>
                        <select id="subject" name="subject" class="input" required>
                            <option value="" selected disabled hidden>Choisir un sujet</option>
                            <option value="organizer">Je veux devenir organisateur</option>
                            <option value="donator">Je veux devenir donateur</option>
                            <option value="forgottenpassword">J'ai oublié mon mot de passe</option>
                            <option value="other">Autre</option>
                        </select><br>
                        <div id="name-contact">
                            <div>
                                <label for="first-name">Prénom</label><br>
                                <input type="text" id="first-name" name="first-name" class="input2" required>
                                <br>
                            </div>
                            <div id="last-name">
                                <label for="last-name">Nom</label><br>
                                <input type="text" id="last-name" name="last-name" class="input2" required>
                                <br>
                            </div>
                        </div>
                        <label for="email">Adresse Mail</label><br>
                        <input type="text" id="email" name="email" class="input" required>
                    </div>
                    <div id="form-right">
                        <label for="details">Détails</label><br>
                        <textarea id="details" name="details" class="input" rows="6" required></textarea>
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" value="Envoyer" class="input2" id="form-submit"/>
            <br>
        </form>
    </article>

</main>

<!-- And here is our main footer that is used across all the pages of our website -->


<?php
    include '../FrontEnd/footer.php';
    endPage();
?>