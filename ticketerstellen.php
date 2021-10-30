<?php session_start();
require_once "include.php";
require_once "navbaruser.php";
if (!$_SESSION['loggedin']){
    header("Location: login.php");
}
?>
<div class="container mt-4">
    <?php
if (isset($_POST['submit'])){
    $titel = $_POST['titel'];
    $text = $_POST['text'];
    $userid = $_SESSION['userid'];
    $stmt = $con->prepare("INSERT INTO tickets(titel, text, benutzerID)VALUES(?,?,?)");
    $stmt->bind_param("ssi", $titel, $text, $userid);
    if ($stmt->execute()){
        echo "<div class='alert alert-success'> Das Ticket wurde erfolgreich erstellt und wird so schnell wie möglich bearbeitet</div>";
        echo '<script>
    setTimeout(function () {
    window.location.href = "dashboard.php";
}, 2000);
                    
</script>';
    } else {
        echo "<div class='alert alert-danger'>Es gab ein Fehler beim erstellen deines Tickets, bitte versuche es erneut</div>";
        echo '<script>
   
                    
</script>';
    }
}
?>

<form method="post">
    <input class="form-control" type="text" name="titel" placeholder="Titel" required><br>
    <div class="form-group">

        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text" placeholder="Erzähl uns von deinem Problem" required></textarea>
    </div>
    <input class="btn btn-primary" type="submit" name="submit" value="Abschicken">
</form>
</div>

