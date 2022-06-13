<?php

include 'header.php';
include 'connexion.php';

$req = $connexion->prepare(
    "SELECT * 
    FROM utilisateur"
);
$req->execute();

echo json_encode($req->fetchAll());