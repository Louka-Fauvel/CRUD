<?php
require_once('connect.php');
include "functions.php";

if(isset($_POST)){
    if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['domain']) && !empty($_POST['domain'])
        && isset($_POST['aliases']) && !empty($_POST['aliases'])){
        $id = strip_tags($_GET['id']);
        $nom = strip_tags($_POST['name']);
        $domain = strip_tags($_POST['domain']);
        $alias = strip_tags($_POST['aliases']);

        $sql = "UPDATE organization SET name=:name, domain=:domain, aliases=:aliases WHERE id=:id;";

        $query = $db->prepare($sql);

        $query->bindValue(':name', $nom, PDO::PARAM_STR);
        $query->bindValue(':domain', $domain, PDO::PARAM_STR);
        $query->bindValue(':aliases', $alias, PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();

        header('Location: index.php');
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM organization WHERE id=:id;";

    $query = $db->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetch();
}

require_once('close.php');

getHeader('Modifier une organisation','bg-secondary rounded-bottom');
echo "<form method='post'>
      <div class='form-group'>
            <label for='name'>Nom</label>";
echo "      <input class='form-control' type='text' name='name' id='name' value='".$result['name']."'>
      </div>
      <div class='form-group'>
            <label for='domain'>Domain</label>";
echo "      <input class='form-control' type='text' name='domain' id='domain' value='".$result['domain']."'>
      </div>
      <div class='form-group'>
            <label for='aliases'>Alias</label>";
echo "      <input class='form-control' type='text' name='aliases' id='aliases' value='".$result['aliases']."'>
      </div>
      <div class='form-group'>
            <button class='btn btn-dark mb-2'>Enregistrer</button>
      </div>";
echo "  <input type='hidden' name='id' value='".$result['id']."'>
    </form>
    <a class='btn btn-info mb-2' href='index.php'>Retour</a>
</body>
</html>";
?>
