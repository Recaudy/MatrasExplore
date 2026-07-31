<?php
$mysqli = new mysqli("localhost", "root", "", "explore_bangka");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    echo $row[0] . "\n";
}
