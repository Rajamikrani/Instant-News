<?php
session_start();
echo "Welcome ".$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="users.css">
    <title>Users</title>
</head>
<body>
     <?php
     include "header.php";
     ?>
    <main>
        <div id="add_user_div">
            <h2 id = "all_user">All Users</h2>
            <button id = "add_user" name = "add_user"><a class = "add-new" href="add-user.php">Add User</a></button>
        </div>
        <div id="user_table">
            <?php
            include "config.php";
            $userProfile = $_SESSION['username'];
            if ($userProfile == true) {
                
            }else {
                header("Location: login.php");
            }
            $sql = "SELECT * FROM users ORDER BY id asc";
            $result = mysqli_query($conn , $sql) or die("Query failed.");
            if (mysqli_num_rows($result) > 0) {
            ?>
            <table id="user_detail" border="1">
                <thead>
                <th>S.N</th>
               <th>Full Name</th>
               <th>User Name</th>
               <th>Role</th>
               <th>Edit</th>
               <th>Delete</th>
               </thead> 
               <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                 ?>   
               <tr>
                <td><?php echo $row['id']; ?></td>
                <td> <?php echo $row['first_name'] ." ". $row['last_name']; ?> </td>
                <td> <?php echo $row['username'];?></td>
                <td> 
                <?php 
                echo $row['user_role'];
                //  if ($row['user_role'] == 1) {
                //     echo "Normal User";
                //  }
                //  else {
                //     echo "Admin";
                //  }
                ?>
                </td>
                <td>
                    <?php 
                        // include "config.php";
                        // $sql = "SELECT * from users where id = $row['id']";
                        // $result = mysqli_query($conn , $sql);
                        // if(mysqli_num_rows($result) > 0){
                        //    header("location: modify.php");
                        // }
                        // exit();
                    ?>
                    <img src="write.png" alt="edit_icon">
                </td>
                <td><img src="delete.png" alt="delete_icon"></td>
               </tr>
               <?php
                }
               ?>
               </tbody>
            </table>
            <?php
            }
            ?>
        </div>
    </main>
</body>
</html>