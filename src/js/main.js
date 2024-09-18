document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    const subcategoria = urlParams.get('subcategoria');
    
    if (category && subcategoria) {
        fetchProductsByCategoryAndSubcategoria(category, subcategoria);
    } else if (category) {
        fetchProductsByCategory(category);
    } else {
        fetchProducts(); // Cargar productos por defecto en la página de inicio
    }
});



function fetchProductsByCategoryAndSubcategoria(category, subcategoria) {
    fetch(`../php/fetch_category_products.php?category=${encodeURIComponent(category)}&subcategoria=${encodeURIComponent(subcategoria)}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('product-container');
            container.innerHTML = '';
            data.forEach(product => {
                container.innerHTML += `
                    <div class="product">
                        <img src="../images/${product.image}" alt="${product.name}">
                        <h2>${product.name}</h2>
                        <p>${product.description}</p>
                        <p>$${product.price}</p>
                    </div>
                `;
            });
        })
        .catch(error => console.error('Error fetching products:', error));
}

function fetchProductsByCategory(category) {
    fetch(`../php/fetch_category_products.php?category=${encodeURIComponent(category)}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('product-container');
            container.innerHTML = '';
            data.forEach(product => {
                container.innerHTML += `
                    <div class="product">
                        <img src="../images/${product.image}" alt="${product.name}">
                        <h2>${product.name}</h2>
                        <p>${product.description}</p>
                        <p>$${product.price}</p>
                    </div>
                `;
            });
        })
        .catch(error => console.error('Error fetching products:', error));

        // auth.js
function registerUser(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const direccion = document.getElementById('direccion').value; // Asegúrate de que el campo exista en el formulario
    const telefono = document.getElementById('telefono').value; // Asegúrate de que el campo exista en el formulario

    fetch('api/register.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded' // O 'application/json' si envías JSON
        },
        body: new URLSearchParams({
            nombre: name,
            email: email,
            password: password,
            direccion: direccion,
            telefono: telefono
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'login.html';
        } else {
            alert('Error al registrar: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

}

