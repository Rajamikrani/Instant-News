<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>

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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the book data
    $sql = "SELECT * FROM books WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $title = $row["title"];
        $publisher = $row["publisher"];
        $author = $row["author"];
        $edition = $row["edition"];
        $no_of_page = $row["no_of_page"];
        $price = $row["price"];
        $publish_date = $row["publish_date"];
        $isbn = $row["isbn"];
    } else {
        echo "No book found with ID: $id";
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = test_input($_POST["title"]);
    $publisher = test_input($_POST["publisher"]);
    $author = test_input($_POST["author"]);
    $edition = test_input($_POST["edition"]);
    $no_of_page = test_input($_POST["no_of_page"]);
    $price = test_input($_POST["price"]);
    $publish_date = test_input($_POST["publish_date"]);
    $isbn = test_input($_POST["isbn"]);

    // Update the book data
    $sql = "UPDATE books SET title='$title', publisher='$publisher', author='$author', edition='$edition', no_of_page='$no_of_page', price='$price', publish_date='$publish_date', isbn='$isbn' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        echo "<br><a href='edit_books.php'>Back to book list</a>";
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Edit Book</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    Title: <input type="text" name="title" value="<?php echo $title;?>"><br><br>
    Publisher: <input type="text" name="publisher" value="<?php echo $publisher;?>"><br><br>
    Author: <input type="text" name="author" value="<?php echo $author;?>"><br><br>
    Edition: <input type="text" name="edition" value="<?php echo $edition;?>"><br><br>
    Number of Pages: <input type="number" name="no_of_page" value="<?php echo $no_of_page;?>"><br><br>
    Price: <input type="text" name="price" value="<?php echo $price;?>"><br><br>
    Publish Date: <input type="date" name="publish_date" value="<?php echo $publish_date;?>"><br><br>
    ISBN: <input type="text" name="isbn" value="<?php echo $isbn;?>"><br><br>
    <input type="submit" name="submit" value="Update Book">
</form>

</body>
</html>
