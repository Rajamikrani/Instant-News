<?php
session_start();
include "config.php";

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid Request!'); window.location = 'category.php';</script>";
    exit();
}

$reporterId = $_GET['id'];

// Fetch existing category details 
$sql = "SELECT * FROM reporter WHERE reporterId = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $reporterId);
$stmt->execute();
$reporter = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reporter) {
    echo "<script>alert('Category not found!'); window.location = 'editors.php';</script>";
    exit();
}

if (isset($_POST['updateReporter'])) {
    $reporter_name = htmlspecialchars($_POST['reporter_name']);
    $reporter_email = htmlspecialchars($_POST['reporter_email']);
    $reporter_username = htmlspecialchars($_POST['reporter_username']);
    $reporter_password = htmlspecialchars($_POST['reporter_password']);
    $reporter_category = htmlspecialchars($_POST['reporter_category']);
    // Update query
    $sql = "UPDATE reporter SET reporter_name = :reporterName,
    reporter_email = :reporterEmail ,
    reporter_username = :reporterUsername ,
    reporter_password = :reporterPassword ,
    reporter_category = :reporterCategory
     WHERE reporterId = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reporterName', $reporter_name);
    $stmt->bindParam(':reporterEmail', $reporter_email);
    $stmt->bindParam(':reporterUsername', $reporter_username);
    $stmt->bindParam(':reporterPassword', $reporter_password);
    $stmt->bindParam(':reporterCategory', $reporter_category);
    $stmt->bindParam(':id', $reporterId);

    if ($stmt->execute()) {
        echo "<script>alert('Reporter updated successfully!'); window.location = 'editors.php';</script>";
    } else {
        echo "<script>alert('Error updating Reporter!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reporter</title>
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
    <h2>Edit Reporter</h2>
    <form method="POST" action="">
        <label for="reporter_name">Reporter Name:</label>
        <input type="text" id="reporterName" name="reporter_name" value="<?php echo $reporter['reporter_name']; ?>" required>
        
        <label for="reporter_email">Email:</label>
        <input type="text" id="reporter_email" name="reporter_email" value="<?php echo $reporter['reporter_email']; ?>" required>
        
        <label for="reporter_username">Username:</label>
        <input type="text" id="reporter_username" name="reporter_username" value="<?php echo $reporter['reporter_username']; ?>" required>
        
        <label for="reporter_password">Password:</label>
        <input type="text" id="reporter_password" name="reporter_password" value="<?php echo $reporter['reporter_password']; ?>" required>
        <label for="reporter_category">Category Name</label>

<select name="reporter_category" id="categoryName">
    <?php
    session_start(); // Ensure session_start() is called to access session variables
    $userProfile = $_SESSION['username'] ?? null; // Check if username exists in session
    if (!$userProfile) {
        header("Location: login.php");
        exit; // Add exit to prevent further script execution
    }

    // Assuming $pdo is your PDO connection object
    try {
        $sql = "SELECT * FROM news_category"; // Query to fetch all categories
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Check if rows are returned
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) { // Use fetch instead of FETCH
                ?>
                <option value="<?php echo htmlspecialchars($data['CategoryID']); ?>">
                    <?php echo htmlspecialchars($data['CategoryName']); ?>
                </option>
                <?php
            }
        } else {
            echo '<option value="">No categories available</option>';
        }
    } catch (PDOException $e) {
        echo '<option value="">Error fetching categories</option>';
    }
    ?>
</select>

        <button type="submit" name="updateReporter">Update Category</button>
    </form>
    </div>
  
</body>
</html>
