<?php require_once "includeuser.php";?>
<div class="container mt-4">
    <?php session_start();
    if (!$_SESSION['loggedin']) {
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

    $statement = $con->prepare("SELECT * FROM ticketantworten WHERE ticketid=?");
    $statement->bind_param("i", $ticketid);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    $antwort = $row['antwort'];
    ?>
    <form method="post">
        <input class="form-control" type="text" name="titel" value="<?=$titel?>" readonly><br>
        <div class="form-group">

            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text" readonly><?=$text?></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Antwort des Admins</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="antwort" readonly><?=$antwort?></textarea>
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Abschicken">
    </form>
</div>