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
    $article_id = $_POST['article_id'] ?? 0;

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
    if (empty($_FILES['image']['name'])) {
        $errors[] = "Image is required.";
    }

       // File validation
       if (empty($_FILES['image']['name'])) {
        $errors[] = "Image is required.";
    } else {
        // File size validation (2MB max)
        $maxFileSize = 2 * 1024 * 1024;
        if ($_FILES['image']['size'] > $maxFileSize) {
            $errors[] = "File size exceeds 2MB limit.";
        }
        
        // MIME type validation
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileMimeType = mime_content_type($_FILES['image']['tmp_name']);
        if (!in_array($fileMimeType, $allowedMimeTypes)) {
            $errors[] = "Invalid file type. Only JPG, PNG, and GIF are allowed.";
        }
    }

  // Replace the update block with this corrected code
if ($article_id > 0) {
    try {
        // Start with base SET clause
        $sql = "UPDATE news_articles SET 
                article_title = :title,
                article_content = :content";
        
        $params = [
            ':title' => $title,
            ':content' => $content,
            ':id' => $article_id,
            ':reporter_id' => $reporter_id
        ];

        // Handle image upload if provided
        if (!empty($_FILES['image']['name'])) {
            $targetDir = "uploads/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            
            $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
            $targetFile = $targetDir . $fileName;
            
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $sql .= ", article_imageUrl = :image";
                $params[':image'] = $targetFile;
            } else {
                throw new Exception("File upload failed");
            }
        }

        // Add WHERE clause after SET clause
        $sql .= " WHERE article_id = :id AND reporter_id = :reporter_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        echo "<script>
            alert('Article updated successfully!');
            // window.location.reload();
        </script>";
        
    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "');</script>";
    }
}


    // If validation passes, process the form
    if (empty($errors)) {
       
        try {
            // File upload handling
            $targetDir = "uploads/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $fileName = basename($_FILES["image"]["name"]);
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
            
            // Validate file
                if (!in_array($fileExt, $allowedExts)) {
                throw new Exception("Only JPG, JPEG, PNG & GIF files are allowed.");
             }
                
            $targetFile = $targetDir . uniqid() . "_" . $fileName;

             if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert new post into the database
            $sql = "INSERT INTO news_articles (article_title, article_content, article_imageUrl, reporter_id, CategoryID) 
                    VALUES (:title, :content, :imageUrl, :reporter_id , :reporter_category)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':content' => $content,
                ':imageUrl' => $targetFile,
                ':reporter_id' => $reporter_id, // Add reporter_id from the session
                ':reporter_category' => $reporter_category // Add reporter_category from the ses
            ]);
            echo "<script>alert('Post added successfully!');</script>";
        }
    
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
    $stmt->execute([':reporter_id' => $reporter_id]);
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

    #search-results { display: none; }
    #default-data { display: table-row-group; }
    .loading { display: none; color: #666; padding: 10px; }

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

#current-image-container {
    margin: 10px 0;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#current-image a {
    color: #007bff;
    text-decoration: none;
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
        <h2 id="form-title">Add New Post</h2>
        <form id="articleForm" method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" id="article_id" name="article_id" value="">
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>

            <label for="image">Image:</label>
            <div id="current-image-container" style="display:none">
                <p>Current Image: <span id="current-image"></span></p>
            </div>
            <input type="file" id="image" name="image" accept="image/*">
            
            <button type="submit" name="submitPost" class="btn-submit">Save Article</button>
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
                <tbody id="search-results">
                <div class="loading">Searching articles...</div>
                </tbody>
                <tbody id="default-data">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= htmlspecialchars($article['article_id']) ?></td>
                <td><?= htmlspecialchars($article['article_title']) ?></td>
                <td><?= nl2br(htmlspecialchars($article['article_content'])) ?></td>
                <td>
                    <a href="<?= htmlspecialchars($article['article_imageUrl']) ?>" target="_blank">
                        View Image
                    </a>
                </td>
                <td>
                    <a href="#" class="edit-btn" data-id="<?= $article['article_id'] ?>">Edit</a>
                </td>
                <td>
                    <a href="delete_article.php?id=<?= $article['article_id'] ?>" 
                       onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No articles found.</td>
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

// Add this to your existing JavaScript
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const articleId = this.dataset.id;
        
        fetch(`get_article.php?id=${articleId}`)
            .then(response => response.json())
            .then(article => {
                document.getElementById('form-title').textContent = 'Edit Article';
                document.getElementById('article_id').value = article.article_id;
                document.getElementById('title').value = article.article_title;
                document.getElementById('content').value = article.article_content;
                
                // Show current image
                document.getElementById('current-image-container').style.display = 'block';
                document.getElementById('current-image').innerHTML = 
                    `<a href="${article.article_imageUrl}" target="_blank">View Current Image</a>`;
                
                // Make image input optional for edits
                document.getElementById('image').removeAttribute('required');
                
                popup.style.display = "flex";
            })
            .catch(error => console.error('Error:', error));
    });
});

      // Live Search Implementation
      let searchTimeout;
      const searchInput = document.getElementById('search');
      const defaultData = document.getElementById('default-data');
      const searchResults = document.getElementById('search-results');
      const loading = document.querySelector('.loading');

      function performSearch(searchTerm) {
          if (searchTerm.length === 0) {
              defaultData.style.display = 'table-row-group';
              searchResults.style.display = 'none';
              loading.style.display = 'none';
              return;
          }

          loading.style.display = 'block';
          searchResults.innerHTML = '';
          
          fetch('live-search.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'search=' + encodeURIComponent(searchTerm)
          })
          .then(response => response.text())
          .then(data => {
              defaultData.style.display = 'none';
              searchResults.innerHTML = data;
              searchResults.style.display = 'table-row-group';
              loading.style.display = 'none';
          })
          .catch(error => {
              console.error('Error:', error);
              loading.style.display = 'none';
          });
      }

      searchInput.addEventListener('input', function() {
          clearTimeout(searchTimeout);
          searchTimeout = setTimeout(() => {
              performSearch(this.value.trim());
          }, 300);
      });

 </script>       
</body>
</html>