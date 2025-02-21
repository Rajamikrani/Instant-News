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
             NEWS
         </div>
         <nav>
             <ul>
             <?php
            try {
                $stmt = $pdo->query("SELECT CategoryName FROM news_category ORDER BY CreatedAt DESC limit 4");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Convert category name into a slug format (replace spaces with hyphens)
                    $slug = strtolower(str_replace(" ", "-", $row['CategoryName'])) . ".php";
                    
                    // Display category as a navigation item
                    echo '<li><a href="' . htmlspecialchars($slug) . '">' . htmlspecialchars($row['CategoryName']) . '</a></li>';
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
                    // Convert category name into a slug format (replace spaces with hyphens)
                    $slug = strtolower(str_replace(" ", "-", $row['CategoryName'])) . ".php";
                    
                    // Display category as a navigation item
                    echo '<li><a href="' . htmlspecialchars($slug) . '">' . htmlspecialchars($row['CategoryName']) . '</a></li>';
                }
            } catch (PDOException $e) {
                echo '<li><a href="#">Error loading categories</a></li>';
            }
            ?>
            </ul>
       
         </div>
     </div>



     <div class="topHeadlines">
         <div class="left">
             <div class="title">
                <h2>Breaking News</h2> 
             </div>
             <div class="img" id="breakingImg"></div>
             <div class="text" id="breakingNews">
                 <div class="title">
                    <h2>Lorem ipsum dolor sit amet consectetur
                      adipisicing elit.</h2>  
                 </div>
                 <div class="description">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                 </div>
             </div>
         </div>
         <div class="right">
         <div class="title">
             <h2>Top Headlines</h2>
         </div>
         <div class="topNews">
             <div class="news">
                 <div class="img"></div>
                     <div class="text">
                         <div class="title">
                             Lorem ipsum dolor sit amet,
                              consectetur adipisicing elit. 
                         </div>
                     </div>
                 </div>
                 <div class="news">
                     <div class="img"></div>
                         <div class="text">
                             <div class="title">
                                 Lorem ipsum dolor sit amet,
                                  consectetur adipisicing elit. 
                             </div>
                         </div>
                     </div>    <div class="news">
                         <div class="img"></div>
                             <div class="text">
                                 <div class="title">
                                     Lorem ipsum dolor sit amet,
                                      consectetur adipisicing elit. 
                                 </div>
                             </div>
                         </div>    <div class="news">
                             <div class="img"></div>
                                 <div class="text">
                                     <div class="title">
                                         Lorem ipsum dolor sit amet,
                                          consectetur adipisicing elit. 
                                     </div>
                                 </div>
                             </div>    <div class="news">
                                 <div class="img"></div>
                                     <div class="text">
                                         <div class="title">
                                             Lorem ipsum dolor sit amet,
                                              consectetur adipisicing elit. 
                                         </div>
                                     </div>
                                 </div>    <div class="news">
                                     <div class="img"></div>
                                         <div class="text">
                                             <div class="title">
                                                 Lorem ipsum dolor sit amet,
                                                  consectetur adipisicing elit. 
                                             </div>
                                         </div>
                                     </div>    <div class="news">
                                         <div class="img"></div>
                                             <div class="text">
                                                 <div class="title">
                                                    
                                                    Lorem ipsum dolor sit amet,
                                                     consectetur adipisicing elit. 
                                                </div>
                                            </div>
                                        </div> 
                    <div class="news">
                        <div class="img"></div>
                            <div class="text">
                                <div class="title">
                                    Lorem ipsum dolor sit amet,
                                     consectetur adipisicing elit. 
                                </div>
                            </div>
                        </div>
                         <div class="news">
                            <div class="img"></div>
                                <div class="text">
                                    <div class="title">
                                        Lorem ipsum dolor sit amet,
                                         consectetur adipisicing elit. 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="news">
                        <div class="img"></div>
                            <div class="text">
                                <div class="title">
                                    Lorem ipsum dolor sit amet,
                                     consectetur adipisicing elit. 
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </div>
    <div class="page2">
        <div class="news" id="sportsNews">
            <div class="title">
                <h2>Sports News</h2>
            </div>
            <div class="newsBox">
                <div class="newsCards">
                    <div class="img"></div>
                    <div class="text">
                         <div class="title">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
                    </div>
                    </div>
                   
                </div>
                <div class="newsCards">
                    <div class="img"></div>
                    <div class="text">
                         <div class="title">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    </div>
                   
                </div>
                <div class="newsCards">
                    <div class="img"></div>
                    <div class="text">
                         <div class="title">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                    </div>
                    </div>
                   
                </div>  <div class="newsCards">
                    <div class="img"></div>
                    <div class="text">
                         <div class="title">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    </div>
                   
                </div>  <div class="newsCards">
                    <div class="img"></div>
                    <div class="text">
                         <div class="title">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    </div>
         
         </div>       </div>
    </div>
    <div class="news" id="businessNews">
        <div class="title">
            <h2>Business News</h2>
        </div>
        <div class="newsBox">
            <div class="newsCards">
                <div class="img"></div>
                <div class="text">
                     <div class="title">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
                </div>
                </div>

               
            </div>
            <div class="newsCards">
                <div class="img"></div>
                <div class="text">
                     <div class="title">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                </div>
               
            </div>
            <div class="newsCards">
                <div class="img"></div>
                <div class="text">
                     <div class="title">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                </div>
                </div>
               
            </div>  <div class="newsCards">
                <div class="img"></div>
                <div class="text">
                     <div class="title">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                </div>
               
            </div>  <div class="newsCards">
                <div class="img"></div>
                <div class="text">
                     <div class="title">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                </div>
     
     </div>       </div>
</div>
<div class="news" id="technologyNews">
    <div class="title">
        <h2>Technology News</h2>
    </div>
    <div class="newsBox">
        <div class="newsCards">
            <div class="img"></div>
            <div class="text">
                 <div class="title">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit</p>
            </div>
            </div>
           
        </div>
        <div class="newsCards">
            <div class="img"></div>
            <div class="text">
                 <div class="title">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
            </div>
           
        </div>
        <div class="newsCards">
            <div class="img"></div>
            <div class="text">
                 <div class="title">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
            </div>
            </div>
           
        </div>  <div class="newsCards">
            <div class="img"></div>
            <div class="text">
                 <div class="title">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
            </div>
           
        </div>  <div class="newsCards">
            <div class="img"></div>
            <div class="text">
                 <div class="title">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>  
 </div>
</div>
<script src = "index.js"></script>
</body>
</html>

 