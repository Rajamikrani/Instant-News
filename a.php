<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <!-- Form handling in PHP

        1. action attribute : opening form tag must have action attribute ,
        location to send form data while submiting form(default same page)
        2. method attribute: opening form tag must have method attribute  ,
        Process to send form data (default get method)
        3. name attribute: form child elements must contain name attribute,
        used to hold field data
        4. data array : $_POST array of method is post
            $_GET array if method is get
    -->
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $err = [];
    if(isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])){
        $name = $_POST['name'];
        if (!preg_match('/^[A-Z][a-z\s]+([A-Z][a-z\s]+)+$/',$name)) {
            $err['name'] = 'Enter valid name';   
        }
    } else {
        $err['name'] = 'Enter name';
    }

    if(isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])){
        $username = $_POST['username'];
        if (!preg_match('/^[\w]+$/',$username)) {
            $err['username'] = 'Enter valid username';   
        }
    } else {
        $err['username'] = 'Enter username';
    }
    
    if(isset($_POST['password']) && !empty($_POST['password'])){
      $password = $_POST['password'];
    } else {
        $err['password'] =  'Enter password';
    }

    if(count($err) == 0){
        //process to check login data
        
    }
}
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" novalidate>
        <fieldset>
            <legend>Login Form</legend>
            <div class="form-group">
                <label>Name:</label><br>
                <input type="text" required name="name" value="<?php echo isset($name)?$name:''; ?>" />
                <span class='error'><?php echo isset($err['name'])?$err['name']:''; ?></span>
            </div>
            <div class="form-group">
                <label>Username:</label><br>
                <input type="text" required name="username" value="<?php echo isset($username)?$username:''; ?>" />
                <span class='error'><?php echo isset($err['username'])?$err['username']:''; ?></span>
            </div>
            <div class="form-group">
                <label>Password:</label><br>
                <input type="password" required name="password">
                <span class='error'><?php echo isset($err['password'])?$err['password']:''; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </fieldset>
    </form>
   



</body>
</html>
