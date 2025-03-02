<?php
include "config.php";
$categoryName = $_GET['name'] ?? '';

try {
    // Get category data
    $stmt = $pdo->prepare("SELECT * FROM news_category WHERE CategoryName = ?");
    $stmt->execute([$categoryName]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get articles for this category
    $articlesStmt = $pdo->prepare("SELECT * FROM news_articles 
                                  WHERE CategoryID = ? 
                                  ORDER BY CreatedAt DESC");
    $articlesStmt->execute([$category['CategoryID']]);
    $articles = $articlesStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoryName) ?> News</title>
    <link rel="stylesheet" href="category.css">
 
</head>

<body>
<header class="detail-header">
        <h1><?= htmlspecialchars($categoryName) ?> News</h1>
    </header>
    <div id="all_news">
        <div class="page2">
            <div class="news">
                <div class="newsBox">
                    <?php foreach ($articles as $article): ?>
                    <div class="newsCards">
                        <a href="news_detail.php?id=<?= $article['article_id'] ?>">
                            <div class="img">
                                <img src="reporter/<?= htmlspecialchars($article['article_imageUrl']) ?>" 
                                     alt="<?= htmlspecialchars($article['article_title']) ?>">
                            </div>
                            <div class="text">
                                <div class="title">
                                    <p><?= htmlspecialchars($article['article_title']) ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>