<?php

include 'header.php';

$connexion = new PDO("mysql:host=localhost;dbname=angular;charset=UTF8", "root", "pikachu");
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);