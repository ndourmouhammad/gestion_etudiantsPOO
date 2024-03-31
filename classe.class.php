<?php


require_once('crud.interface.php');

class Classe {

    public $libelle;
    public $cnx;

    public function __construct($cnx, $libelle) {
        
        $this->cnx = $cnx;
        $this->libelle = $libelle;
        
    }

    public function getClasses()
{
    try {
        $sql = 'SELECT id, libelle FROM classe';
        $req = $this->cnx->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $erreur) {
        die('Erreur de connexion : ' . $erreur->getMessage());
    }
}

}