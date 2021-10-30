<?php session_start();
if (!$_SESSION['loggedin']) {
    header("Location: login.php");
}
require_once "includeuser.php";

$ticketid = $_GET['id'];

$stmt = $con->prepare("DELETE FROM tickets WHERE ID=?");
$stmt->bind_param("i", $ticketid);
if ($stmt->execute()){
    header("Location: dashboard.php");
}