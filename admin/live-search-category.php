<?php
    $search_values = $_POST['search'];
    include "config.php";

    $sql = "SELECT * FROM news_category WHERE CategoryName LIKE :search OR Description LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':search' => "%{$search_values}%"]);

    $output = "";
    if ($stmt->rowCount() > 0) {
        $output = "<table border='1' width='100%' cellspacing='0' cellpadding='10px'>
        <tr>
            <th width='60px'>ID</th>
            <th>Category Name</th>
            <th>Description</th>
            <th width='80px'>Edit</th>
            <th width='80px'>Delete</th>
        </tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $output .= "<tr>
                <td align='center'>{$row['CategoryID']}</td>
                <td>{$row['CategoryName']}</td>
                <td>{$row['Description']}</td>
                <td align='center'><a href='edit_category.php?id={$row['CategoryID']}'></a></td>
                <td align='center'><a href='delete_category.php?id={$row['CategoryID']}'>Delete</a></td>
            </tr>";
        }
        $output .= "</table>";
    } else {
        $output = "<h2>No Record Found.</h2>";
    }
    echo $output;
?>




