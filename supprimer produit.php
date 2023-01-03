<?php
$bdd = new PDO('mysql:host=localhost;dbname=salah_tols', 'root', '');
$produit=$_GET['ref'];
$supp=$bdd->prepare("DELETE FROM produits WHERE referenc=?");
$supp->execute(array($produit));
header("location:Page_principale.php");

?>