<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "library";

$title = $publisher = $author = $edition = $no_of_page = $price = $publish_date = $isbn = "";
$titleErr = $publisherErr = $authorErr = $isbnErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Validate title
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
        $valid = false;
    } else {
        $title = test_input($_POST["title"]);
    }

    // Validate publisher
    if (empty($_POST["publisher"])) {
        $publisherErr = "Publisher is required";
        $valid = false;
    } else {
        $publisher = test_input($_POST["publisher"]);
    }

    // Validate author
    if (empty($_POST["author"])) {
        $authorErr = "Author is required";
        $valid = false;
    } else {
        $author = test_input($_POST["author"]);
    }

    // Validate ISBN
    if (empty($_POST["isbn"])) {
        $isbnErr = "ISBN is required";
        $valid = false;
    } else {
        $isbn = test_input($_POST["isbn"]);
    }

    // Other fields
    $edition = test_input($_POST["edition"]);
    $no_of_page = test_input($_POST["no_of_page"]);
    $price = test_input($_POST["price"]);
    $publish_date = test_input($_POST["publish_date"]);

    // Store in database if valid
    if ($valid) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO books (title, publisher, author, edition, no_of_page, price, publish_date, isbn)
                VALUES ('$title', '$publisher', '$author', '$edition', '$no_of_page', '$price', '$publish_date', '$isbn')";

        if ($conn->query($sql) === TRUE) {
            echo "New book added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Add New Book</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Title: <input type="text" name="title" value="<?php echo $title;?>">
    <span style="color:red">* <?php echo $titleErr;?></span><br><br>
    Publisher: <input type="text" name="publisher" value="<?php echo $publisher;?>">
    <span style="color:red">* <?php echo $publisherErr;?></span><br><br>
    Author: <input type="text" name="author" value="<?php echo $author;?>">
    <span style="color:red">* <?php echo $authorErr;?></span><br><br>
    Edition: <input type="text" name="edition" value="<?php echo $edition;?>"><br><br>
    Number of Pages: <input type="number" name="no_of_page" value="<?php echo $no_of_page;?>"><br><br>
    Price: <input type="text" name="price" value="<?php echo $price;?>"><br><br>
    Publish Date: <input type="date" name="publish_date" value="<?php echo $publish_date;?>"><br><br>
    ISBN: <input type="text" name="isbn" value="<?php echo $isbn;?>">
    <span style="color:red">* <?php echo $isbnErr;?></span><br><br>
    <input type="submit" name="submit" value="Add Book">
</form>

</body>
</html>
