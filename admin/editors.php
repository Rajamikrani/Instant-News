<?php
include "config.php";
session_start();
// echo "Welcome ".$_SESSION['username'];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitReporter'])) {
    $name = trim($_POST['reporterName']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $categoryID = trim($_POST['categoryName']);

    $errors = [];

    // Validate Name
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate Username
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Validate Password
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // Validate Category Selection
    if (empty($categoryID)) {
        $errors[] = "Please select a category.";
    }

    // If validation passes, process the form
    if (empty($errors)) {
        try {
            $hashedPassword = hash('sha256', $password); // Hash the password
            $sql = "INSERT INTO reporter (reporter_name, reporter_email,
             reporter_username, reporter_password, reporter_category) 
                    VALUES (:name, :email, :username, :password, :categoryID)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':username' => $username,
                ':password' => $hashedPassword,
                ':categoryID' => $categoryID
            ]);
            echo "<script>alert('Reporter added successfully!');</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error adding Reporter: " . $e->getMessage() . "');</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}


  // Pagination setup
  $limit = 5;
  $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
  $offset = ($page - 1) * $limit;

  // Get total rows
  $totalStmt = $pdo->query("SELECT count(*) from reporter");
  $totalRows = $totalStmt->fetchColumn();
  $totalPages = ceil($totalRows / $limit);

  // Fetch Paginated Records
  $sql = "Select * from reporter order by reporterId asc LIMIT :limit OFFSET :offset";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();
  $reporters = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="editors.css">
    <title>Users</title>

<style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

/* Main Content Styling */
.reporter_content {
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

#add_reporter_div {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
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


#add_reporter_div button {
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



#all_reporter {
    font-size: 1.5rem;
    font-weight: bold;
}

/* Table Styling */
#reporter_table {
    margin-top: 20px;
    overflow-x: auto;
}

#reporter_detail {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

#reporter_detail th, #reporter_detail td {
    padding: 10px;
    border: 1px solid #ccc;
}

#reporter_detail th {
    background-color: #041f43;
    color: white;
    font-weight: bold;
    text-transform: uppercase;
}

#reporter_detail td {
    background-color: #f9f9f9;
}

#reporter_detail tbody tr:nth-child(even) {
    background-color: #f1f1f1;
}

#reporter_detail tbody tr:hover {
    background-color: #dff0ff;
}

/* Icons */
#reporter_detail td img {
    width: 20px;
    height: 20px;
    cursor: pointer;
    transition: transform 0.2s ease;
}

#reporter_detail td img:hover {
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

@media screen and (max-width: 1048px) {
    .sidebar {
        width: 0;
    }
    
    .reporter_content {
        margin-left: 10px;
        width: 100%;
    }
}


/* Responsive Layout */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 0;
    }

    .reporter_content {
        margin-left: 10px;
        width: 100%;
    }

    #reporter_detail th, #reporter_detail td 
        {
            padding : 5px;
        }

    main {
        width: 100%;
    }

    #add_reporter {
        padding: 8px 15px;
    }

    #all_reporter {
        font-size: 1.2rem;
    }

    #reporter_detail th, #reporter_detail td {
        padding: 8px;
    }

    #reporter_detail td img {
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
    <div class="reporter_content">
        <main>
        <div id="add_reporter_div">
            <h2 id = "all_reporter">All Reporters</h2>
        <div>
             <form action="">
                <div class="search-container">
                  <input type="search" placeholder="Search here..." id = "search">
                  <span class="magnifier"></span>
                </div>
            </form>
        </div>
            <button id = "open_popup" name = "add_reporter">Add Reporter</button>
        </div>

        <!-- Popup Form -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Add New Reporter</h2>
        <form id="addReporterForm" method="POST" action="">
            <label for="reporterName">Name:</label>
            <input type="text" id="name" name="reporterName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="categoryName">Category Name:</label>

<select name="categoryName" id="categoryName">
    <?php
    session_start(); // Ensure session_start() is called to access session variables
    $userProfile = $_SESSION['username'] ?? null; // Check if username exists in session
    if (!$userProfile) {
        header("Location: login.php");
        exit; // Add exit to prevent further script execution
    }

    // Assuming $pdo is your PDO connection object
    try {
        $sql = "SELECT * FROM news_category"; // Query to fetch all categories
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Check if rows are returned
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) { // Use fetch instead of FETCH
                ?>
                <option value="<?php echo htmlspecialchars($data['CategoryID']); ?>">
                    <?php echo htmlspecialchars($data['CategoryName']); ?>
                </option>
                <?php
            }
        } else {
            echo '<option value="">No categories available</option>';
        }
    } catch (PDOException $e) {
        echo '<option value="">Error fetching categories</option>';
    }
    ?>
</select>
            <button type="submit" name="submitReporter" class="btn-submit">Submit</button>
        </form>
    </div>
</div>

<div id="table-data">
    <!-- Search results will be loaded here -->
</div>
<div id="default-data">
        <div id="reporter_table">
 
             <?php if (count($reporters) > 0): ?>
            <table id="reporter_detail" border="1">
                <thead>
                <th>S.N</th>
               <th>Full Name</th>
               <th>Email</th>
               <th>User Name</th>
               <!-- <th>Category Name</th> -->
               <th>Edit</th>
               <th>Delete</th>
               </thead> 
               <tbody>
                <?php
                // while ($data = $stmt->fetch(PDO::FETCH_ASSOC) ) {

                 ?>   
                <?php foreach ($reporters as $index => $data): ?>
               <tr>
                <!-- <td><?php echo $data['reporterId']; ?></td> -->
                <td><?php echo ($offset + $index + 1); ?></td>
                <td> <?php echo $data['reporter_name']; ?> </td>
                <td> <?php echo $data['reporter_email']; ?> </td>
                <td> <?php echo $data['reporter_username'];?></td>
                <!-- <td> <?php echo $data['CategoryName']; ?> </td> -->
                <td>
                     <a href="edit_reporter.php?id=<?php echo $data['reporterId']; ?>">
                       <i class = "fas fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a href="delete_reporter.php?id=<?php echo $data['reporterId']; ?>" onclick="return confirm('Are you sure you want to delete this reporter?');">
                    <i class = "fas fa-trash"></i>
                    </a>
                </td>
               </tr>
               <?php
                // }
               ?>
                 <?php endforeach; ?>
               </tbody>
            </table>
            <?php
            // }
            ?>
         <?php else: ?>
        <p>No Reporters found.</p>
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
