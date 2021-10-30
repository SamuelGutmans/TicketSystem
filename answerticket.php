<?php require_once "includeadmin.php";?>
<div class="container mt-4">
    <?php session_start();
    if (!$_SESSION['loggedin']) {
        header("Location: login.php");
    }if ($_SESSION['userid'] != 1) {
        header("Location: login.php");
    }
    $ticketid = $_GET['id'];

    $stmt = $con->prepare("SELECT * FROM tickets WHERE ID=?");
    $stmt->bind_param("i", $ticketid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $titel = $row['titel'];
    $text = $row['text'];
    if (isset($_POST['submit'])){
        $antwort = $_POST['antwort'];
        $stmt = $con->prepare("UPDATE tickets SET isAnswered=1 WHERE ID=?");
        $stmt->bind_param("i", $ticketid);
        $stmt->execute();
        $statement = $con->prepare("INSERT INTO ticketantworten(antwort, ticketid) VALUES(?,?)");
        $statement->bind_param("si", $antwort, $ticketid);
        $statement->execute();
        if ($stmt->execute()){
            echo "<div class='alert alert-success'>Auf das Ticket wurde erfolgreich geantwortet</div>";
            echo '<script>
    setTimeout(function () {
    window.location.href = "dashboardadmin.php";
}, 2000);
                    
</script>';
        } else {
            echo "<div class='alert alert-danger'>Es gab ein Fehler beim antwortet auf das Ticket</div>";
            echo '<script>
    setTimeout(function () {
    window.location.href = "dashboardadmin.php";
}, 2000);
                    
</script>';
        }
    }
    ?>
    <form method="post">
        <input class="form-control" type="text" name="titel" value="<?=$titel?>" readonly><br>
        <div class="form-group">

            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text" readonly><?=$text?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Antworten</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="antwort"></textarea>
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Abschicken">
    </form>
</div>