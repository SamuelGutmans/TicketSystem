<div class="container mt-4">
<?php session_start();
if (!$_SESSION['loggedin']) {
    header("Location: login.php");
}
require_once "includeuser.php";
$ticketid = $_GET['id'];

$stmt = $con->prepare("SELECT * FROM tickets WHERE ID=?");
$stmt->bind_param("i", $ticketid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$titel = $row['titel'];
$text = $row['text'];
if (isset($_POST['submit'])){
    $neuertitel = $_POST['titel'];
    $neuertext =$_POST['text'];
    $stmt = $con->prepare("UPDATE tickets SET titel=?, text=? WHERE ID=?");
    $stmt->bind_param("ssi", $neuertitel, $neuertext, $ticketid);

    if ($stmt->execute()){
        echo "<div class='alert alert-success'> Das Ticket wurde erfolgreich geändert</div>";
        echo '<script>
    setTimeout(function () {
    window.location.href = "dashboard.php";
}, 2000);
                    
</script>';
    } else {
        echo "<div class='alert alert-danger'>Es gab ein Fehler beim ändern deines Tickets, versuche es nocheinmal</div>";
        echo '<script>
    setTimeout(function () {
    window.location.href = "dashboard.php";
}, 2000);
                    
</script>';
    }
}
?>
<form method="post">
    <input class="form-control" type="text" name="titel" value="<?=$titel?>" required><br>
    <div class="form-group">

        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text" required><?=$text?></textarea>
    </div>
    <input class="btn btn-primary" type="submit" name="submit" value="Abschicken">
</form>
</div>