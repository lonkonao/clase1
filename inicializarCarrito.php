<?php

$filename = 'carrito.xml';

if (!file_exists($filename)) {
    $xmlContent = '<?xml version="1.0" encoding="UTF-8"?>
    <carrito>
    </carrito>';

    file_put_contents($filename, $xmlContent);
}

echo json_encode(['status' => 'success']);
