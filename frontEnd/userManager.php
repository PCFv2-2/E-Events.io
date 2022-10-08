<?php
include './header.php';
startPage("Contact");
// Requête SQL
$number_of_user = 20;
?>
<link rel="stylesheet" href="../assets/styles/userManager.css">
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>


<main class="user_manager">
    <h2>Gestion des utilisateurs</h2>
    <div class="container">
        <div class="user_manager_all_users">
            <span class="column_1">LOGIN</span>
            <span class="column_2">ROLE_ID</span>
            <span class="column_3">Modifier</span>
            <?php
            for ($i = 1; $i < $number_of_user; ++$i) {
                ?>
                <div style="<?php
                if ($i % 2 == 0) {
                    ?>
                        background-color: var(--light_primary);
                    <?php
                } else {
                    ?>
                        background-color: var(--light);
                    <?php
                }
                ?>" class="row_user">
                    <input/>
                    <input/>
                    <div class="modify_icons">
                        <span class="material-symbols-outlined">delete</span>
                        <span class="material-symbols-outlined">edit</span>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <button class="user_manager_add">
        <span class="material-symbols-outlined">add</span>
    </button>
</main>
<?php
include './footer.php';
endPage();
?>
