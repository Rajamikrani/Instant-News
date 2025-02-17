<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "project";

$name = $email = $pass = $phone = $gender = $faculty = "";
$nameErr = $emailErr = $passErr = $phoneErr = $genderErr = $facultyErr = "";

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
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone number is required";
        $valid = false;
    } elseif (!preg_match("/^[0-9]{10,15}$/", $_POST["phone"])) {
        $phoneErr = "Invalid phone number";
        $valid = false;
    } else {
        $phone = test_input($_POST["phone"]);
    }

    // Validate gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $valid = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    // Validate faculty
    if (empty($_POST["faculty"])) {
        $facultyErr = "Faculty is required";
        $valid = false;
    } else {
        $faculty = test_input($_POST["faculty"]);
    }

    // Store in database if valid
    if ($valid) {
        // Hash the password before storing it
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO registrations (name, email, password, phone, gender, faculty)
                VALUES ('$name', '$email', '$hashed_password', '$phone', '$gender', '$faculty')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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

<h2>User Registration</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span style="color:red">* <?php echo $nameErr;?></span><br><br>
    Email: <input type="email" name="email" value="<?php echo $email;?>">
    <span style="color:red">* <?php echo $emailErr;?></span><br><br>
    Password: <input type="password" name="password" value="<?php echo $pass;?>">
    <span style="color:red">* <?php echo $passErr;?></span><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
    <span style="color:red">* <?php echo $phoneErr;?></span><br><br>
    Gender:
    <input type="radio" name="gender" value="Male" <?php if (isset($gender) && $gender=="Male") echo "checked";?>> Male
    <input type="radio" name="gender" value="Female" <?php if (isset($gender) && $gender=="Female") echo "checked";?>> Female
    <input type="radio" name="gender" value="Other" <?php if (isset($gender) && $gender=="Other") echo "checked";?>> Other
    <span style="color:red">* <?php echo $genderErr;?></span><br><br>
    Faculty: <input type="text" name="faculty" value="<?php echo $faculty;?>">
    <span style="color:red">* <?php echo $facultyErr;?></span><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
