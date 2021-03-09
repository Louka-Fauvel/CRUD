<?php
require_once('connect.php');
include "functions.php";
if(isset($_POST)){
    if(isset($_POST['name']) && !empty($_POST['name'])){
            $nom = strip_tags($_POST['name']);
            $domain = strip_tags($_POST['domain']);
            $aliases = strip_tags($_POST['aliases']);

            $sql = "INSERT INTO organization(name, domain, aliases) VALUES (:name, :domain, :aliases);";

            $query = $db->prepare($sql);

            $query->bindValue(':name', $nom, PDO::PARAM_STR);
            $query->bindValue(':domain', $domain, PDO::PARAM_STR);
            $query->bindValue(':aliases', $aliases, PDO::PARAM_STR);

            $query->execute();
            $_SESSION['message'] = "Produit ajouté avec succès !";
            header('Location: index.php');
        }
}

require_once('close.php');

getHeader('Ajout d\'une organisation','CRUD Organisations','bg-secondary rounded-bottom');

echo "<form method='post'>
    <div class='form-group'>
    <label for='name'>Nom</label>
    <input class='form-control' type='text' name='name' id='name'>
    </div>
    <div class='form-group'>
    <label for='domain'>Domain</label>
    <input class='form-control' type='text' name='domain' id='domain'>
    </div>
    <div class='form-group'>
    <label for='aliases'>Alias</label>
    <input class='form-control' type='text' name='aliases' id='aliases'>
    </div>
    <button class='btn btn-success mb-2'>Enregistrer</button>
</form>
<a class='btn btn-info mb-2' href='index.php'>Retour</a>";

getFooter();
?>
