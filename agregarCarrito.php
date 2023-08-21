<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    $filename = 'carrito.xml';

    $xml = simplexml_load_file($filename);

    $productoEncontrado = false;

    foreach ($xml->producto as $producto) {
        if ((int) $producto->id == $id) {
            $producto->cantidad += $quantity;
            $productoEncontrado = true;
            break;
        }
    }

    if (!$productoEncontrado) {
        $producto = $xml->addChild('producto');
        $producto->addChild('id', $id);
        $producto->addChild('title', htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8'));
        $producto->addChild('price', $price);
        $producto->addChild('image', $image);
        $producto->addChild('cantidad', $quantity);
    }
    $xml->asXML($filename);

    echo json_encode(['status' => 'success']);
}
