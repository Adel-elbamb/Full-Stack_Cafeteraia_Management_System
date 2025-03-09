<?php 
$dbType="mysql";
$dbName="cafeteria";
$host="localhost";
$userName="root";
$userPassword="root";
$connection=new PDO("$dbType:host=$host;dbname=$dbName",$userName,$userPassword);
session_start();
?>