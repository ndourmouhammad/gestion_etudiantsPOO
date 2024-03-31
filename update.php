<?php
// Inclure le fichier contenant la classe Student
require_once "config.php";

$id = $_GET['id'];

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $id_classe = $_POST['class'];
    $student->update($id, $nom, $email, $id_classe);
}

$sql = 'SELECT apprenant.id, nom, email, libelle, id_classe FROM apprenant JOIN classe ON apprenant.id_classe = classe.id WHERE apprenant.id = :id';
$req = $cnx->prepare($sql);
$req->bindParam(':id', $id, PDO::PARAM_INT);
$req->execute();
$apprenants = $req->fetch(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Déclaration des métadonnées -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre de la page -->
    <title>PHP - MYSQL - CRUD</title>
    <!-- Inclusion du CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Inclusion du JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Section principale de la page -->
    <section>
        <!-- Titre principal -->
        <h1 style="text-align: center;margin: 50px 0;">PHP OOP CRUD operations with MySQL</h1>
        <!-- Conteneur principal -->
        <div class="container">
            <!-- Formulaire d'ajout de données avec la méthode POST et l'action "adddata.php" -->
            <form action="" method="post">
                <!-- Ligne du formulaire avec les champs -->
                <div class="row">
                    <!-- Champ pour le nom de l'étudiant -->
                    <div class="form-group col-lg-4">
                        <label for="">Nom de l'étudiant</label>
                        <input type="text" name="nom" id="name" class="form-control" value="<?php echo $apprenants->nom; ?>" required>
                    </div>
                    <!-- Champ pour les notes de l'étudiant -->
                    <div class="form-group col-lg-3">
                        <label for="">Adresse email</label>
                        <input type="email" name="email" id="marks" class="form-control" value="<?php echo $apprenants->email; ?>" required>
                    </div>
                    <div class="form-group col-lg-3">
                        <label for="grade">Grade</label>
                        <select name="class" id="grade" class="form-control" required>
                            <option value=""><?php echo $apprenants->libelle; ?></option>
                            <?php
                            // Utilisation de $student au lieu de $classe
                            foreach ($classes as $classe) {
                                echo '<option value="' . $classe->id . '">' . $classe->libelle . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Bouton de soumission du formulaire -->
                    <div class="form-group col-lg-2" style="display: grid;align-items: flex-end;">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </section>

</body>

</html>