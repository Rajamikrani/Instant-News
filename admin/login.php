<?php
// session_start();
// include "config.php";

// $user = $password = "";
// $userErr = $passwordErr = $loginErr = "";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Input sanitization function
//     function text_input($data) {
//         $data = trim($data);
//         $data = htmlspecialchars($data);
//         $data = stripslashes($data);
//         return $data;
//     }

//     // Validate username
//     if (empty($_POST['username'])) {
//         $userErr = "Username is required.";
//     } else {
//         $user = text_input($_POST['username']);
//     }

//     // Validate password
//     if (empty($_POST['password'])) {
//         $passwordErr = "Password is required.";
//     } else {
//         $password = text_input($_POST['password']);
//     }

//     // If no validation errors
//     if (empty($userErr) && empty($passwordErr)) {
//         try {
//             // Hash the password
//             $hashedPassword = hash('sha256', $password);

//             // Query to check user credentials
//             $query = "SELECT * FROM admin WHERE Username = :username AND PasswordHash = :passwordHash";
//             $stmt = $pdo->prepare($query);
//             $stmt->bindParam(':username', $user);
//             $stmt->bindParam(':passwordHash', $hashedPassword);

//             // Execute the query
//             $stmt->execute();

//             // Check if the user exists
//             if ($stmt->rowCount() === 1) {
//                 $_SESSION['username'] = $user;
//                 header("Location: users.php");
//                 exit;
//             } else {
//                 $loginErr = "Invalid username or password.";
//             }
//         } catch (PDOException $e) {
//             $loginErr = "Database error: " . $e->getMessage();
//         }
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="parent_div">
        <div id="logo_div">
            <img id="logo_img"
             src="logo.jpg" 
             alt="Logo">
        </div>
     
        <div id="form_div">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete = "off">
                <div id="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username"  placeholder="Enter Username" id="username-input">
                    <br>
                    <!-- <span id = "err" style = "color:red"><?php echo $userErr;?></span> -->
                </div> 
                <div id="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" id="password-input">
                    <br> 
                    <!-- <span id = "err" style = "color:red"><?php echo $passwordErr;?></span> -->
                </div>
                <div id="form-group" class="login_div">
                  <input type="submit" name = "login" value = "Log In" class = "btn">
                </div>
                <br>
                <!-- <span id = "err" style = "color:red"><?php echo $loginErr;?></span> -->
            </form>
        </div>
    </div>
</body>
</html> 
<?php
session_start();
include "../admin/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Generate hash using SHA256
    $hashed_password = hash('sha256', $password);

    // SQL query for all roles
    $sql = "
        SELECT 'admin' AS role, NULL AS reporterId , NULL AS reporter_category, Username AS username, PasswordHash AS password 
        FROM admin 
        WHERE Username = :username AND PasswordHash = :password
        UNION
        SELECT 'reporter' AS role, reporterId , reporter_category , reporter_username AS username, reporter_password AS password 
        FROM reporter 
        WHERE reporter_username = :username AND reporter_password = :password
        UNION
        SELECT 'user' AS role, NULL AS reporterId ,  NULL AS reporter_category, username, password 
        FROM user 
        WHERE username = :username AND password = :password";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $role = $result['role']; // Identify the role
            $_SESSION['username'] = $username; // Save session

            // Redirect user based on role
            if ($role == 'admin') {
                header('Location: /php_practice/news-site/admin/users.php');
                exit();
            } elseif ($role == 'reporter') {
                if (!empty($result['reporterId'])) { 
                    $_SESSION['reporterId'] = $result['reporterId'];  // Store reporterId
                    $_SESSION['reporter_category'] = $result['reporter_category'];
                } else {
                    $_SESSION['reporterId'] = null;  // Avoid undefined errors
                    $_SESSION['reporter_category'] = null;
                }
<<<<<<< HEAD
                header("Location: http://localhost/php_practice/news-site/reporter/home.php");
=======
                header("Location: http://localhost/php_practice/news-site/reporter/articles.php");
>>>>>>> 76f79100be993b43f49ffc4523ecc7bbb410bedf
                exit();
            } elseif ($role == 'user') {
                header("Location: user_registration.php");
            }
            exit();
        } else {
            echo "<p style='color: red;'>Invalid username or password!</p>";
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
