<?php
require 'db.class.php';
$DB = new DB();

/* On appel une procedure pour ajouter un produit a la boutique avec les informations du formulaire */
$query = $DB->db->prepare('CALL addArticle(:_name,:_price,:_content,:_Type,:_Dispo,:_Photo)');
$query->bindValue(':_name', $_GET['name'], PDO::PARAM_STR);
$query->bindValue(':_price', $_GET['price'], PDO::PARAM_STR);
$query->bindValue(':_content', $_GET['content'], PDO::PARAM_STR);
$query->bindValue(':_Type', $_GET['Type'], PDO::PARAM_STR);
$query->bindValue(':_Dispo', $_GET['Dispo'], PDO::PARAM_STR);
$query->bindValue('_Photo', $_GET['Photo'], PDO::PARAM_STR);
$query->execute();
header("Location:addArticle.php");
