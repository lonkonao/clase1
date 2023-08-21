<?php

$filename = 'carrito.xml';

if (!file_exists($filename)) {
    echo json_encode([]);
    exit;
}

// Cargar el XML
$xml = simplexml_load_file($filename);

$carrito = [];

foreach ($xml->producto as $producto) {
    $id = (int)$producto->id;
    $carrito[$id] = [
        'title' => (string)$producto->title,
        'price' => (float)$producto->price,
        'image' => (string)$producto->image,
        'quantity' => (int)$producto->cantidad
    ];
}

echo json_encode($carrito);
