<?php


require_once('crud.interface.php');
require_once('classe.class.php');

class Apprenant implements Icrud
{

    private $nom;
    private $email;
    private $cnx;
    private $libelle;

    public function __construct($cnx, $nom, $email, $libelle)
    {
        $this->cnx = $cnx;
        $this->nom = $nom;
        $this->email = $email;
        $this->libelle = $libelle;
    }
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($n_libelle)
    {
        $this->libelle = $n_libelle;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($n_nom)
    {
        $this->nom = $n_nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($n_email)
    {
        $this->email = $n_email;
    }

    public function create($nom, $email, $id_classe)
{
    try {
        $sql = 'INSERT INTO apprenant(nom, email, id_classe) VALUES(:nom, :email, :id_classe)';
        $req = $this->cnx->prepare($sql);
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->bindParam(':id_classe', $id_classe, PDO::PARAM_INT);
        $req->execute();

        // Redirection vers la page index après l'ajout
        header("location: index.php");
        exit();
    } catch (PDOException $erreur) {
        // Gestion des erreurs de connexion ou d'exécution de la requête
        die('Erreur de connexion : ' . $erreur->getMessage());
    }
}

    public function read()
    {
        try {
            $sql = 'SELECT apprenant.id, nom, email, libelle, id_classe FROM apprenant JOIN classe ON apprenant.id_classe = classe.id';

            $req = $this->cnx->prepare($sql);
            $req->execute();
            $apprenants = $req->fetchAll(PDO::FETCH_OBJ);
            return $apprenants;
        } catch (PDOException $erreur) {
            die('Erreur de connexion : ' . $erreur->getMessage());
        }
    }
    public function update($id, $nom, $email, $id_classe)
    {
        try {
            $sql = 'UPDATE apprenant SET nom = :nom, email = :email, id_classe = :id_classe WHERE id = :id';
            $req = $this->cnx->prepare($sql);
            $req->bindValue(':nom', $nom, PDO::PARAM_STR);
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->bindValue(':id_classe', $id_classe, PDO::PARAM_INT); // Inclure l'identifiant de la classe
            $req->bindValue(':id', $id, PDO::PARAM_INT);
    
            $req->execute();
    
            header("location: index.php");
            exit();
        } catch (PDOException $erreur) {
            die('Erreur de connexion : ' . $erreur->getMessage());
        }
    }
    
    public function delete($id)
    {
        try {
            $sql = 'DELETE FROM apprenant WHERE id =:id';
            $req = $this->cnx->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();

            header("location: index.php");
            exit();
        } catch (PDOException $erreur) {
            die('Erreur de connexion : ' . $erreur->getMessage());
        }
    }
}
