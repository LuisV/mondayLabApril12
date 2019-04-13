<?php
include 'DBConnection.php';
session_start();
$conn = getDBConnection();

$parameters = array();
$input = $_POST["data"];
$parameters[":name"]= $input["name"];
$parameters[":major"]= $input["major"];
$parameters[":email"]= $input["email"];
$parameters[":zip"]= $input["zip"];

$sql = "INSERT INTO `users`(`name`, `major`, `email`, `zip`) 
        VALUES ( :name , :major , :email, :zip)";

    $stmt = $conn->prepare($sql);
    $stmt->execute($parameters);
    session_destroy();
    
$sql = "SELECT * from `users`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);
?>