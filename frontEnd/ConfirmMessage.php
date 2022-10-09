<?php
include './header.php';
include './footer.php';
include './BoxMessages.php';
startPage('Gestion des utilisateurs', array('ConfirmMessage'), array());
if (!empty($_POST['delete'])) {
    boxMessage('Sauvegarder ces changements ?', 'Supression', 'Sauvegarder', $_POST['delete']);
} else {
    $users = array();
    for ($i = 0; $i < sizeof($_POST['role']); ++$i) {
        if (!empty($_POST['role'][$i])) {
            $users[] = $_POST['login'][$i];
        }
    }
    boxMessage('Sauvegarder ces changements ?', 'Modification', 'Sauvegarder', $users);
}
endPage();
