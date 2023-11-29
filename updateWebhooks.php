<?php
session_start(); 
// Create connection
$servername = "localhost";
$usernamev = "sdrugzij_webhookUpdate";
$password = "QD1smiwY7";
$database = "sdrugzij_webhookUpdatedb";

$conn = mysqli_connect($servername, $usernamev, $password, $database);

$gameID = $_GET["game"];
$success = $_GET["success"];
$failed = $_GET["failed"];
$visit = $_GET["visit"];
$nbc = $_GET["nbc"];
$premium = $_GET["premium"];
$disc = $_GET["disc"];

$sql = mysqli_query($conn, 'SELECT * FROM webhooks WHERE place_id = "'.$gameID.'"');

$row = mysqli_fetch_array($sql);
if($row["place_id"] == null){
    $conn->query("INSERT INTO webhooks (`place_id`, `discord`, `success`, `failed`, `nbc`, `visit`, `premium`) VALUES ('$gameID', '$disc', '$success', '$failed', '$nbc', '$visit', '$premium')");
    echo "Listed";
} else {
    $conn->query("UPDATE `webhooks` SET `discord` = '$disc', `success` = '$success', `failed` = '$failed', `nbc` = '$nbc', `visit` = '$visit', `premium` = '$premium' WHERE place_id = '$gameID'");
    echo "Updated";
}
?>