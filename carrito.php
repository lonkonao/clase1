<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>

<body>
    <h1>Carrito de compra</h1>

    <table border="2">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="carrito"></tbody>
    </table>

    <script>
        async function cargarCarrito() {
            const response = await fetch('verCarrito.php');
            const carrito = await response.json();

            const carritoTBody = document.getElementById('carrito');

            for (const id in carrito) {
                const item = carrito[id];
                const itemRow = document.createElement('tr');

                itemRow.innerHTML = `
                    <td><img src="${item.image}" width="30" /></td>
                    <td>${item.title}</td>
                    <td>$${item.price}</td>
                    <td>${item.quantity}</td>
                    <td>$${item.price * item.quantity}</td>
                `;
                carritoTBody.appendChild(itemRow);
            }
        }
        cargarCarrito();
    </script>
</body>

</html>