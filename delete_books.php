<!DOCTYPE html>
<html>
<head>
    <title>Delete Books</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Books List</h2>

<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    // Delete the book
    $sql = "DELETE FROM books WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$sql = "SELECT id, title, publisher, author, edition, no_of_page, price, publish_date, isbn FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Publisher</th>
                <th>Author</th>
                <th>Edition</th>
                <th>No of Pages</th>
                <th>Price</th>
                <th>Publish Date</th>
                <th>ISBN</th>
                <th>Delete</th>
            </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"]. "</td>
                <td>" . $row["title"]. "</td>
                <td>" . $row["publisher"]. "</td>
                <td>" . $row["author"]. "</td>
                <td>" . $row["edition"]. "</td>
                <td>" . $row["no_of_page"]. "</td>
                <td>" . $row["price"]. "</td>
                <td>" . $row["publish_date"]. "</td>
                <td>" . $row["isbn"]. "</td>
                <td><a href='delete_books.php?delete_id=" . $row["id"]. "'>Delete</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
