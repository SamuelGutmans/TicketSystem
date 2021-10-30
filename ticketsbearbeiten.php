<?php require_once "includeuser.php"; ?>
<div class="container mt-4">
<?php session_start();
if (!$_SESSION['loggedin']) {
    header("Location: login.php");
}


$userid = $_SESSION['userid'];
$stmt = $con->prepare("SELECT * FROM tickets WHERE benutzerID=?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
?>



<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Titel</th>
        <th scope="col">Text</th>
        <th scope="col">Status</th>
        <th scope="col">Bearbeiten</th>
    </tr>
    </thead>
    <tbody>
    <?php

    while ($row = $result->fetch_assoc()) {
        $ID = $row['ID'];
        $titel = $row['titel'];
        $text = $row['text'];
        if ($row['isAnswered'] == 0){
            $status = "Noch nicht bearbeitet";
        } else{
            $status = "Bearbeitet";
        }


        if ($row['isAnswered'] == 1) {


                ?>

                <tr class="table-success">
                    <th scope="row"><?=$ID?></th>
                    <td><?=$titel?></td>
                    <td><?=$text?></td>
                    <td><?=$status?></td>
                    <td>
                        <?php

                        if ($row['benutzerID'] == $userid) {
                            echo
                                '
                                <a href="seeanswer.php?id=' . $ID . '" class="btn btn-primary">Antwort ansehen</a>
                                <a href="editticket.php?id=' . $ID . '" class="btn btn-primary">Editieren</a>
                                <a href="deleteticket.php?id=' . $ID . '"  class="btn btn-primary">Löschen</a>
                                ';
                        }
                        ?>
                    </td>
                </tr>

                <?php

            } else {
                ?>

                <tr class="table-danger">
                    <th scope="row"><?=$ID?></th>
                    <td><?=$titel?></td>
                    <td><?=$text?></td>
                    <td><?=$status?></td>
                    <td>
                        <?php

                        if ($row['benutzerID'] == $userid) {
                            echo
                                '
                                <a href="editticket.php?id=' . $ID . '" class="btn btn-primary">Editieren</a>
                                <a href="deleteticket.php?id=' . $ID . '" class="btn btn-primary">Löschen</a>
                                ';
                        }
                        ?>
                    </td>
                </tr>

                <?php
            }
    } ?>
    </tbody>
</table>

</div>
</div>