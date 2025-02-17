<?php
// Include config.php for the database connection
require_once 'config.php';

// Check if the AJAX request sent a query
if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // SQL query to search across multiple tables
    $sql = "
        SELECT name AS result FROM user WHERE name LIKE :searchTerm
        UNION
        SELECT article_title AS result FROM news_articles WHERE article_title LIKE :searchTerm
        UNION
        SELECT CategoryName AS result FROM news_category WHERE CategoryName LIKE :searchTerm
        LIMIT 10
    ";

    // Prepare the statement
    $stmt = $pdo->prepare($sql);

    // Define the search term with wildcards
    $searchTerm = "%$query%";

    // Bind the search term to the parameter
    $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);

    try {
        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Generate the response
        if (!empty($result)) {
            echo "<ul>";
            foreach ($result as $row) {
                echo "<li>" . htmlspecialchars($row['result']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<ul><li>No matches found</li></ul>";
        }
    } catch (PDOException $e) {
        // Handle any errors during execution
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No query received.";
}
?>
