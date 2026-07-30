<?php

$dirs = [
    __DIR__ . '/uploads',
    __DIR__ . '/uploads/destination_gallery',
    __DIR__ . '/uploads/destinations',
    __DIR__ . '/uploads/gallery',
    __DIR__ . '/uploads/settings'
];

foreach ($dirs as $d) {
    if (!is_dir($d)) {
        mkdir($d, 0777, true);
        echo "Created: $d\n";
    } else {
        echo "Exists: $d\n";
    }
}
