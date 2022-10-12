<?php
if(isset($_POST['email']) && isset($_POST['details']) && isset($_POST['subject'])){
    $email = $_POST['email'];
    $details = $_POST['details'];
    $subject = $_POST['subject'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];

    $message = 'Envoie demande d\'inscription :' . PHP_EOL;
    $message .= 'Email : ' . $email . PHP_EOL;
    $message .= 'Prénom : ' . $firstName . PHP_EOL;
    $message .= 'Nom : ' . $lastName . PHP_EOL;
    $message .= 'Détails : ' . $details . PHP_EOL;
    $header = "From: $email";
    mail('e-event-io@gmail.com', $subject, $message, $header);

    header('Location: contact.php');
}