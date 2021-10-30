<div class="container mt-4">
<?php
require_once "include.php";
if (isset($_POST['submit'])){
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $benutzername = $_POST['benutzername'];
    $passwort = $_POST['passwort'];
    $email = $_POST['email'];

    $passwort = password_hash($passwort, PASSWORD_DEFAULT);

    $stmt = $con->prepare("SELECT * FROM user WHERE benutzername=?");
    $stmt->bind_param("s", $benutzername);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger'> Der Benutzer " . $benutzername . " existiert bereits</div>";
        echo '<script>
    setTimeout(function () {
    window.location.href = "registrieren.php";
}, 2000);
                    
</script>';

    } else {
        $stmt = $con->prepare("INSERT INTO user(vorname, nachname, benutzername, passwort, email) VALUES(?,?,?,?,?)");
        $stmt->bind_param("sssss", $vorname, $nachname, $benutzername, $passwort, $email);
        if ($stmt->execute()){
            echo "<div class='alert alert-success'> Der Benutzer " . $benutzername . " wurde erfolgreich erstellt</div>";
            echo '<script>
    setTimeout(function () {
    window.location.href = "login.php";
}, 2000);
                    
</script>';
        }
    }
}

?>


<form method="post">

    <input class="form-control" type = "text" name = "vorname" placeholder="Vorname" required><br>
    <input class="form-control" type = "text" name = "nachname" placeholder="Nachname" required><br>
    <input class="form-control" type = "text" name = "benutzername" placeholder="Benutzername" required><br>
    <input class="form-control" type = "password" name = "passwort" placeholder="Passwort" required><br>
    <input class="form-control" type = "email" name = "email" placeholder="Email" required><br>
    <input class="btn btn-primary" type = "submit" name="submit" value="Registrieren">
</form>
    <p>Du hast bereits ein Konto? Melde dich hier an: <a href="login.php">Login</a></p>
</div>
