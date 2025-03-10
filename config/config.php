<?php


try{
// host
define("HOST","localhost");

//dbname
define("DBNAME","cafeteria");
//user

define("USER","root");

//pass
define("PASS","");

$connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME."",USER,PASS);

$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$result = "select * from orders ORDER BY created_at DESC";
$sqlQuery=$connection->prepare($result);
$sqlQuery->execute();
$orders=$sqlQuery->fetchAll(PDO::FETCH_ASSOC);
// if ($conn == true){
//     echo "Connected successfully";
// }else{
//     die("Connection failed: ");
// }

}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
 }