<?php
include "../admin/config.php";

$name = $email = $pass = $username = $gender = $dob = "";
$nameErr = $emailErr = $passErr = $usernameErr = $genderErr = $dobErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;

    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
    }

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

    // Validate phone
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
        $valid = false;
    } else {
        $username = test_input($_POST["username"]);
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $valid = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate faculty
    if (empty($_POST["dob"])) {
        $dobErr = "Date of Birth is required";
        $valid = false;
    } else {
        $dob = test_input($_POST["dob"]);
    }
 
    // Store in database if valid
    if ($valid) {
        // Hash the password before storing it
        $hashed_password = sha1($pass , 256);

        $sql = "INSERT INTO user (name, email, username , password , dob , gender)
                VALUES (:name, :email, :username , :password , :dob , :gender)";

        $stmt = $pdo->prepare($sql);
            // Bind values
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':gender', $gender);
            
        if ($stmt->execute()) {
            echo "<script>alert('Your Account is created successfully');</script>";
        } else {
            echo "<script>alert('Username already exists. ');</script>";
        }
        header("location: ../admin/login.php");
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
<h2>User Registration</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span style="color:red">* <?php echo $nameErr;?></span><br><br>
    Email: <input type="email" name="email" value="<?php echo $email;?>">
    <span style="color:red">* <?php echo $emailErr;?></span><br><br>
    Userame: <input type="text" name="username" value="<?php echo $username;?>">
    <span style="color:red">* <?php echo $usernameErr;?></span><br><br>
    Password: <input type="password" name="password" value="<?php echo $pass;?>">
    <span style="color:red">* <?php echo $passErr;?></span><br><br>
    Gender:
    <input type="radio" name="gender" value="Male" <?php if (isset($gender) && $gender=="Male") echo "checked";?>> Male
    <input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender=="Female") echo "checked";?>> Female
    <input type="radio" name="gender" value="Other" <?php if (isset($gender) && $gender=="Other") echo "checked";?>> Other
    <span style="color:red">* <?php echo $genderErr;?></span><br><br>
    Date of Birth:
    <input type="date" name = "dob"  value="<?php echo $dob;?>">
    <span style="color:red">* <?php echo $dobErr;?></span><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
