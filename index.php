<?php
require_once "connect.php";
include "functions.php";
// On écrit notre requête
$sql = 'SELECT * FROM organization ORDER BY name';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

getHeader('Liste des organisations','CRUD Organisations','bg-light rounded-bottom');


echo "<a class='btn btn-outline-secondary mb-2' href='user/user.php'>Liste des utilisateurs</a>
    <a class='btn btn-outline-primary mb-2' href='add.php'>Ajouter</a>
    <a class='btn btn-outline-info mb-2' href='filtre.php'>Filtrer la liste</a>
    <table class='table table-striped'>
    <thead class='table-dark'>
            <th>Nom</th>
            <th></th>
    </thead>
        <tbody>";

            foreach($result as $orga){

          echo "<tr>

                    <td>".$orga['name']."</td>

                    <td><a class='btn btn-outline-secondary mb-2' href='details.php?id=".$orga['id']."'>Voir</a>
                        <a class='btn btn-outline-dark mb-2' href='edit.php?id=".$orga['id']."'>Modifier</a>
                        <a class='btn btn-outline-danger mb-2' href='delete.php?id=".$orga['id']."'>Supprimer</a></td>

                </tr>";

            }

      echo "</tbody>
    </table>";

getFooter();
require_once "close.php";
 ?>
