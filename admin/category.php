<?php
session_start();
include "config.php";

if (isset($_POST['submitCategory'])) {
    $categoryName = htmlspecialchars($_POST['categoryName']);
    $description = htmlspecialchars($_POST['description']);

    // Prepare SQL query
    $sql = "INSERT INTO news_category (CategoryName, Description) VALUES (:categoryName, :description)";
    $stmt = $pdo->prepare($sql);

    // Bind values
    $stmt->bindParam(':categoryName', $categoryName);
    $stmt->bindParam(':description', $description);

    // Execute query and check for success
    if ($stmt->execute()) {
        echo "<script>alert('Category added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding category!');</script>";
    }
}

// Check user session
$userProfile = $_SESSION['username'];
if (!$userProfile) {
    header("Location: login.php");
    exit();
}

// Pagination setup
$limit = 7; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Get total rows
$totalStmt = $pdo->query("SELECT COUNT(*) FROM news_category");
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Fetch paginated records
$sql = "SELECT * FROM news_category ORDER BY CategoryID ASC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="category.css">

    <title>Users</title>
    <style>

        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

/* Main Content Styling */
.users_content {
    margin-left: 20%; /* Adjust margin to match sidebar width */
    padding: 20px;
    width: 80%;
    padding-top: 90px; /* Avoid overlap with header */
}
/* Main Area Styling */
main {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 100%;
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
      pointer-events: none;
    }

#add_category_div {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

#add_category_div button {
    background-color: #041f43;
    color: white;
    font-weight: bold;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#category_table {
    margin-top: 20px;
    overflow-x: auto;
}

#category_detail {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

#category_detail th, #category_detail td {
    padding: 12px;
    border: 1px solid #e0e0e0;
    transition: background-color 0.3s ease;
}

#category_detail th {
    background-color: #3b5998;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

#category_detail td {
    background-color: #ffffff;
}

#category_detail tbody tr:nth-child(even) {
    background-color: #f5f5f5;
}

#category_detail tbody tr:hover {
    background-color: #eaf3ff;
    cursor: pointer;
}

#category_detail td img {
    width: 24px;
    height: 24px;
    cursor: pointer;
    transition: transform 0.3s ease, filter 0.3s ease;
}

#category_detail td img:hover {
    transform: scale(1.2);
    filter: brightness(1.2);
}

/* Styles for search results */
#table-data {
    margin-top: 20px;
}

#table-data table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

#table-data th, #table-data td {
    padding: 10px;
    border: 1px solid #dcdcdc;
}

#table-data th {
    background-color: #041f43;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#table-data tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

#table-data tbody tr:hover {
    background-color: #e0f7fa;
    transition: background-color 0.2s ease;
}

/* Search input enhancements */
.search-container input {
    width: 100%;
    height: 40px;
    border: 2px solid #041f43;
    border-radius: 20px;
    padding-left: 15px;
    font-size: 16px;
    font-weight: bold;
    color: #041f43;
    transition: border-color 0.3s ease;
}

.search-container input::placeholder {
    color: #999;
}

.search-container input:focus {
    border-color: #3b5998;
    outline: none;
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
}

.btn-submit {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}



#all_category {
    font-size: 1.5rem;
    font-weight: bold;
}

/* Table Styling */
#category_table {
    margin-top: 20px;
    overflow-x: auto;
}

#category_detail {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

#category_detail th, #category_detail td {
    padding: 10px;
    border: 1px solid #ccc;
}

#category_detail th {
    background-color: #041f43;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

#category_detail td {
    background-color: #f9f9f9;
}

#category_detail tbody tr:nth-child(even) {
    background-color: #f1f1f1;
}

#category_detail tbody tr:hover {
    background-color: #dff0ff;
}

/* Icons */
#category_detail td img {
    width: 20px;
    height: 20px;
    cursor: pointer;
    transition: transform 0.2s ease;
}

#category_detail td img:hover {
    transform: scale(1.2);
}

/* Header Styling */
header {
    width: 100%;
    background-color: #01224f;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 1000;
}
#pagination {
    margin: 20px;
    text-align: center;
}

#pagination a {
    margin: 0 5px;
    text-decoration: none;
    color: #041f43;
    font-weight: bold;
    padding: 5px 10px;
    padding-buttom: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

#pagination a:hover {
    background-color: #041f43;
    color: white;
}


/* Responsive Layout */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 25%;
    }

    .users_content {
        margin-left: 25%;
    }

    main {
        width: 100%;
    }

    #add_category {
        padding: 8px 15px;
    }

    #all_category {
        font-size: 1.2rem;
    }

    #category_detail th, #category_detail td {
        padding: 8px;
    }

    #category_detail td img {
        width: 18px;
        height: 18px;
    }
}


    </style>
</head>
<body>
    <?php
    include "header.php";
    include "sidebar.php";
    ?>
    <div class="users_content">
        <main>
        <div id="add_category_div">
            <h2 id = "all_categories">All Categories</h2>

        <div>
          <form action="" method = "post">
             <div class="search-container">
              <input type="search" placeholder="Search here..." id = "search" name = "search">
              <span class="magnifier"></span>
             </div>
          </form>
        </div>

            <button id = "open_popup" name = "add-category">Add Category</button>
        </div>

<!-- Popup Form -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Add New Category</h2>
        <form id="addCategoryForm" method="POST" action="">
            <label for="categoryName">Category Name:</label>
            <input type="text" id="categoryName" name="categoryName" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <button type="submit" name="submitCategory" class="btn-submit">Add Category</button>
        </form>
    </div>
</div>

<div id="table-data">
    <!-- Search results will be loaded here -->
</div>
<div id="default-data">
<div id="category_table">
    <?php if (count($categories) > 0): ?>
        <table id="category_detail" border="1">
            <thead>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead> 
            <tbody> 
               <?php foreach ($categories as $index => $data): ?>
                    <tr>
                        <td><?php echo ($offset + $index + 1); ?></td>
                        <td><?php echo htmlspecialchars($data['CategoryName']); ?></td>
                        <td><?php echo htmlspecialchars($data['Description']); ?></td>
                        <td>
                            <a href="edit_category.php?id=<?php echo $data['CategoryID']; ?>">
                                <i class = "fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="delete_category.php?id=<?php echo $data['CategoryID']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this category?');">
                               <i class = "fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td id="table-data"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>

    <!-- Pagination -->
    <div id="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'style="font-weight:bold;"'; ?>>
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>
</div>


        </main>
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
            url: "live-search-category.php",
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

