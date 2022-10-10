<?php
include '../FrontEnd/header.php';
startPage("Ajouter un évènement",["form"],[]);
?>


    <!-- Here is our page's main content -->
    <main>
        <!-- It contains an article -->
        <article>
            <!-- Registration form -->
            <!-- subject, fist-name, last-name, email, details -->
            <form>
                <div>
                    <p id="title">ajouter un évènement</p>
                    <div class="form-global">
                        <div id="form-left">
                            <label for="email">Nom de l'évènement</label><br>
                            <input type="text" id="email" name="email" class="input3 form-spacing" required><br>

                            <label for="details-Event">Description</label><br>
                            <textarea id="details-Event" name="details" class="input3 form-spacing" rows="6" cols="" required></textarea><br>

                            <label for="email" required>Lieu</label><br>
                            <input type="text" id="email" name="email" class="input3 form-spacing"><br>

                            <label for="file">Image</label><br>
                            <input type="file" name="file">
                        </div>

                        <div id="form-right">
                            <label for="contact-title">Contact</label><br>

                            <select id="subject" name="subject" class="input2 form-spacing" required>
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" id="email" name="email" class="input" required><br>

                            <select id="subject" name="subject" class="input2 form-spacing">
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" id="email" name="email" class="input"><br>

                            <select id="subject" name="subject" class="input2 form-spacing">
                                <option value="" selected disabled hidden>Choisir un type</option>
                                <option value="organizer">URL</option>
                                <option value="donator">email</option>
                                <option value="other">téléphone</option>
                            </select>
                            <input type="text" id="email" name="email" class="input"><br>

                            <!-- Point Level -->
                            <label for="email">Palliers</label><br>
                            <input type="number" min="0" max="1000" id="email" name="email" class="input2 form-spacing" required>
                            <input type="text" id="email" name="email" class="input" required><br>

                            <input type="number" min="0" max="1000" id="email" name="email" class="input2 form-spacing">
                            <input type="text" id="email" name="email" class="input"><br>

                            <input type="number" min="0" max="1000" id="email" name="email" class="input2 form-spacing">
                            <input type="text" id="email" name="email" class="input"><br>

                            <input type="number" min="0" max="1000" id="email" name="email" class="input2 form-spacing">
                            <input type="text" id="email" name="email" class="input"><br>

                            <input type="number" min="0" max="1000" id="email" name="email" class="input2 form-spacing">
                            <input type="text" id="email" name="email" class="input"><br>



                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Ajouter" class="input2" id="contact-submit"/>
                <br>
            </form>
        </article>

    </main>

    <!-- And here is our main footer that is used across all the pages of our website -->


<?php
include '../FrontEnd/footer.php';
endPage();
?>