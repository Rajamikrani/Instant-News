<?php 
session_start();
include "config.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();  
}
$f_err = $l_err = $u_err = $p_err = $r_err = "";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save'])){
  
        // $first_name = mysqli_real_escape_string($conn , $_POST['first_name']);
        // $last_name = mysqli_real_escape_string($conn , $_POST['last_name']);
        // $username = mysqli_real_escape_string($conn , $_POST['username']);
        // $password = mysqli_real_escape_string($conn , md5($_POST['password']));
        // $role = mysqli_real_escape_string($conn , $_POST['role']);

       if (empty($first_name)) {
        $f_err = "First name is required.";
       }
       else {
        $first_name = mysqli_real_escape_string($conn , $_POST['first_name']);
       }

       if (empty($last_name)) {
        $l_err = "Last name is required.";
       }
       else {
        $last_name = mysqli_real_escape_string($conn , $_POST['last_name']);    
       }
    
       if (empty($username)) {
        $u_err = "Username is required.";
       }
       else {
        $username = mysqli_real_escape_string($conn , $_POST['username']);
       }

       if (empty($password)) {
        $p_err = "Password is required.";
       }
       else {
        $password = mysqli_real_escape_string($conn , md5($_POST['password']));
       }

       if (empty($role)) {
        $r_err = "Role is required.";
       }
       else {
        $role = mysqli_real_escape_string($conn , $_POST['role']);  
       }

        $sql = "SELECT username from users WHERE username = '{$username}'";
        $result = mysqli_query($conn , $sql) or die("Query Failed.");
        if (mysqli_num_rows($result) > 0) {
            echo "<p id = 'err'>Username already exists.</p>";
        }
        else{
            $sql1 = "INSERT INTO users (first_name , last_name , username , password , user_role) 
            Values ('{$first_name}' , '{$last_name}' , '{$username}' , '{$password}' , '{$role}')";
            if (mysqli_query($conn , $sql1)) {
               header("Location:{$hostname}/admin/users.php");
               exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add-user.css">
    <title>Add User</title>
</head>
<body>
  <?php
  include "header.php"; 
  ?>
    <main>
        <div id="main_container">
            <div id="form-div">
                <form action="<?php $_SERVER['PHP_SELF'];?>" method = "POST" autocomplete = "off">
                    <fieldset>

                    <legend>Add User</legend>

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id = "first_name" name = "first_name">
                        <span id = "err"><?php echo $f_err ?></span>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id = "last_name" name = "last_name">
                        <span id = "err"><?php echo $l_err ?></span>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="number" id = "username" name = "username">
                        <br>
                        <span id = "err"><?php echo $u_err ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id = "password" name = "password">
                        <br>
                        <span id = "err"><?php echo $p_err ?></span>
                    </div>

                    <div class="form-group"> 
                        <label for="role">User Role</label> 
                        <select id="role" name="role"> 
                         <option value="">Select Role</option>   
                         <option value="1">Normal User</option> 
                         <option value="2">Admin</option>
                        </select>
                        <br>
                        <span id = "err"><?php echo $r_err ?></span>
                     </div> 
                     
                     <div id="save">
                     <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                     </div>
                </form>
            </fieldset>
            </div>
        </div>
    </main>
</body>
</html>