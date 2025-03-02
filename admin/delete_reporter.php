<?php
session_start();
include "config.php";
if (!isset($_SESSION['username'])) {
    header("Location : login.php");
    exit();
}
if (isset($_GET["id"])) {
    $id = intval($_GET['id']);
    try {
        $sql = "DELETE  FROM reporter Where reporterId = :id";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(":id" , $id , PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<script> alter('Reporter Deleted successfully.');</script>";
            header("location: editors.php");
        }
        else {
            echo "<script>alert('Error deleting Reporter!');</script>";
        }
    } catch(PDOException $e){
        echo "Error : " .$e->getMessage();
    }
} else {
    echo "Invalid request!";
}
?>


