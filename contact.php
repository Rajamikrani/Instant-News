<?php 
include "config.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Process form data (configure your email settings)
        $to = "your-email@example.com";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        if (mail($to, $subject, $message, $headers)) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "There was an error sending your message. Please try again.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Contact Us - News Portal</title>
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

    <main class="contact-container">
        <section class="contact-section">
            <h1>Contact Us</h1>
            
            <div class="contact-content">
                <div class="contact-form">
                    <?php if(isset($error)): ?>
                        <div class="alert error"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($success)): ?>
                        <div class="alert success"><?= $success ?></div>
                    <?php endif; ?>

                    <form action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject">
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="6" required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                </div>
                
                <div class="contact-info">
                    <div class="info-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Our Office</h3>
                        <p>123 News Street<br>Media City, MC 4567</p>
                    </div>
                    
                    <div class="info-box">
                        <i class="fas fa-phone"></i>
                        <h3>Phone</h3>
                        <p>+1 (555) 123-4567</p>
                    </div>
                    
                    <div class="info-box">
                        <i class="fas fa-envelope"></i>
                        <h3>Email</h3>
                        <p>contact@newsportal.com</p>
                    </div>
                    
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317715.7119163245!2d-0.381783505963308!3d51.52873519756609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sus!4v1623456789012!5m2!1sen!2sus" 
                            width="100%" 
                            height="300" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <!-- Same footer as index.php -->
    </footer>

    <script src="index.js"></script>
</body>
</html>