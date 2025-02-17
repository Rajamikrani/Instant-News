
<?php
//check for form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $error = [];
    //check Title
    if (isset($_POST['Title']) && !empty($_POST['Title']) && trim($_POST['Title'])) {
        $Title = $_POST['Title'];
    } else {
        $error['Title'] = 'Enter Title';
    }
    //check Code
     if (isset($_POST[ 'Code']) && !empty($_POST[' Code']) && trim($_POST['Code'])) {
         $Code = $_POST['Code'];
    } else {
        $error[ 'Code'] = 'Select Code';
    }


    //check Author
    if (isset($_POST['Author']) && !empty($_POST['Author']) && trim($_POST['Author'])) {
        $Author = $_POST['Author'];
    } else {
        $error['Author'] = 'Enter Author';
    }

    //check Price
    if (isset($_POST['Price']) && !empty($_POST['Price']) && trim($_POST['Price'])) {
        $Price = $_POST['Price'];
    } else {
        $error['Price'] = 'Enter Price';
    }

    //check Pages
    if (isset($_POST['Pages']) && !empty($_POST['Pages']) && trim($_POST['Pages'])) {
        $Pages = $_POST['Pages'];
    } else {
        $error['Pages'] = 'Enter Pages';
    }


    //check Stock
    if (isset($_POST['Stock']) && !empty($_POST['Stock']) && trim($_POST['Stock'])) {
        $Stock = $_POST['Stock'];
    } else {
        $error['Stock'] = 'Enter Stock';
    }

    if(count($error) == 0){
        try{
            $connection = mysqli_connect('localhost','root','','db_pmc_2079_web');
            $insertsql = "insert into tbl_users(name,gender,dob,country,address,mobile,password) 
            values ('$Title','$Code','$Author','$Price','$Pages','$Stock')";
            mysqli_query($connection,$insertsql);
            if($connection->affected_rows== 1 && $connection->insert_id > 0){
                echo 'Record insert success';
            } else {
                echo "Record Insert Failed";
            }
        }catch(Exception $ex){
            echo "Database Error: " . $ex->getMessage();
        }
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Data</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <h1>Book Store</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <centre>
        <fieldset>
            <legend>Book Store Details</legend>
            <div class="form-group">
                <label for="">Title</label><br><br>
                <input type="text" name="Title" value="<?php echo isset($Title)?$Title:''; ?>">
                <span class="error"><?php echo isset($error['Title'])?$error['Title']:''; ?></span>
            </div>
            <div class="form-group">
            <label for="">Code</label><br><br>
            <input type= "text"  name="Code" value="<?php echo isset($Code)?$Code:''; ?>">
            <span class="error"><?php echo isset($error['Code'])?$error['Code']:''; ?></span>
        </div>
            
            <div class="form-group">
                <label for="">Author</label><br><br>
                <input type="text" name="Author">
                <span class="error"><?php echo isset($error['Author'])?$error['Author']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Price</label><br><br>
                <input type= "text" name="Price" id="Price">                  
                <span class="error"><?php echo isset($error['Price'])?$error['Price']:''; ?></span>
                </div>

            <div class="form-group">
                <label for="">Pages</label><br><br>
                <input type="text" name="Pages">
                <span class="error"><?php echo isset($error['Pages'])?$error['Pages']:''; ?></span>

            </div>
            <div class="form-group">
                <label for="">Stock</label><br><br>
                <input type="text" name="Stock">
                <span class="error"><?php echo isset($error['Stock'])?$error['Stock']:''; ?></span>
</div>
            <div class="form-group"><br>
                <input type="submit" name="register" value="Register">
            </div>
    </centre>
        </fieldset>
    </form>
</body>
</html>