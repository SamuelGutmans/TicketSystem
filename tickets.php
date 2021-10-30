<?php session_start();
if (!$_SESSION['loggedin']) {
    header("Location: login.php");
}if ($_SESSION['userid'] != 1) {
    header("Location: login.php");
}
require_once "includeadmin.php";
?>

<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">User</th>
        <th scope="col">Titel</th>
        <th scope="col">Text</th>
        <th scope="col">Status</th>
        <th scope="col">Bearbeiten</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $stmt = $con->prepare("SELECT * FROM tickets");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $ID = $row['ID'];
        $titel = $row['titel'];
        $text = $row['text'];
        $benutzerid = $row['benutzerID'];
        $stmt = $con->prepare("SELECT * FROM user WHERE ID=?");
        $stmt->bind_param("i", $benutzerid);
        $stmt->execute();
        $result = $stmt->get_result();
        $rowuser = $result->fetch_assoc();
        $username = $rowuser['benutzername'];
        if ($row['isAnswered'] == 0){
            $status = "Noch nicht bearbeitet";
        } else{
            $status = "Bearbeitet";
        }


        if ($row['isAnswered'] == 1) {


                ?>

                <tr class="table-success">
                    <th scope="row"><?=$ID?></th>
                    <td><?=$username?></td>
                    <td><?=$titel?></td>
                    <td><?=$text?></td>
                    <td><?=$status?></td>
                    <td>
                        <?php
                            echo
                                '
                                <a href="answerticket.php?id=' . $ID . '" class="btn btn-primary">Antworten</a>
                                
                                ';

                        ?>
                    </td>
                </tr>

                <?php

            } else {
                ?>

                <tr class="table-danger">
                    <th scope="row"><?=$ID?></th>
                    <td><?=$username?></td>
                    <td><?=$titel?></td>
                    <td><?=$text?></td>
                    <td><?=$status?></td>
                    <td>
                        <?php

                            echo
                                '
                                <a href="answerticket.php?id=' . $ID . '" class="btn btn-primary">Antworten</a>
                                ';
                        ?>
                    </td>
                </tr>

                <?php
            }
    } ?>
    </tbody>
</table>

