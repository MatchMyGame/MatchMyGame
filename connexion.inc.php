<?php
function connect(){
    $user = 'root';
    $pass = 'root';
    $db_name = 'matchmygame';
    try {
        return $bdd = new PDO('mysql:host=localhost;matchmygame='.$db_name, $user, $pass);
    } 
    catch (PDOException $e) {
        //print "Erreur !: " . $e->getMessage() . "<br/>";
        die("Erreur de connexion à la base de données !");
    }
}

?>