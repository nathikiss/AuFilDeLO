<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 04/12/2019
 * Time: 20:47
 */

$url="patrimoineFluvial.json";
$data=file_get_contents($url);
$patrimoinesFluviaux=json_decode($data, true);
$nbPatrimoine=0;
foreach ($patrimoinesFluviaux as $patrimoineFluvial){
    $nbPatrimoine++;}
$triPatrimoine=array();
$tabPatrimoine=array();
for ($compt = 0; $compt < $nbPatrimoine; $compt++) {
    if ($patrimoinesFluviaux[$compt]['fields']['elem_princ'] == null){
        $elemPrinc= null;
    }
    else{
        $elemPrinc=$patrimoinesFluviaux[$compt]['fields']['elem_princ'];
    }
    $nomCommunes= $patrimoinesFluviaux[$compt]['fields']['commune'];
    $id= $patrimoinesFluviaux[$compt]['fields']['identifian'];
    $elemPatri=$patrimoinesFluviaux[$compt]['fields']['elem_patri'];
    $triPatrimoine=[
        'id'=>$id, 'Commune' => $nomCommunes, 'Département'=> substr($id,0,2 ),
        'Patrimoine'=>$elemPatri,'Description'=>$elemPrinc
    ];
    $tabPatrimoine[$compt][]=$triPatrimoine;
}
$jsonpart = fopen('patrimoinesFluviauxETL.json', 'w+');
fwrite($jsonpart, json_encode($tabPatrimoine, JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
fclose($jsonpart);
/*AFFICHAGE SUIVI PAR COMMUNE
    $triPatrimoine['Commune'][]=$nomCommunes;
    $triPatrimoine['id'][]=$id;
    $triPatrimoine['Departement'][]= substr($id,0,2 );
    $triPatrimoine['Patrimoine'][]=$elemPatri;
    $triPatrimoine['Description'][]=$elemPrinc;
    */