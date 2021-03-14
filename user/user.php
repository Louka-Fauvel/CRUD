<?php
require_once "../connect.php";
include "../functions.php";
// On écrit notre requête
$sql = 'SELECT * FROM user ORDER BY firstname';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

getHeader('Liste des utilisateurs','CRUD utilisateurs','bg-light rounded-bottom');


echo "<a class='btn btn-outline-secondary mb-2' href='../index.php'>Liste des organisations</a>
    <a class='btn btn-outline-primary mb-2' href='add.php'>Ajouter</a>
    <a class='btn btn-outline-info mb-2' href='filtre.php'>Filtrer la liste</a>
    <table class='table table-striped'>
    <thead class='table-dark'>
            <th>Prénom</th>
            <th>Nom</th>
            <th></th>
    </thead>
        <tbody>";

            foreach($result as $utilisateur){

          echo "<tr>

                    <td>".$utilisateur['firstname']."</td>
                    <td>".$utilisateur['lastname']."</td>
                    <td><a class='btn btn-outline-secondary mb-2' href='details.php?id=".$utilisateur['id']."'>Voir</a>
                        <a class='btn btn-outline-dark mb-2' href='edit.php?id=".$utilisateur['id']."'>Modifier</a>
                        <a class='btn btn-outline-danger mb-2' href='delete.php?id=".$utilisateur['id']."'>Supprimer</a></td>

                </tr>";

            }

      echo "</tbody>
    </table>";


getFooter();
require_once "../close.php";
 ?>
