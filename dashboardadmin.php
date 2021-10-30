<?php session_start();
if (!$_SESSION['loggedin']) {
    header("Location: login.php");
}if ($_SESSION['userid'] != 1) {
    header("Location: login.php");
}
require_once "includeadmin.php";

$stmt = $con->prepare("SELECT COUNT(*) AS allusers FROM user");
$stmt->execute();
$result = $stmt->get_result();
$allusers = $result->fetch_assoc();

$stmt = $con->prepare("SELECT COUNT(*) AS alltickets FROM tickets");
$stmt->execute();
$result = $stmt->get_result();
$alltickets = $result->fetch_assoc();

$stmt = $con->prepare("SELECT COUNT(*) AS allticketsopen FROM tickets WHERE isAnswered = 0");
$stmt->execute();
$result = $stmt->get_result();
$allticketsopen = $result->fetch_assoc();

$stmt = $con->prepare("SELECT COUNT(*) AS allticketsanswered FROM tickets WHERE isAnswered = 1");
$stmt->execute();
$result = $stmt->get_result();
$allticketsanswered = $result->fetch_assoc();
?>
<div class="card">
    <div class="card-header">
        Users
    </div>
    <div class="card-body">
        <h5 class="card-title">Total Users registered</h5>
        <p class="card-text">Total Users: <?=$allusers['allusers']?></p>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        Tickets
    </div>
    <div class="card-body">
        <h5 class="card-title">Total Tickets written</h5>
        <p class="card-text">Total Tickets: <?=$alltickets['alltickets']?></p>
        <a href="tickets.php" class="btn btn-primary">See tickets</a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        Open Tickets
    </div>
    <div class="card-body">
        <h5 class="card-title">Total Tickets open</h5>
        <p class="card-text">Total Tickets: <?=$allticketsopen['allticketsopen']?></p>
        <a href="tickets.php" class="btn btn-primary">See tickets</a>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        Answered Tickets
    </div>
    <div class="card-body">
        <h5 class="card-title">Total Tickets answered</h5>
        <p class="card-text">Total Tickets: <?=$allticketsanswered['allticketsanswered']?></p>
        <a href="tickets.php" class="btn btn-primary">See tickets</a>
    </div>
</div>