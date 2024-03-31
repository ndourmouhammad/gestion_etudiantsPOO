<?php

require_once('apprenant.class.php');

define('DSN', 'mysql:host=localhost;dbname=apprenant_db;charset=utf8');
define('USER', 'root');
define('PASSWORD', '');

try {
    $cnx = new PDO(DSN, USER, PASSWORD);
    $nom = '';
    $email = '';
    $libelle = '';

    $student = new Apprenant($cnx, $nom, $email, $libelle);
    $apprenants = $student->read();


    $classe = new Classe($cnx, $libelle);
    $classes = $classe->getClasses();
} catch (PDOException $erreur) {
    die('Erreur de connexion : ' . $erreur->getMessage());
}
