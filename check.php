<?php
session_start(); 
// Create connection
$servername = "localhost";
$usernamev = "yywrewvw_helifpro";
$password = "J7YyzQu0Z2";
$database = "yywrewvw_helifpro";
$conn = mysqli_connect($servername, $usernamev, $password, $database);

$sql = mysqli_query($conn, 'SELECT * FROM webhooks WHERE place_id = "'.$_GET["game"].'"');
$row = mysqli_fetch_array($sql);
if($row["place_id"] == null){
    echo "None";
} else {
    echo "Success";
}
?>
