<?php
session_start();
require 'config.php';

if (!isset($_SESSION['reporterId'])) {
    die('Access denied');
}

header('Content-Type: text/html');
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
$reporterId = $_SESSION['reporterId'];

try {
    $sql = "SELECT * FROM news_articles 
            WHERE reporter_id = :reporter_id 
            AND (article_title LIKE :search 
                 OR article_content LIKE :search)
            ORDER BY CreatedAt DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':reporter_id' => $reporterId,
        ':search' => '%' . $searchTerm . '%'
    ]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($articles) > 0) {
        foreach ($articles as $article) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($article['article_id']) . '</td>';
            echo '<td>' . htmlspecialchars($article['article_title']) . '</td>';
            echo '<td>' . nl2br(htmlspecialchars($article['article_content'])) . '</td>';
            echo '<td><a href="' . htmlspecialchars($article['article_imageUrl']) . '" target="_blank">View Image</a></td>';
            echo '<td><a href="edit_article.php?id=' . $article['article_id'] . '">Edit</a></td>';
            echo '<td><a href="delete_article.php?id=' . $article['article_id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No articles found matching your search</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="6">Error searching articles</td></tr>';
}
?>