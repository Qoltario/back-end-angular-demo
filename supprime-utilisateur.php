<?php

include 'header.php';
include 'connexion.php';

$idUtilisateur = $_GET['id'];

$req = $connexion->prepare(
    "DELETE 
    FROM utilisateur 
    WHERE id = :id"
);
$req->execute(["id" => $idUtilisateur]);