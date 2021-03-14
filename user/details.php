<?php
session_start();

// On inclut la connexion à la base
require_once('../connect.php');
include "../functions.php";

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = strip_tags($_GET['id']);
    // On écrit notre requête SELECT * FROM user WHERE id=:id
    $sql = 'SELECT user.id, user.firstname, user.lastname, user.email, user.password, user.suspended, organization.name FROM user INNER JOIN organization ON user.idOrganization = organization.id WHERE user.id =:id ORDER BY firstname';
    // SELECT user.firstname, organization.name FROM user INNER JOIN organization ON user.idOrganization = organization.id WHERE user.idOrganization = 2 ORDER BY firstname
    // On prépare la requête    SELECT * FROM user INNER JOIN organization ON idOrganization = :id        SELECT `user.firstname`, `organization.name` FROM user INNER JOIN organization ON `user.idOrganization` = `organization.id` WHERE id=:id
    $query = $db->prepare($sql);

    // On attache les valeurs
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On stocke le résultat dans un tableau associatif
    $result = $query->fetch();

    if(!$result){
        //header('Location: index.php');
    }
}else{
    //header('Location: index.php');
}

require_once('../close.php');
$titre="Détails de l'utilisateur : ".$result['firstname'] ." ".$result['lastname'];
getHeader($titre,'CRUD utilisateurs','bg-light');

   echo "
       <table class='table table-striped'>
       <thead class='table-dark'>
               <th>ID</th>
               <th>Prénom</th>
               <th>Nom</th>
               <th>Email</th>
               <th>Mot de passe</th>
               <th>Suspended</th>
               <th>Organization</th>
               <th></th>
       </thead>
           <tbody>";
             echo "<tr>
                       <td>".$result['id']."</td>
                       <td>".$result['firstname']."</td>
                       <td>".$result['lastname']."</td>
                       <td>".$result['email']."</td>
                       <td>".$result['password']."</td>
                       <td>".$result['suspended']."</td>
                       <td>".$result['name']."</td>

                       <td><a class='btn btn-outline-info mb-2' href='user.php'>Retour</a>
                           <a class='btn btn-outline-dark mb-2' href='edit.php?id=".$result['id']."'>Modifier</a>
                           <a class='btn btn-outline-danger mb-2' href='delete.php?id=".$result['id']."'>Supprimer</a></td>

                   </tr>";
         echo "</tbody>
       </table>";

getFooter();
?>
