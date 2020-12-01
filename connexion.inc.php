<?php
function connect(){
    $user = 'dams';
    $pass = 'dams';
    $db_name = 'matchmygame';
    try {
        return $bdd = new PDO('mysql:host=localhost;port=3306;dbname='.$db_name, $user, $pass);

    } 
    catch (PDOException $e) {
        //print "Erreur !: " . $e->getMessage() . "<br/>";
        die("Erreur de connexion à la base de données !");
    }
}

?>