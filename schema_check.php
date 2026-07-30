<?php
$pdo = new PDO('mysql:host=localhost;dbname=explore_bangka', 'root', '');
$tables = ['gallery', 'destination_user_galleries', 'destination_images', 'destinations', 'information', 'accommodations'];

foreach ($tables as $table) {
    try {
        $stmt = $pdo->query("DESCRIBE $table");
        echo "$table columns:\n";
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "- " . $row['Field'] . "\n";
        }
        echo "\n";
    } catch (Exception $e) { }
}
