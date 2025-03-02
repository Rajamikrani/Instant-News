<?php 
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Privacy Policy - News Portal</title>
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

    <main class="privacy-container">
        <article class="privacy-content">
            <h1>Privacy Policy</h1>
            <p class="effective-date">Last Updated: [Insert Date]</p>

            <section class="policy-section">
                <h2>1. Introduction</h2>
                <p>Welcome to News Portal. We are committed to protecting your personal information and your right to privacy. This Privacy Policy explains how we collect, use, and share your personal information when you use our services.</p>
            </section>

            <section class="policy-section">
                <h2>2. Information We Collect</h2>
                <p>We collect information in the following ways:</p>
                <ul class="privacy-list">
                    <li><strong>Information You Provide:</strong> When you create an account, subscribe to newsletters, or contact us.</li>
                    <li><strong>Automatically Collected Information:</strong> Device information, IP address, browser type, and usage data through cookies.</li>
                    <li><strong>Third-Party Information:</strong> Data from social media platforms if you connect your accounts.</li>
                </ul>
            </section>

            <section class="policy-section">
                <h2>3. How We Use Your Information</h2>
                <p>We use the information we collect to:</p>
                <ul class="privacy-list">
                    <li>Provide and improve our services</li>
                    <li>Personalize your experience</li>
                    <li>Send newsletters and updates</li>
                    <li>Analyze website usage patterns</li>
                    <li>Prevent fraudulent activities</li>
                </ul>
            </section>

            <section class="policy-section">
                <h2>4. Cookies and Tracking Technologies</h2>
                <p>We use cookies and similar technologies to:</p>
                <ul class="privacy-list">
                    <li>Remember user preferences</li>
                    <li>Analyze traffic patterns</li>
                    <li>Deliver targeted advertisements</li>
                </ul>
                <p>You can control cookies through your browser settings.</p>
            </section>

            <section class="policy-section">
                <h2>5. Data Sharing and Disclosure</h2>
                <p>We may share information with:</p>
                <ul class="privacy-list">
                    <li>Service providers and business partners</li>
                    <li>Legal authorities when required</li>
                    <li>Third parties during business transfers</li>
                </ul>
            </section>

            <section class="policy-section">
                <h2>6. Your Privacy Rights</h2>
                <p>You have the right to:</p>
                <ul class="privacy-list">
                    <li>Access and update your information</li>
                    <li>Request data deletion</li>
                    <li>Opt-out of marketing communications</li>
                    <li>Withdraw consent for data processing</li>
                </ul>
            </section>

            <section class="policy-section">
                <h2>7. Security Measures</h2>
                <p>We implement security measures including:</p>
                <ul class="privacy-list">
                    <li>SSL encryption</li>
                    <li>Regular security audits</li>
                    <li>Access controls</li>
                    <li>Data anonymization where possible</li>
                </ul>
            </section>

            <section class="policy-section">
                <h2>8. Policy Updates</h2>
                <p>We may update this policy periodically. Significant changes will be notified through our website or email.</p>
            </section>

            <section class="policy-section contact-section">
                <h2>9. Contact Us</h2>
                <p>For privacy-related inquiries, please contact:</p>
                <address>
                    Data Protection Officer<br>
                    Email: <a href="mailto:privacy@newsportal.com">privacy@newsportal.com</a><br>
                    Phone: +1 (555) 123-4567<br>
                    Postal: 123 Privacy Lane, Data City, DC 12345
                </address>
            </section>
        </article>
    </main>

    <footer class="site-footer">
        <!-- Same footer as index.php -->
    </footer>

    <script src="index.js"></script>
</body>
</html>