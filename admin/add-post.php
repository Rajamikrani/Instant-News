<?php
session_start();
include "config.php";
if (isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
</head>
<style>
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body{
        background-color: #f4f4f4;
    }

    #header_container{
        width: 100%;
        height: 70px;
    }

    #logo_container{
        background-color: blueviolet;
        width: 100%;
        height: 40px;
        display: flex;
        justify-content: space-between;
    }
    
    #nav_container{
        background-color: white;
        width: 100%;
        display: flex;
        justify-content: start;
        padding-left: 20px;
    }

    header nav ul {
         list-style: none;
           display: flex;
     }

     header nav ul li {
         margin-right: 20px;
         padding: 10px;
         font-weight: bolder;
         }
         
     header nav ul li a {
        color: blue;
        text-decoration: none;
     }    

    #logo_img{
        width: 100px;
        height: 30px;
        padding: 5px;
    }
    #logout_img{
        width: 30px;
        height: 30px;
        padding: 5px;
    }

    #logo_div{
       width: 150px;
       height: 30px;
       padding: 10px;
    }

    #logout_div{
       width: 50px;
       height: 30px;
       padding: 10px;
    }

    #form-div{
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    main { 
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: white; 
        align-items: center;
        padding: 20px;
        margin-top: 20px;
        margin-left: 20%;
        margin-right: 20%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     }
  
     .form-group { 
        margin-bottom: 15px;
     }
         .form-group label { 
            display: block; 
            margin-bottom: 5px; 
        } 
        .form-group input[type="text"], 
        .form-group textarea,
         .form-group select,
          .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
          }

          button { 
            background-color: #0073e6;
            color: white;
            border: none; 
            padding: 10px 20px;
            cursor: pointer;
             }

             button:hover {
                 background-color: #005bb5
             }    
         fieldset{
            padding: 40px;
         }    
         legend{
            font-weight: bolder;
            font-size: large;
         }
</style>

<body>
    <header id="header_container">
        <div id="logo_container">
            <div id="logo_div">
                <img id="logo_img" src="logo.jpg" alt="logo">
            </div>
            <div id="logout_div">
              <a href="logout.php">
                 <img id="logout_img" src="logout.png" alt="logout">
              </a>  
            </div>
        </div>
        <div id="nav_container">
            <nav>
                 <ul> 
                    <li><a href="#">POST</a></li> 
                    <li><a href="#">CATEGORY</a></li> 
                    <li><a href="#">USERS</a></li> 
                </ul> 
            </nav>
        </div>
    </header>
    <main>
        <div id="main_container">
            <div id="form-div">
                <form action="">
                    <fieldset>
                    <legend>Add New Post</legend>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id = "title" name = "title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"></textarea>
                    </div>
                    <div class="form-group"> 
                        <label for="category">Category</label> 
                        <select id="category" name="category"> 
                        <option value="">Select Category</option>
                         <option value="entertainment">Entertainment</option> 
                         <option value="sports">Sports</option>
                         <option value="politics">Politics</option>
                        </select>
                     </div> 
                        <div class="form-group"> 
                         <label for="post-image">Post Image</label> 
                         <input type="file" id="post-image" name="post-image">
                     </div>
                     <div id="save">
                        <button type="submit">Save</button>
                     </div>
                </form>
            </fieldset>
            </div>
        </div>
    </main>
</body>
</html>