<?php
  $error = [];
  $principal = $rate_of_intrest = $time = $operation = $total = null;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['principal']) && !empty($_POST['principal']) && is_numeric($_POST['principal'])) {
        $principal = $_POST['principal'];
    }
    else {
        $error['principal'] = "Enter Principal Amount";
    }

    if (isset($_POST['rate_of_intrest']) && !empty($_POST['rate_of_intrest']) && is_numeric($_POST['rate_of_intrest'])) {
        $rate_of_intrest = $_POST['rate_of_intrest'];
    }
    else {
        $error['rate_of_intrest'] = "Enter Rate Of Intrest";
    }

    if (isset($_POST['time']) && !empty($_POST['time']) && is_numeric($_POST['time'])) {
        $time = $_POST['time'];
    }
    else {
        $error['time'] = "Enter Time";
    }
    if(isset($_POST['operation'])) {
      $operation = $_POST['operation'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Interest</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        .error {
            color : red;
        }
        span {
            font-size: 12px;
        }       
        h1 {
            padding: 20px;
        }
        .form_div {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding : 20px;
        }
        .input_field {
            padding : 8px;
        }
        .button {
            padding : 5px;
            width: 100%;
            background-color: rgb(43, 14, 66);
            color : white;
        }
        .input {
            padding : 3px;
        }
    </style>
</head>
<body>
    <div class = "form_div">
    <h1>Simple Interest</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "POST">
        <div class = "input">
            <label for="principal">Principal</label> <br>
            <input class = "input_field" type="number" name = "principal" value = "<?php echo htmlspecialchars($principal);?>"> <br>
            <span class = "error"><?php echo isset($error['principal'])? $error['principal'] : "";?></span> <br>
        </div>
        <div class = "input">
            <label for="rate_of_interest">Rate Of Interest</label> <br>
            <input class = "input_field" type="number" name = "rate_of_intrest" value = "<?php echo htmlspecialchars($rate_of_intrest);?>"> <br>
            <span class = "error"><?php echo isset($error['rate_of_intrest'])? $error['rate_of_intrest'] : "";?></span> <br>
        </div>
        <div class = "input">
            <label for="time">Time</label> <br>
            <input class = "input_field" type="number" name = "time" value = "<?php echo htmlspecialchars($time);?>"> <br>
            <span class = "error"><?php echo isset($error['time'])? $error['time'] : "";?></span> <br>
        </div>
        <?php
            if (empty($error)) {
                $calculate = $principal * $rate_of_intrest * $time;
                $calculate = $calculate / 100;
                echo "Interest : $calculate <br>";
                $total = $calculate + $principal;
                echo "Total Plus Interest : $total";
            }
        ?>
            <br>
            <br>
        <div>
        <input  class = "button" type="submit" name = "operation" value = "Calculate">
        </div>
</form>
</div>
</body>
</html>
