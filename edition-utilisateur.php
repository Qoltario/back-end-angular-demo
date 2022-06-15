<?php

include 'header.php';
include 'connexion.php';

$json = $_POST['utilisateur'];

$data = json_decode($json);

$nomImage = null;

if (isset($_FILES) && isset($_FILES['image'])) {

    $pathParts = pathinfo($_FILES['image']['name']);

    $nomImage = 'avatar-' . uniqid() . '.' . $pathParts['extension'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        __DIR__ . "/uploads/" . $nomImage
    );
}
echo "!isset($data->id)";
// si c'est une création d'utilisateur
if (!isset($data->id) || $data->id == null) {

    $requete = $connexion->prepare(
        "INSERT INTO utilisateur (nom, prenom, image, mot_de_passe) 
        VALUES (:nom, :prenom, :image, :mot_de_passe)"
    );

    $requete->execute([
        ":nom" => $data->nom,
        ":prenom" => $data->prenom,
        ":image" => $nomImage,
        ":mot_de_passe" => $data->mot_de_passe
    ]);
} else {
    if ($nomImage) {
        $requete = $connexion->prepare(
            "UPDATE utilisateur 
            SET nom = :nom, prenom = :prenom , image = :image, mot_de_passe = :mot_de_passe 
            WHERE id = :id "
        );

        $requete->execute([
            ":nom" => $data->nom,
            ":prenom" => $data->prenom,
            ":image" => $nomImage,
            ":mot_de_passe" => $data->mot_de_passe,
            ":id" => $data->id
        ]);
    }
    else{
        $requete = $connexion->prepare(
            "UPDATE utilisateur 
            SET nom = :nom, prenom = :prenom ,  mot_de_passe = :mot_de_passe 
            WHERE id = :id "
        );
    
        $requete->execute([
            ":nom" => $data->nom,
            ":prenom" => $data->prenom,
            ":mot_de_passe" => $data->mot_de_passe,
            ":id" => $data->id
        ]);
    }
}

// echo json_encode($data);
