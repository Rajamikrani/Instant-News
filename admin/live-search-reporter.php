<?php
    $search_values = $_POST['search'];
    include "config.php";

    $sql = "SELECT * FROM reporter WHERE reporter_name LIKE :search OR reporter_email LIKE :search OR reporter_username LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%{$search_values}%"]);

    $output = "";
    if ($stmt->rowCount() > 0) {
        $output = "<table border='1' width='100%' cellspacing='0' cellpadding='5px'>
        <tr>
            <th width='60px'>ID</th>
            <th>Reporter Name</th>
            <th>Reporter Email</th>
             <th>Reporter Username</th>
            <th width='80px'>Edit</th>
            <th width='80px'>Delete</th>
        </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= "<tr>
                <td align='center'>{$row['reporterId']}</td>
                <td>{$row['reporter_name']}</td>
                <td>{$row['reporter_email']}</td>
                 <td>{$row['reporter_username']}</td>
                <td align='center'><a href='edit_reporter.php?id={$row['reporterId']}'>Edit</a></td>
                <td align='center'><a href='delete_reporter .php?id={$row['reporterId']}'>Delete</a></td>
            </tr>";
        }
        $output .= "</table>";
    } else {
        $output = "<h2>No Record Found.</h2>";
    }
    echo $output;
?>




