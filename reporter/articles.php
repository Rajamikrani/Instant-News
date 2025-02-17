<?php
session_start();
require 'config.php'; // Include PDO connection

// Redirect to login if reporter is not logged in
if (!isset($_SESSION['reporterId'])) {
    header("Location: ../admin/login.php");
    exit;
}


$reporter_id = $_SESSION['reporterId']; // Get reporter ID from session
$reporter_category = $_SESSION['reporter_category']; // Get reporter_category from session

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitPost'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $imageUrl = trim($_POST['imageUrl']);

    $errors = [];

    // Validate Title
    if (empty($title)) {
        $errors[] = "Title is required.";
    }

    // Validate Content
    if (empty($content)) {
        $errors[] = "Content is required.";
    }

    // Validate Image URL
    if (empty($imageUrl)) {
        $errors[] = "Image URL is required.";
    }

    // If validation passes, process the form
    if (empty($errors)) {
        try {
            // Insert new post into the database
            $sql = "INSERT INTO news_articles (article_title, article_content, article_imageUrl, reporter_id, CategoryID) 
                    VALUES (:title, :content, :imageUrl, :reporter_id , :reporter_category)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':imageUrl' => $imageUrl,
                ':reporter_id' => $reporter_id, // Add reporter_id from the session
                ':reporter_category' => $reporter_category // Add reporter_category from the ses
            ]);
            echo "<script>alert('Post added successfully!');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error adding Post: " . $e->getMessage() . "');</script>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

// Fetch all articles by the logged-in reporter
try {
    $sql = "SELECT article_id, article_title, article_content, article_imageUrl, CreatedAt 
            FROM news_articles 
            WHERE reporter_id = :reporter_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['reporter_id' => $reporter_id]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body {
    width: 100%;
    height: 100%;
    background-color: #f4f4f4; 
}

#main_div {
    margin-top:4rem;
    margin-left:4rem;
    padding:10px;
    width: 90%;
    max-height: 70%;
    height: 500px;
    background-color: white;
    display: flex;
    flex-direction:column;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#add_article_div {
    display: flex;
    justify-content: space-between;
    align-items: center;
}


.search-container {
      position: relative;
      width: 50px;
      height: 50px;
      /* margin: 100px auto; */
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .search-container input {
      border: 5px solid black;
      background: transparent;
      width: 100%;
      height: 50px;
      margin: auto;
      border-radius: 25px;
      position: relative;
      padding-left: 40px;
      box-sizing: border-box;
      color: black;
      font-weight: bolder;
      font-size: 16px;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .search-container input::placeholder {
      color: black;
    }

    .search-container input:focus {
      outline: none;
    }

    .magnifier {
      position: absolute;
      width: 30px;
      height: 30px;
      top: 10px;
      left: 10px;
      border: 5px solid black;
      border-radius: 50%;
      box-sizing: border-box;
      background: transparent;
      transition: all 0.3s ease;
    }

    .magnifier:after {
      content: '';
      position: absolute;
      width: 10px;
      height: 5px;
      background: black;
      border-radius: 3px;
      transform: rotate(45deg);
      top: 18px;
      left: 20px;
    }

    /* Hover Effect */
    .search-container:hover {
      width: 300px;
      height: 50px;
    }

    .search-container:hover input {
      width: calc(100% - 40px);
      opacity: 1;
    }

    .search-container:hover .magnifier {
      opacity: 0;
      pointer-e vents: none;
    }

    #add_article_div button {
    background-color: #041f43;
    color: white;
    font-weight: bold;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}


/* Popup styles */
.popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    text-align: stat;
    position: relative;
}

.popup-content h2 {
    margin-buttom : 10px;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 30px;
    cursor: pointer;
    color: black;
}

form {
    padding:10px;
    display: flex;
    flex-direction: column;
}

form input, form textarea, form button {
    margin-top: 20px;
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
form textarea {
    max-width: 340px;
    max-height : 300px;
}

.btn-submit {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

table {
    width:100%
}

table th {
    background-color:#041f43;
    color:white;
    padding:10px;
}

    </style>
</head>
<body>
    <?php
    include "header.php";
    ?>
    <div id="main_div">
        <div id = "add_article_div">
            <div id = "heading">
                <h2>All Articles</h2> 
            </div>
            <form action="">
                <div class="search-container">
                  <input type="search" placeholder="Search here..." id = "search">
                  <span class="magnifier"></span>
                </div>
            </form>

            <button id = "open_popup" name = "add_reporter">Add Post</button>
       
        </div>

<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Add New Post</h2>
        <form id="addReporterForm" method="POST" action="">
            <label for="title">Title:</label>
            <input type="text" id="name" name="title" required>

            <label for="content">Content:</label>
            <input type="text" id="email" name="content" required>

            <label for="imageUrl">imageUrl:</label>
            <input type="url" id="username" name="imageUrl" required>

            <button type="submit" name="submitPost" class="btn-submit">Submit</button>
        </form>
    </div>
</div>

        <div id="article_tbl_div">
            <table>
                <thead>
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image Url</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['article_id']); ?></td>
                        <td><?php echo htmlspecialchars($article['article_title']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars(substr($article['article_content'], 0, 100))); ?>...</td>
                        <!-- <td><?php echo htmlspecialchars($article['CreatedAt']); ?></td> -->
                        <td>
                          <a href="<?php echo htmlspecialchars($article['article_imageUrl']); ?>" target="_blank">
                           <?php echo htmlspecialchars($article['article_imageUrl']); ?>
                          </a>
                        </td>
                        <td>
                            <a href="edit_article.php?id=<?php echo $article['article_id']; ?>">Edit</a> |
                        </td>
                        <td>
                        <a href="delete_article.php?id=<?php echo $article['article_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No articles found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
            </table>
        </div>
    </div>
    <script>
// JavaScript for handling popup
  const openPopupBtn = document.getElementById("open_popup");
  const popup = document.getElementById("popup");
  const closeBtn = document.querySelector(".close");

  // Show the popup
  openPopupBtn.addEventListener("click", () => {
      popup.style.display = "flex";
  });

  // Close the popup when the close button is clicked
  closeBtn.addEventListener("click", () => {
      popup.style.display = "none";
  });

  // Close the popup when clicking outside the popup content
  popup.addEventListener("click", (e) => {
      if (e.target === popup) {
          popup.style.display = "none";
      }
  });


         // Live Search
         $("#search").on("keyup", function () {
    var search_term = $(this).val();

    if (search_term.trim() === "") {
        // If search is empty, hide search results and show default data
        $("#table-data").hide();
        $("#default-data").show();
    } else {
        // Perform AJAX call for live search
        $.ajax({
            url: "live-search-reporter.php",
            type: "POST",
            data: { search: search_term },
            success: function (data) {
                $("#table-data").html(data).show(); // Show search results
                $("#default-data").hide(); // Hide default table
            },
            error: function () {
                alert("Error occurred while performing the search.");
            }
        });
    }
});


     </script>
</body>
</html>