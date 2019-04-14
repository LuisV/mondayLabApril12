<?php
include 'DBConnection.php';
session_start();
$conn = getDBConnection();
if($_SESSION["progress"]==2){
$parameters[":name"]= $_SESSION["name"];
$parameters[":major"]= $_SESSION["major"];
$parameters[":email"]= $_SESSION["email"];
$parameters[":zip"]= $_SESSION["zip"];

$sql = "INSERT INTO `users`(`name`, `major`, `email`, `zip`) 
        VALUES ( :name , :major , :email, :zip)";

    $stmt = $conn->prepare($sql);
    $stmt->execute($parameters);
}
session_destroy();

$sql = "SELECT * from `users`";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($records);

?>