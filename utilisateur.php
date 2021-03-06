<?php

include 'header.php';
include 'connexion.php';

$idUtilisateur = $_GET['id'];

$req = $connexion->prepare(
    "SELECT * 
    FROM utilisateur 
    WHERE id = :id"
);
$req->execute(['id' => $idUtilisateur]);
$utilisateur = $req->fetch();
echo json_encode($utilisateur);