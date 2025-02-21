<?php
session_start();
include "config.php";
// Redirect to login if session is not set
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Document</title>
</head>
<body>
<div class="users_content">
        <main>
            <div class="all_editors">
                <?php
                // SQL query to count editors
                $sql = "SELECT COUNT(*) AS total_reporter FROM reporter";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                // Fetch the result
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_reporter = $data['total_reporter'] ?? 0; // Default to 0 if no result
                ?>
                <h1><?php echo $total_reporter; ?></h1>
                <p>Reporters</p>
            </div>  

            <div class="all_category">
                <?php
                // SQL query to count categories
                $sql = "SELECT COUNT(*) AS total_category FROM news_category";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                // Fetch the result
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_category = $data['total_category'] ?? 0; // Default to 0 if no result
                ?>
                <h1><?php echo $total_category; ?></h1>
                <p>Category</p>
            </div>  
            
            <div class="all_users">
                <?php
                // SQL query to count total users
                $sql = "SELECT COUNT(*) AS total_users FROM user";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                // Fetch the result
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_users = $data['total_users'] ?? 0; // Default to 0 if no result
                ?>
                <h1><?php echo $total_users; ?></h1>
                <p>Users</p>
            </div>  
            
            <div class="all_post">
                <?php
                // SQL query to count total posts
                $sql = "SELECT COUNT(*) AS total_posts FROM news_articles";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
  
                // Fetch the result
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_posts = $data['total_posts'] ?? 0; // Default to 0 if no result
                ?>
                <h1><?php echo $total_posts; ?></h1>
                <p>Post</p>
            </div>  
        </main>
    </div>
</body>
</html>