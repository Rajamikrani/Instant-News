<?php
// Initialize variables
$error = [];
$first_number = $second_number = $operation = $result = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate and retrieve first number
    if (isset($_POST['first_number']) && !empty($_POST['first_number']) && is_numeric($_POST['first_number'])) {
        $first_number = $_POST['first_number'];
    } else {
        $error['first_number'] = "Enter a valid First Number";
    }

    // Validate and retrieve second number
    if (isset($_POST['second_number']) && !empty($_POST['second_number']) && is_numeric($_POST['second_number'])) {
        $second_number = $_POST['second_number'];
    } else {
        $error['second_number'] = "Enter a valid Second Number";
    }

    // Retrieve operation
    if (isset($_POST['operation'])) {
        $operation = $_POST['operation'];
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Simple Calculator</legend>
            <div class="form-group">
                <label for="first_number">Enter First Number:</label><br>
                <input type="number" name="first_number" value="<?php echo htmlspecialchars($first_number); ?>">
                <span class="error"><?php echo isset($error['first_number']) ? $error['first_number'] : ''; ?></span>
            </div>
            <br>
            <div class="form-group">
                <label for="second_number">Enter Second Number:</label><br>
                <input type="number" name="second_number" value="<?php echo htmlspecialchars($second_number); ?>">
                <span class="error"><?php echo isset($error['second_number']) ? $error['second_number'] : ''; ?></span>
            </div>
           
            <h3>
            <?php
                // Perform calculation if no validation errors and operation is valid
    if (empty($error) && in_array($operation, ['add', 'subtract', 'multiply', 'divide'])) {
        switch ($operation) {
            case 'add':
                $result = $first_number + $second_number;
                echo "Addition is: $result";
                break;
            case 'subtract':
                $result = $first_number - $second_number;
                echo "Subtraction is: $result";
                break;
            case 'multiply':
                $result = $first_number * $second_number;
                echo "Multiplication is: $result";
                break;
            case 'divide':
                if ($second_number != 0) {
                    $result = $first_number / $second_number;
                    echo "Division is: $result";
                } else {
                    echo "Cannot divide by zero!";
                }
                break;
            default:
                echo "Invalid operation";
                break;
        }
    }
            ?>
            </h3>
 
            <div class="button">
                <input class="add" type="submit" name="operation" value="add">
                <input class="subtract" type="submit" name="operation" value="subtract">
                <input class="multiply" type="submit" name="operation" value="multiply">
                <input class="divide" type="submit" name="operation" value="divide">
            </div>
        </fieldset>
    </form>
    </div>
</body>
</html>
