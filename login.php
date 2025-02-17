<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "project";

$email = $pass = "";
$emailErr = $passErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
        $valid = false;
    } else {
        $pass = test_input($_POST["password"]);
    }

    // Check credentials if valid
    if ($valid) {
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT id, password FROM registrations WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Check password
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                echo "Login successful! Welcome, user ID: " . $row['id'];
                // Start session or perform further actions
                // session_start();
                // $_SESSION['user_id'] = $row['id'];
                // Redirect to a different page
            } else {
                $loginErr = "Invalid email or password";
            }
        } else {
            $loginErr = "Invalid email or password";
        }
        $conn->close();
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>User Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Email: <input type="text" name="email" value="<?php echo $email;?>">
    <span style="color:red">* <?php echo $emailErr;?></span><br><br>
    Password: <input type="password" name="password" value="<?php echo $pass;?>">
    <span style="color:red">* <?php echo $passErr;?></span><br><br>
    <input type="submit" name="submit" value="Login">
</form>

<span style="color:red"><?php echo $loginErr;?></span>

</body>
</html>
