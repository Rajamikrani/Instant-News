<?php
session_start();
require 'config.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['reporterId'])) {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

try {
    $article_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$article_id) throw new Exception("Invalid article ID");
    
    $stmt = $pdo->prepare("SELECT * FROM news_articles 
                          WHERE article_id = :id 
                          AND reporter_id = :reporter_id");
    $stmt->execute([
        ':id' => $article_id,
        ':reporter_id' => $_SESSION['reporterId']
    ]);
    
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$article) {
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Article not found']);
        exit;
    }
    
    header('Content-Type: application/json');
    echo json_encode($article);

} catch(PDOException $e) {
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(['error' => $e->getMessage()]);
} catch(Exception $e) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(['error' => $e->getMessage()]);
}