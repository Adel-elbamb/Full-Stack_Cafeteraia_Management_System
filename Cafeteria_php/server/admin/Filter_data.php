<?php
include '../../config/config.php';
// var_dump($_GET);
if(isset($_GET['start_date'])&&isset($_GET['end_date'])){
    $start_date=$_GET['start_date'];
    $end_date=$_GET['end_date'];
    $select_sql="SELECT * FROM orders WHERE created_at BETWEEN '$start_date' AND '$end_date'";
    $select_sqlQuery=$conn->prepare($select_sql);
    $select_sqlQuery->execute();
    $orders=$select_sqlQuery->fetchAll(PDO::FETCH_ASSOC);

} 
header("Location:  ../../../../pages/myorder.php"); 
exit();