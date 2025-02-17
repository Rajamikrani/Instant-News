<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method = "post">
        <fieldset>
      <legend>Log In</legend>
        <label for="username">Username</label>
        <input type="text" id = "username" name = "username">
        <br>
        <br>
        <label for="password">Password</label>
        <input type="password" id = "password" name = "password">
        <br>
        <br>
        <button for="submit" id = "submit" name="Save" value = "Submit">Submit</button>
    </fieldset>
    </form>
    <?php
    if(isset($_POST{'Save'})) {
      echo $_POST['username'].'<br>';
      echo $_POST['password'].'<br>';
    }
    ?>
</body>
</html>