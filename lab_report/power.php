<?php
$errNum = "";
$num = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if(!empty($_POST['num']) && is_numeric($_POST["num"]) && isset($_POST["num"]) ){
    $num = $_POST["num"];
   }
   else {
    $errNum = "Enter the number";
   }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST" >
        Enter Number : <input type="number" name = "num" value = "<?php echo $num ?>">
        <span style = "Color.red"><?php echo $errNum; ?></span>
        <button name = "submit" >Submit</button>
    </form>
</body>
</html>
<?php
if (isset($_POST["submit"])) {
    
    echo $num * $num;
   }
   else {
    $errNum = "An Error";
   }
   ?>