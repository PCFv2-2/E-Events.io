<?php
    include '../FrontEnd/header.php';
    startPage("Contact");
?>


<!-- Here is our page's main content -->
<main>
    <!-- It contains an article -->
    <article>
        <!-- Registration form -->
        <!-- subject, fist-name, last-name, email, details -->
        <form>
            <div>
                <p id="title">contact</p>
                <div id="contact">
                    <div id="contact-left">
                        <label for="subject">Sujet</label><br>
                        <select id="subject" name="subject" class="input">
                            <option value="" selected disabled hidden>Choisir un sujet</option>
                            <option value="organizer">Je veux devenir organisateur</option>
                            <option value="donator">Je veux devenir donateur</option>
                            <option value="other">Autre</option>
                        </select><br>


                        <div id="name-contact">
                            <div>
                                <label for="first-name">Prénom</label><br>
                                <input type="text" id="first-name" name="first-name" class="input2">
                                <br>
                            </div>
                            <div id="last-name">
                                <label for="last-name">Nom</label><br>
                                <input type="text" id="last-name" name="last-name" class="input2">
                                <br>
                            </div>

                        </div>

                        <label for="email">Adresse Mail</label><br>
                        <input type="text" id="email" name="email" class="input">
                    </div>

                    <div id="contact-right">
                        <label for="details">Détails</label><br>
                        <textarea id="details" name="details" class="input" rows="6" cols=""></textarea>
                    </div>
                </div>
            </div>
            <br>
            <input type="submit" value="Envoyer" class="input2" id="contact-submit"/>
            <br>
        </form>
    </article>

</main>

<!-- And here is our main footer that is used across all the pages of our website -->


<?php
    include '../FrontEnd/footer.php';
    endPage();
?>