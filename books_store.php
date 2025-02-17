<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $error = [];
    //check Title
    if (isset($_POST['Title']) && !empty($_POST['Title']) && trim($_POST['Title'])) {
        $Title = $_POST['Title'];
    } else {
        $error['Title'] = 'Enter Title';
    }

    if (isset($_POST['Code']) && !empty($_POST['Code']) && trim($_POST['Code'])) {
        $Code = $_POST['Code'];
    } else {
        $error['Code'] = "Enter Code";
    }

    if (isset($_POST['Author']) && !empty($_POST['Author']) && trim($_POST['Author'])) {
        $Author = $_POST['Author'];
    }
    else {
        $error['Author'] = "Enter Author";  
    }

    if (isset($_POST['Price']) && !empty($_POST['Price']) && trim($_POST['Price'])) {
        $Price = $_POST['Price'];
    }
    else {
        $error['Price'] = "Enter Price";
    }

    if (isset($_POST['Pages']) && !empty($_POST{"Pages"}) && trim($_POST['Pages'])) {
        $Pages = $_POST['Pages'];
    }
    else {
        $error['Pages'] = "Enter Pages";
    }

    if (isset($_POST['Stocks']) && !empty($_POST{"Stocks"}) && trim($_POST['Stocks'])) {
        $Stocks = $_POST['Stocks'];
    }
    else {
        $error['Stocks'] = "Enter Stocks";
    }
    if(count($error) == 0){
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_books = "Book_Store";
    
// Create connection
$conn = mysqli_connect($servername, $username, $password , $db_books);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "INSERT INTO book_details(title , code , author , price , pages , stocks)
        VALUE ('$Title' , '$Code' , '$Author ' , '$Price' , '$Pages' , '$Stocks')";
// $sql = "SELECT * FROM book_details where code = '$Code';

if (mysqli_query($conn, $sql)) {
  echo "new recorded inserted successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}

mysqli_close($conn);

    }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color : red;
        }
    </style>
</head>

<body>
    <h1>Book Store</h1>
    <form action="<?php echo htmlspecialchars ($_SERVER["PHP_SELF"]);?>" method = "post">
    <fieldset>
        <legend>Book Information</legend>
        <div class = "form-group">
         <label for="Title">Title</label> <br>
         <input type="text" name = "Title" value = "<?php echo isset($Title) ? $Title :""; ?>">
         <span class = "error"><?php echo isset($error["Title"]) ? $error["Title"] : '';?></span> <br> <br>
        </div>
        <div class = "form-group">
         <label for="Code">Code</label> <br>
         <input type="text" name = "Code" value = "<?php echo isset($Code) ? $Code :""; ?>"> 
         <span class = "error"><?php echo isset($error["Code"]) ? $error["Code"] : '';?></span><br> <br>
        </div>
        <div class = "form-group">
         <label for="Author">Author</label> <br>
         <input type="text" name = "Author" value = "<?php echo isset($Author) ? $Author : "";?>">  
         <span class = "error"><?php echo isset($error['Author']) ? $error['Author'] : '';?></span><br> <br>
        </div>
        <div class = "form-group">
          <label for="Price">Price</label>  <br>
          <input type="text" name = "Price" value = "<?php echo isset($Price) ? $Price : "";?>"> 
          <span class = "error"><?php echo isset($error['Price']) ? $error["Price"] : "";?></span>  <br> <br>
        </div>
        <div class = "form-group">
            <label for="Pages">Pages</label> <br>
            <input type="text" name = "Pages" value = "<?php echo isset($Pages) ? $Pages : ''?>">  
            <span class = "error"><?php echo isset($error['Pages']) ? $error["Pages"] : "";?></span> <br> <br>
        </div>
        <div class = "form-group">
            <label for="Stocks">Stocks</label> <br>
            <input type="text" name = "Stocks" value = "<?php echo isset($Stocks) ? $Stocks : ''?>"> 
            <span class = "error"><?php echo isset($error['Stocks']) ? $error["Stocks"] : "";?></span>  <br> 
        </div>

        <div class="form-group"><br>
                <input type="submit" name="register" value="Register">
            </div>
    </fieldset>
</form>
</body>
</html>