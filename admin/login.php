<?php
session_start();
include "config.php";
$user = $password = "";
$userErr = $passwordErr = $loginErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true;
  
    function text_input($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
      }
      
  if(empty($_POST['username'])){
    $userErr = "Username is required.";
    $valid = false;
  }
  elseif (!is_numeric($_POST['username'])) {
    $userErr = "Invalid Username";
    $valid = false;
  }
  else {
    $user = text_input(mysqli_real_escape_string($conn , $_POST['username']));
  }

  if (empty($_POST['password'])) {
     $passwordErr = "Password is required.";
     $valid = false;
  }
  else {
    $password = text_input(mysqli_real_escape_string($conn , md5($_POST['password'])));
  }

  $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$password'"; 
  $result = mysqli_query($conn, $sql);
  $total = mysqli_num_rows($result);
  if ($total == 1) {
    $_SESSION['username'] = $user;
    header("Location: users.php");
  }
  else {
    echo "Login Failed.";
  }
}
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
                    <span id = "err" style = "color:red"><?php echo $userErr;?></span>
                </div> 
                <div id="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter Password" id="password-input">
                    <br> 
                    <span id = "err" style = "color:red"><?php echo $passwordErr;?></span>
                </div>
                <div id="form-group" class="login_div">
                  <input type="submit" name = "login" value = "Log In" class = "btn">
                </div>
                <br>
                <span id = "err" style = "color:red"><?php echo $loginErr;?></span>
            </form>
        </div>
    </div>
</body>
</html> 