<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Productos</h1>
    <a href="carrito.php">Ver Carrito</a>
    <div id="products"></div>

    <script>
        async function inicializarCarritoXML() {
            const response = await fetch('inicializarCarrito.php');
            // Puedes agregar aquí lógica adicional si es necesario
        }

        async function cargarProductos() {
            const response = await fetch('https://fakestoreapi.com/products');
            const products = await response.json();

            const productsDiv = document.getElementById('products');

            for (const product of products) {
                const productDiv = document.createElement('div');
                productDiv.innerHTML = `
                    <h2>${product.title}</h2>
                    <p>Precio: $${product.price}</p>
                    <img src="${product.image}" width="100" />
                    <br>
                    <button  
                    data-id="${product.id}" 
                    data-title="${product.title}" 
                    data-price="${product.price}" 
                    data-image="${product.image}" 
                    onclick="agregarCarrito(this)" 
                    >Agregar al carrito
                    </button>

                `;
                productsDiv.appendChild(productDiv);
            }
        }

        async function agregarCarrito(buttonElement) {
            const id = buttonElement.getAttribute('data-id');
            const title = buttonElement.getAttribute('data-title');
            const price = buttonElement.getAttribute('data-price');
            const image = buttonElement.getAttribute('data-image');

            const response = await fetch('agregarCarrito.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'id': id,
                    'title': title,
                    'price': price,
                    'image': image,
                    'quantity': 1
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            });

            const result = await response.json();

            if (result.status === 'success') {
                alert('Producto agregado al carrito');
            } else {
                alert('Error al agregar el producto al carrito');
            }
        }

        inicializarCarritoXML().then(() => cargarProductos());
    </script>
</body>

</html>