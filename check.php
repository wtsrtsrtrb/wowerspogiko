<?php
session_start(); 
// Create connection
$servername = "localhost";
$usernamev = "sdrugzij_webhookUpdate";
$password = "QD1smiwY7";
$database = "sdrugzij_webhookUpdatedb";
$conn = mysqli_connect($servername, $usernamev, $password, $database);

$sql = mysqli_query($conn, 'SELECT * FROM webhooks WHERE place_id = "'.$_GET["game"].'"');
$row = mysqli_fetch_array($sql);
if($row["place_id"] == null){
    echo "None";
} else {
    echo "Success";
}
?>