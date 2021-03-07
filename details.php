<?php
session_start();

// On inclut la connexion à la base
require_once('connect.php');
include "functions.php";

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    // On écrit notre requête
    $sql = 'SELECT * FROM organization WHERE id=:id';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On attache les valeurs
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $orga = $query->fetch();

    if(!$orga){
        //header('Location: index.php');
    }
}else{
    //header('Location: index.php');
}

require_once('close.php');
$titre="Détails des organisations : ".$orga['name'];
getHeader($titre,'bg-light');

/*echo "<p>ID : ".$orga['id']."</p>";
echo "<p>Nom : ".$orga['name']."</p>";
echo "<p>Domaine : ".$orga['domain']."</p>";
echo "<p>Alias : ".$orga['aliases']."</p>";
echo "<p><a class='btn btn-outline-info mb-2' href='index.php'>Retour</a>";
   echo "<a class='btn btn-outline-dark mb-2' href='edit.php?id=".$orga['id']."'>Modifier</a>";
   echo "<a class='btn btn-outline-danger mb-2' href='delete.php?id=".$orga['id']."'>Supprimer</a></p>";*/


   echo "
       <table class='table table-striped'>
       <thead class='table-dark'>
               <th>Nom</th>
               <th>Domaine</th>
               <th>Alias</th>
               <th>ID</th>
               <th></th>
       </thead>
           <tbody>";
             echo "<tr>

                       <td>".$orga['name']."</td>
                       <td>".$orga['domain']."</td>
                       <td>".$orga['aliases']."</td>
                       <td>".$orga['id']."</td>

                       <td><a class='btn btn-outline-info mb-2' href='index.php'>Retour</a>
                           <a class='btn btn-outline-dark mb-2' href='edit.php?id=".$orga['id']."'>Modifier</a>
                           <a class='btn btn-outline-danger mb-2' href='delete.php?id=".$orga['id']."'>Supprimer</a></td>

                   </tr>";
         echo "</tbody>
       </table>";

getFooter();
?>
