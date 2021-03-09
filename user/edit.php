<?php
require_once('../connect.php');
include "../functions.php";

if(isset($_POST)){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['firstname']) && !empty($_POST['firstname'])
        && isset($_POST['lastname']) && !empty($_POST['lastname'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['idOrganization']) && !empty($_POST['idOrganization'])){
        $id = strip_tags($_GET['id']);
        $prenom = strip_tags($_POST['firstname']);
        $nom = strip_tags($_POST['lastname']);
        $email = strip_tags($_POST['email']);
        $mdp = strip_tags($_POST['password']);
        $idOrganization = strip_tags($_POST['idOrganization']);

        $sql = "UPDATE user SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, idOrganization=:idOrganization WHERE id=:id;";

        $query = $db->prepare($sql);

        $query->bindValue(':firstname', $prénom, PDO::PARAM_STR);
        $query->bindValue(':lastname', $nom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $mdp, PDO::PARAM_STR);
        $query->bindValue(':idOrganization', $idOrganization, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        header('Location: user.php');
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM user WHERE id=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

require_once('../close.php');

getHeader('Modifier un utilisateur','CRUD utilisateurs','bg-secondary rounded-bottom');
echo "<form method='post'>
      <div class='form-group'>
            <label for='firstname'>Prénom</label>";
echo "      <input class='form-control' type='text' name='firstname' id='firstname' value='".$result['firstname']."'>
      </div>
      <div class='form-group'>
            <label for='lastname'>Nom</label>";
echo "      <input class='form-control' type='text' name='lastname' id='lastname' value='".$result['lastname']."'>
      </div>
      <div class='form-group'>
            <label for='email'>Email</label>";
echo "      <input class='form-control' type='text' name='email' id='email' value='".$result['email']."'>
      </div>
      <div class='form-group'>
            <label for='password'>Mot de passe</label>";
echo "      <input class='form-control' type='text' name='password' id='password' value='".$result['password']."'>
      </div>
      <div class='form-group'>
            <label for='idOrganization'>IdOrganization</label>";
echo "      <input class='form-control' type='text' name='idOrganization' id='idOrganization' value='".$result['idOrganization']."'>
      </div>
      <div class='form-group'>
            <button class='btn btn-dark mb-2'>Enregistrer</button>
      </div>";
echo "  <input type='hidden' name='id' value='".$result['id']."'>
    </form>
    <a class='btn btn-info mb-2' href='user.php'>Retour</a>
</body>
</html>";
?>
