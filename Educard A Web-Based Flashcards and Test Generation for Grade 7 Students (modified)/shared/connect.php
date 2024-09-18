<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "educard";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function executeQuery($query)
{
    $conn = $GLOBALS['conn'];
    return mysqli_query($conn, $query);
}
?>
