<!DOCTYPE html>
<html>
<head>
    <title>Interest Calculator</title>
</head>
<body>

<?php
// Initialize variables
$principal = $rate = $time = $simple_interest = $compound_interest = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $principal = isset($_POST['principal']) ? $_POST['principal'] : '';
    $rate = isset($_POST['rate']) ? $_POST['rate'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';

    if (isset($_POST['calculate_simple'])) {
        // Calculate Simple Interest
        $simple_interest = ($principal * $rate * $time) / 100;
    } elseif (isset($_POST['calculate_compound'])) {
        // Calculate Compound Interest
        $compound_interest = $principal * pow((1 + $rate / 100), $time) - $principal;
    }
}
?>

<h2>Interest Calculator</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Principal: <input type="number" name="principal" value="<?php echo $principal; ?>" required><br><br>
    Rate (%): <input type="number" step="0.01" name="rate" value="<?php echo $rate; ?>" required><br><br>
    Time (years): <input type="number" name="time" value="<?php echo $time; ?>" required><br><br>
    
    <button type="submit" name="calculate_simple">Calculate Simple Interest</button>
    <button type="submit" name="calculate_compound">Calculate Compound Interest</button>
</form>

<?php
if ($simple_interest !== "") {
    echo "<h3>Simple Interest: $simple_interest</h3>";
}

if ($compound_interest !== "") {
    echo "<h3>Compound Interest: $compound_interest</h3>";
}
?>

</body>
</html>
