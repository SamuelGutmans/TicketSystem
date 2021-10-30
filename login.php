<div class="container mt-4">
<?php session_start();
require_once "include.php";
if (isset($_POST['submit'])){
    $benutzername = $_POST['benutzername'];
    $passwort = $_POST['passwort'];

    $stmt = $con->prepare("SELECT * FROM user WHERE benutzername=?");
    $stmt->bind_param("s", $benutzername);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $pw = $row['passwort'];
    $isAdmin = $row['isAdmin'];
    if (password_verify($passwort, $pw)){
        if ($isAdmin == 1){
            echo "<div class='alert alert-success'> Willkommen zurück " . $benutzername . " </div>";
            echo '<script>
                     
setTimeout(function () {
    window.location.href = "dashboardadmin.php";
}, 2000);
                    
</script>';
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] = $row['ID'];
        } else {
            echo "<div class='alert alert-success'> Sie wurden erfolgreich als  " . $benutzername . " eingeloggt </div>";
            echo '<script>
                     
setTimeout(function () {
    window.location.href = "dashboard.php";
}, 2000);
                    
</script>';
            $_SESSION['loggedin'] = true;
            $_SESSION['userid'] = $row['ID'];
        }
    } else {
        echo "<div class='alert alert-danger'> Bitte überprüfen Sie das eingegebene Passwort noch einmal! </div>";
        echo '<script>
                     
setTimeout(function () {
    window.location.href = "login.php";
}, 2000);
                    
</script>';
    }
}

?>

<form method="post">

    <input class="form-control" type = "text" name = "benutzername" placeholder="Benutzername" required><br>
    <input class="form-control" type = "password" name = "passwort" placeholder="Passwort" required><br>
    <input class="btn btn-primary" type = "submit" name="submit" value="Login">
</form>
<p>Du hast noch kein Konto? Erstelle eins hier: <a href="registrieren.php">Registrieren</a></p>
</div>

