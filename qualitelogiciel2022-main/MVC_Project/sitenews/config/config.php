<?php
require ("Connection.php");

// List of modules to include in the application
$dConfig['includes']=array('Validation.php');

// Database connection information
$user= 'root';
$pass='';
$dsn='mysql:host=localhost;dbname=locamat;charset=utf8';

// Create an instance of the Connection class to establish a connection to the database
$con=new Connection($dsn,$user,$pass);

// Define views for UserControl application with their respective paths
$vues['erreur']='vues/php/Erreur.php';
$vues['login']='vues/php/Login.php';
$vues['detailMateriel']='vues/php/detailMateriel.php';
$vues['header']='vues/php/header.php';
$vues['materiels']='vues/php/Materiels.php';

