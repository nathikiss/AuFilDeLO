<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 04/12/2019
 * Time: 20:47
 */

$url = "patrimoineFluvial.json";
$data = file_get_contents($url);
$patrimoinesFluviaux = json_decode($data, true);
$nbPatrimoine = 0;
foreach ($patrimoinesFluviaux as $patrimoineFluvial) {
    $nbPatrimoine++;
}
$triPatrimoine = array();
$tabPatrimoine = array();
for ($compt = 0; $compt < $nbPatrimoine; $compt++) {
    if (empty($patrimoinesFluviaux[$compt]['fields']['elem_princ'])) {
        $elemPrinc = null;
    } else {
        $elemPrinc = $patrimoinesFluviaux[$compt]['fields']['elem_princ'];
    }
    $nomCommunes = $patrimoinesFluviaux[$compt]['fields']['commune'];
    $id = $patrimoinesFluviaux[$compt]['fields']['identifian'];
    $elemPatri = $patrimoinesFluviaux[$compt]['fields']['elem_patri'];
    $triPatrimoine = [
        'id' => $id, 'commune' => $nomCommunes, 'departement' => substr($id, 0, 2),
        'nom_patrimoine' => $elemPatri, 'description' => $elemPrinc
    ];
    $tabPatrimoine[$compt][] = $triPatrimoine;
}
$jsonpart = fopen('patrimoinesFluviauxETL.json', 'w+');
fwrite($jsonpart, json_encode($tabPatrimoine, JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
fclose($jsonpart);
$connect = mysqli_connect("localhost", "root", "sio", "aufildelo");
$sql = "CREATE TABLE patrimoinefluvial(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            commune VARCHAR(30) NOT NULL,
            departement INT(2) NOT NULL,
            nom_patrimoine VARCHAR(150),
            description VARCHAR(500)
            )";
mysqli_query($connect, $sql);

$jsonFile = file_get_contents("patrimoinesFluviauxETL.json");
$array = json_decode($jsonFile, true);
foreach ($array as $secondArray)
{
    foreach ($secondArray as $row)
    {
        $requete = "INSERT INTO patrimoinefluvial(commune, departement, nom_patrimoine, description)
                  VALUES ('" . $row["commune"] . "','" . $row["departement"] . "',
                    '" . $row["nom_patrimoine"] . "','" . $row["description"] . "')";
        mysqli_query($connect, $requete);
    }
}
?>
