<?php
header("Content-Type: application/json");
require "config.php"; // Database connection

try {
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    if (empty($category)) {
        throw new Exception("Category parameter is required");
    }

    $stmt = $pdo->prepare("SELECT 
            na.article_id, 
            na.article_title, 
            na.article_imageUrl,
            na.article_content,
            na.CreatedAt,
            nc.CategoryName
        FROM news_articles na
        JOIN news_category nc ON na.CategoryID = nc.CategoryID
        WHERE nc.CategoryName = :category
        ORDER BY na.CreatedAt DESC 
        LIMIT 3");

    $stmt->execute([':category' => $category]);
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($news)) {
        echo json_encode(['error' => 'No articles found in this category']);
    } else {
        echo json_encode($news);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>