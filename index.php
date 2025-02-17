<?php 
include "config.php";
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
         </nav>
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
 
 </div>       </div>
</div>
</body>
</html>

 