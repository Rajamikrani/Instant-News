<?php
// Function to store cookie data
function storeCookieData() {
    // Set cookies with a lifespan of 1 hour
    setcookie("user_id", "1", time() + 3600, "/");
    setcookie("user_name", "John Doe", time() + 3600, "/");
    setcookie("email", "john.doe@example.com", time() + 3600, "/");
    echo "Cookies have been set successfully.<br>";
}

// Function to retrieve cookie data
function retrieveCookieData() {
    if (isset($_COOKIE["user_id"]) && isset($_COOKIE["user_name"]) && isset($_COOKIE["email"])) {
        echo "User ID: " . $_COOKIE["user_id"] . "<br>";
        echo "User Name: " . $_COOKIE["user_name"] . "<br>";
        echo "Email: " . $_COOKIE["email"] . "<br>";
    } else {
        echo "No cookies found.<br>";
    }
}

// Function to destroy cookie data
function destroyCookieData() {
    // Unset cookies by setting expiration date to one hour ago
    setcookie("user_id", "", time() - 3600, "/");
    setcookie("user_name", "", time() - 3600, "/");
    setcookie("email", "", time() - 3600, "/");
    echo "Cookies have been deleted successfully.<br>";
}

// Determine the action based on query parameters
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'store':
            storeCookieData();
            break;
        case 'retrieve':
            retrieveCookieData();
            break;
        case 'destroy':
            destroyCookieData();
            break;
        default:
            echo "Invalid action.<br>";
            break;
    }
} else {
    echo "No action specified.<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cookie Manager</title>
</head>
<body>
    <h2>Cookie Manager</h2>
    <ul>
        <li><a href="?action=store">Store Cookie Data</a></li>
        <li><a href="?action=retrieve">Retrieve Cookie Data</a></li>
        <li><a href="?action=destroy">Destroy Cookie Data</a></li>
    </ul>
</body>
</html>
