<?php
require_once('../connect.php');
include "../functions.php";

$listorgasql = "SELECT id, name FROM organization";

$listquery = $db->prepare($listorgasql);

$listquery->execute();

$listorga = $listquery->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST)){
    if(isset($_POST['firstname']) && !empty($_POST['firstname'])){
            $prenom = strip_tags($_POST['firstname']);
            $nom = strip_tags($_POST['lastname']);
            $email = strip_tags($_POST['email']);
            $mdp = strip_tags($_POST['password']);
            $suspended = strip_tags($_POST['suspended']);
            for ($i= 0; $i < count($listorga); $i++){
              if ($_POST['Organization'] == $listorga[$i]['name']){
                $idOrganization = $listorga[$i]['id'];
              }}

            $sql = "INSERT INTO user(firstname, lastname, email, password, suspended, idOrganization) VALUES (:firstname, :lastname, :email, :password, :suspended, :idOrganization);";

            $query = $db->prepare($sql);

            $query->bindValue(':firstname', $prenom, PDO::PARAM_STR);
            $query->bindValue(':lastname', $nom, PDO::PARAM_STR);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->bindValue(':password', $mdp, PDO::PARAM_STR);
            $query->bindValue(':suspended', $mdp, PDO::PARAM_STR);
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
    <label for='suspended'>Suspended</label>
    <input class='form-control' type='text' name='suspended' id='suspended'>
    </div>";
echo"<div class='form-group'>
    <label for='idOrganization'>IdOrganization</label>
    <select class='form-control' name='Organization' id='Organization'>";
for ($i = 0; $i < count($listorga); $i++){
echo "		<option value='".$listorga[$i]['name']."'>".$listorga[$i]['name']."</option>";
}
echo "    </select>
    </div>
    <button class='btn btn-success mb-2'>Enregistrer</button>
</form>
<a class='btn btn-info mb-2' href='user.php'>Retour</a>";

getFooter();
?>
