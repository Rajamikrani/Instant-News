<?php
// Start the session
session_start();

// Function to store session data
function storeSessionData() {
    $_SESSION["user_id"] = 1;
    $_SESSION["user_name"] = "Raja Mikrani";
    $_SESSION["email"] = "rajamikrani12@gmail.com";
    echo "Session data stored successfully.<br>";
}

// Function to retrieve session data
function retrieveSessionData() {
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["email"])) {
        echo "User ID: " . $_SESSION["user_id"] . "<br>";
        echo "User Name: " . $_SESSION["user_name"] . "<br>";
        echo "Email: " . $_SESSION["email"] . "<br>";
    } else {
        echo "No session data found.<br>";
    }
}

// Function to destroy session data
function destroySessionData() {
    // Remove all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    echo "Session destroyed successfully.<br>";
}

// Determine the action based on query parameters
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'store':
            storeSessionData();
            break;
        case 'retrieve':
            retrieveSessionData();
            break;
        case 'destroy':
            destroySessionData();
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
    <title>Session Manager</title>
</head>
<body>
    <h2>Session Manager</h2>
    <ul>
        <li><a href="?action=store">Store Session Data</a></li>
        <li><a href="?action=retrieve">Retrieve Session Data</a></li>
        <li><a href="?action=destroy">Destroy Session Data</a></li>
    </ul>
</body>
</html>

