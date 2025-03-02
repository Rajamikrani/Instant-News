<?php 
include "config.php";
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <title>Document</title>
     <link rel="stylesheet" href="style.css">
 </head>
 <body>
     <div class="header">
         <div class="logo">
            <img src="logo_1.jpg" alt="logo">
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
         
         <div id = "menu_div">
             <i class = "fas fa-bars" id = "menubtn"></i>
         </div>
     </div>


     <div id = "sidebar_div">
         <h2>All Categories</h2>   
         <div id = "categories">
            <ul>
            <?php
         try {
             $stmt = $pdo->query("SELECT CategoryName FROM news_category ORDER BY CreatedAt DESC");
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $categoryName = htmlspecialchars($row['CategoryName']);
                 echo '<li><a href="category.php?name='.urlencode($categoryName).'">'.$categoryName.'</a></li>';
             }
         } catch (PDOException $e) {
             echo '<li><a href="#">Error loading categories</a></li>';
         }
         ?>
            </ul>
       
         </div>
     </div>

<div id = "all_news">
<div class="topHeadlines">
         <div class="left">
         <div class="breaking" id="breakingNews">
             <div class="title">
                <h2>Breaking News</h2> 
             </div>
             <div class="news">
                <!-- News will be loaded here via AJAX --> 
             </div>
           </div>
         </div>
         <div class="right">
         <div id="topHeadlines" class="topNews">
         <div class="title">
             <h2>Top Headlines</h2>
         </div>
         <div class="newsBox">
        <!-- News will be loaded here via AJAX --> 
        </div>
    </div>
</div>
</div>
<hr padding : "10px">

    <div class="page2">
        <div class="news" id="sportsNews">
            <div class="title">
                <h2>Sports News</h2>
            </div>
            <div class="newsBox">
              <!-- News will be loaded here via AJAX --> 
        </div>
      </div>
    <div class="news" id="businessNews">
        <div class="title">
            <h2>Business News</h2>
        </div>
        <div class="newsBox">
          <!-- News will be loaded here via AJAX --> 
         </div>
     </div>     

<div class="news" id="technologyNews">
    <div class="title">
        <h2>Technology News</h2>
    </div>
    <div class="newsBox">
         <!-- News will be loaded here via AJAX --> 
    </div>  
 </div> 


<!-- Add before closing </body> tag -->
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h3>About Us</h3>
            <p>Stay informed with the latest news updates from around the world. Trusted source for breaking news, politics, technology, sports and more.</p>
        </div>
        
        <div class="footer-section links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
        
        <div class="footer-section social">
            <h3>Connect With Us</h3>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2023 News Portal. All rights reserved.</p>
    </div>
</footer>
</div>

<script src = "index.js"></script>
</body>
</html>

 