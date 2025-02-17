<?php
session_start();
include "config.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid Request!'); window.location = 'category.php';</script>";
    exit();
}

$categoryID = $_GET['id'];

// Fetch existing category details 
$sql = "SELECT * FROM news_category WHERE CategoryID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $categoryID);
$stmt->execute();
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "<script>alert('Category not found!'); window.location = 'category.php';</script>";
    exit();
}

if (isset($_POST['updateCategory'])) {
    $categoryName = htmlspecialchars($_POST['categoryName']);
    $description = htmlspecialchars($_POST['description']);

    // Update query
    $sql = "UPDATE news_category SET CategoryName = :categoryName, Description = :description WHERE CategoryID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':categoryName', $categoryName);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $categoryID);

    if ($stmt->execute()) {
        echo "<script>alert('Category updated successfully!'); window.location = 'category.php';</script>";
    } else {
        echo "<script>alert('Error updating category!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <!-- <link rel="stylesheet" href="edit_category.css"> -->
     <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    width: 100%;
    height: 100%;
}
.update {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-left: 260px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
form{
    display: flex;
    flex-direction: column;
}

label , input , button , textarea {
    padding: 10px;
    margin-bottom: 10px;
}

.update h2 {
    margin-top: 80px;
    padding: 20px;
}

button:hover {
 background-color: #041f43;
 color: white;
}
     </style>
</head>
<body>
    <?php
        include "header.php";
        include "sidebar.php";
    ?>
    <div class = "update">
    <h2>Edit Category</h2>
    <form method="POST" action="">
        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" value="<?php echo $category['CategoryName']; ?>" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $category['Description']; ?></textarea>
        
        <button type="submit" name="updateCategory">Update Category</button>
    </form>
    </div>
  
</body>
</html>
