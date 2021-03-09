<?php
require_once('../connect.php');
include "../functions.php";
if(isset($_POST)){
    if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
            $prenom = strip_tags($_POST['firstname']);
            $nom = strip_tags($_POST['lastname']);
            $email = strip_tags($_POST['email']);
            $mdp = strip_tags($_POST['password']);
            $idOrganization = strip_tags($_POST['idOrganization']);

            $sql = "INSERT INTO user(firstname, lastname, email, password, idOrganization) VALUES (:firstname, :lastname, :email, :password, :idOrganization);";

            $query = $db->prepare($sql);

            $query->bindValue(':firstname', $prenom, PDO::PARAM_STR);
            $query->bindValue(':lastname', $nom, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':password', $mdp, PDO::PARAM_STR);
            $query->bindValue(':idOrganization', $idOrganization, PDO::PARAM_STR);

            $query->execute();
            $_SESSION['message'] = "utilisateur ajouté avec succès !";
            header('Location: user.php');
        }
}

require_once('../close.php');

getHeader('Ajout d\'un utilisateur','CRUD utilisateurs','bg-secondary rounded-bottom');

echo "<form method='post'>
    <div class='form-group'>
    <label for='firstname'>Prénom</label>
    <input class='form-control' type='text' name='firstname' id='firstname'>
    </div>
    <div class='form-group'>
    <label for='lastname'>Nom</label>
    <input class='form-control' type='text' name='lastname' id='lastname'>
    </div>
    <div class='form-group'>
    <label for='email'>Email</label>
    <input class='form-control' type='text' name='email' id='email'>
    </div>
    <div class='form-group'>
    <label for='password'>Mot de passe</label>
    <input class='form-control' type='text' name='password' id='password'>
    </div>
    <div class='form-group'>
    <label for='idOrganization'>IdOrganization</label>
    <input class='form-control' type='text' name='idOrganization' id='idOrganization'>
    </div>
    <button class='btn btn-success mb-2'>Enregistrer</button>
</form>
<a class='btn btn-info mb-2' href='user.php'>Retour</a>";

getFooter();
?>
