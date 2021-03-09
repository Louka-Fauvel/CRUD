<?php
require_once('../connect.php');
include "../functions.php";

getHeader('Liste des utilisateurs','CRUD utilisateurs','bg-light');

$visible='visible';

if(isset($_POST['chaine'])){
  $visible='invisible';
  $filtre=$_POST['chaine'];

  $sql = "SELECT * FROM user WHERE firstname LIKE '%".$filtre."%'";
  $query = $db->prepare($sql);
  $query->execute();
  $result = $query->fetchAll(PDO::FETCH_ASSOC);

  echo "<a class='btn btn-outline-info mb-2' href='filtre.php'>Retour</a>
      <a class='btn btn-outline-secondary mb-2' href='../index.php'>Liste des organisations</a>
      <a class='btn btn-outline-primary mb-2' href='add.php'>Ajouter</a>
      <a class='btn btn-outline-info mb-2' href='filtre.php'>Filtrer la liste</a>
      <table class='table table-striped'>
      <thead class='table-dark'>
              <th>Prénom</th>
              <th></th>
      </thead>
          <tbody>";

  foreach($result as $orga){

    echo "<tr>

              <td>".$orga['firstname']."</td>

              <td><a class='btn btn-outline-secondary mb-2' href='details.php?id=".$orga['id']."'>Voir</a>
                  <a class='btn btn-outline-dark mb-2' href='edit.php?id=".$orga['id']."'>Modifier</a>
                  <a class='btn btn-outline-danger mb-2' href='delete.php?id=".$orga['id']."'>Supprimer</a></td>

          </tr>";

  }

  echo "</tbody>
  </table>";
}

echo "<br><br>
<div class='$visible'>
    <form method='post'>
    <div class='form-group'>
    <label for='chaine'>Prénom</label>
    <input type='text' name='chaine' id='chaine'>
    <button class='btn btn-outline-info mb-2'>Filtrer</button>
    </div>
    <div class='form-group'>
    <a class='btn btn-outline-info mb-2' href='user.php'>Retour</a>
    </div>
</form></div>";
getFooter();
require_once('../close.php');
?>
