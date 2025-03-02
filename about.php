<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>About Us - News Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            NEWS
        </div>
        <nav>
            <ul>
            <?php
            try {
                $stmt = $pdo->query("SELECT CategoryName FROM news_category ORDER BY CreatedAt DESC limit 4");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $categoryName = htmlspecialchars($row['CategoryName']);
                    echo '<li><a href="category.php?name='.urlencode($categoryName).'">'.$categoryName.'</a></li>';
                }
            } catch (PDOException $e) {
                echo '<li><a href="#">Error loading categories</a></li>';
            }
            ?>
            </ul>  
        </nav>
        
        <div id="menu_div">
            <i class="fas fa-bars" id="menubtn"></i>
        </div>
    </div>

    <div id="sidebar_div">
        <!-- Same sidebar as index.php -->
    </div>

    <main class="about-container">
        <section class="about-section">
            <h1>About News Portal</h1>
            <div class="about-content">
                <div class="about-text">
                    <h2>Who We Are</h2>
                    <p>News Portal is a leading digital news platform committed to delivering accurate, timely, and unbiased news from around the globe. Founded in 2023, we've grown to become a trusted source for millions of readers worldwide.</p>
                    
                    <h2>Our Mission</h2>
                    <p>To empower individuals with factual information, foster informed communities, and maintain the highest standards of journalistic integrity in the digital age.</p>
                    
                    <h2>Our Values</h2>
                    <ul class="values-list">
                        <li>Accuracy and Fact-Checking</li>
                        <li>Unbiased Reporting</li>
                        <li>Timely Updates</li>
                        <li>User Privacy Protection</li>
                        <li>Community Engagement</li>
                    </ul>
                </div>
                
                <div class="about-image">
                    <img src="images/news-team.jpg" alt="Our Team">
                </div>
            </div>
            
            <section class="team-section">
                <h2>Meet Our Team</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <img src="images/team1.jpg" alt="Nawed Ahmed">
                        <h3>Nawed Ahmed</h3>
                        <p>Editor-in-Chief</p>
                    </div>
                    <div class="team-member">
                        <img src="images/team2.jpg" alt="Anand Mohan Thakur">
                        <h3>Anand Mohan Thakur</h3>
                        <p>Senior Reporter</p>
                    </div>
                    <div class="team-member">
                        <img src="images/team3.jpg" alt="Raja Mikrani">
                        <h3>Raja Mikrani</h3>
                        <p>Tech Correspondent</p>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer class="site-footer">
        <!-- Same footer as index.php -->
    </footer>

    <script src="index.js"></script>
</body>
</html>