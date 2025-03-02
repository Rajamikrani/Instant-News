<?php
require "config.php";
$article_id = $_GET['id'] ?? null;

if ($article_id) {
    $stmt = $pdo->prepare("SELECT * FROM news_articles WHERE article_id = ?");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($article['article_title'] ?? 'News Article') ?></title>
    <link rel="stylesheet" href="news_detail.css">
</head>
<header>
    <h1><?= htmlspecialchars($article['article_title']) ?></h1>
    </header>
<body>
    <div class = "data">
    <?php if ($article): ?>
        <img src="reporter/<?= htmlspecialchars($article['article_imageUrl']) ?>" alt="Article image">
        <div class="content">
            <?= htmlspecialchars($article['article_content']) ?>
        </div>
    <?php else: ?>
        <h1>Article not found</h1>
    <?php endif; ?>
    </div>
</body>
</html>