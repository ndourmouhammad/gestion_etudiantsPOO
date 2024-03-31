<?php
require('config.php');

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $id_classe = $_POST['class']; // Récupération de l'identifiant de classe depuis le formulaire

    $student->create($nom, $email, $id_classe);
}
?>
