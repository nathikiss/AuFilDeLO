<?php
header('Content-Type: application/json');
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=aufildelo', 'root', 'sio');
    $reponse["connexion"] = true;
    $reponse["message"] = "Connexion à la base réussie";
} catch (PDOException $e) {
    $reponse["connexion"] = true;
    $reponse["message"] = "Connexion à la base impossible";
}
if (!empty($_GET["departement"])) {
    $requete = $pdo->prepare("SELECT * FROM patrimoinefluvial WHERE `departement` LIKE :departement");
    $requete->bindParam(":departement", $_GET['departement']);
    $requete->execute();
} else if (!empty($_GET["commune"])) {
    $commune = $_GET["commune"];
    $requete = $pdo->prepare("SELECT * FROM patrimoinefluvial WHERE `commune` LIKE '$commune'");
    //TO DO
    //$requete->bindParam(":commune",$_GET['commune']);
    $requete->execute();
} else if (!empty($_GET["type"])) {
    $typePont = $_GET["type"];
    $requete = $pdo->prepare("SELECT * FROM patrimoinefluvial WHERE `description` LIKE '%$typePont%'");
    //TO DO
    //$requete->bindParam(":typePont",$_GET['type']);
    //Ajouter Plusieurs critères, quelle requete??
    $requete->execute();
} else {
    $requete = $pdo->prepare("SELECT * FROM `patrimoinefluvial`");
    $requete->execute();
}
if (empty($requete)) {
    $reponse["resultats"] = "Votre requête n'existe pas";
} else {
    $resultats = $requete->fetchAll();
    $reponse["connexion"] = true;
    $reponse["message"] = "Connexion à la base réussie";
    $reponse["resultats"] = $resultats;

}
echo json_encode($reponse);