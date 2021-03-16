<?php
require_once('../connect.php');
include "../functions.php";

$listorgasql = "SELECT id, name FROM organization";

$listquery = $db->prepare($listorgasql);

$listquery->execute();

$listorga = $listquery->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST)){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['firstname']) && !empty($_POST['firstname'])
        && isset($_POST['lastname']) && !empty($_POST['lastname'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['Organization']) && !empty($_POST['Organization'])){
        $id = strip_tags($_GET['id']);
        $prenom = strip_tags($_POST['firstname']);
        $nom = strip_tags($_POST['lastname']);
        $email = strip_tags($_POST['email']);
        $mdp = strip_tags($_POST['password']);
        $suspended = strip_tags($_POST['suspended']);
        for ($i= 0; $i < count($listorga); $i++){
          if ($_POST['Organization'] == $listorga[$i]['name']){
            $idOrganization = $listorga[$i]['id'];
          }}

        $sql = "UPDATE user SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, suspended=:suspended, idOrganization=:idOrganization WHERE id=:id;";

        $query = $db->prepare($sql);

        $query->bindValue(':firstname', $prenom, PDO::PARAM_STR);
        $query->bindValue(':lastname', $nom, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':password', $mdp, PDO::PARAM_STR);
        $query->bindValue(':suspended', $suspended, PDO::PARAM_STR);
        $query->bindValue(':idOrganization', $idOrganization, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        header('Location: user.php');
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT user.id, user.firstname, user.lastname, user.email, user.password, user.suspended, organization.name FROM user INNER JOIN organization ON user.idOrganization = organization.id WHERE user.id =:id ORDER BY firstname";

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
            <label for='suspended'>Suspended</label>";
echo "      <input class='form-control' type='text' name='suspended' id='suspended' value='".$result['suspended']."'>
      </div>";



echo "<div class='form-group'>
            <label for='Organization'>Organization</label>
            <select class='form-control' name='Organization' id='Organization'>
            <option value='".$result['name']."'>".$result['name']."</option>";
for ($i = 0; $i < count($listorga); $i++){
  if ($listorga[$i]['name'] != $result['name']){
  echo "		<option value='".$listorga[$i]['name']."'>".$listorga[$i]['name']."</option>";
}}
  echo "    </select>
      </div>";

/*      echo "<div class='form-group'>
                  <label for='Organization'>Organization</label>
                  <input class='form-control' type='text' name='Organization' id='Organization' value='".$result['name']."'>
            </div>";*/

echo "      <div class='form-group'>
            <button class='btn btn-dark mb-2'>Enregistrer</button>
      </div>";


echo "  <input type='hidden' name='id' value='".$result['id']."'>
    </form>
    <a class='btn btn-info mb-2' href='user.php'>Retour</a>
</body>
</html>";
?>
