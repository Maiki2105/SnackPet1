document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('usuarioForm');
    const usuariosDiv = document.getElementById('usuarios');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const id = formData.get('id');
        const url = id ? 'src/php/actualizarUsuario.php' : 'src/php/insertarUsuario.php';
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            form.reset();
            obtenerUsuarios();
        })
        .catch(error => console.error('Error:', error));
    });

    function obtenerUsuarios() {
        fetch('src/php/obtenerUsuarios.php')
            .then(response => response.json())
            .then(data => {
                usuariosDiv.innerHTML = '';
                data.forEach(usuario => {
                    const usuarioDiv = document.createElement('div');
                    usuarioDiv.innerHTML = `
                        <h3>${usuario.nombre}</h3>
                        <p>${usuario.email}</p>
                        <p>${usuario.direccion}</p>
                        <p>${usuario.telefono}</p>
                        <button onclick="eliminarUsuario(${usuario.id})">Eliminar</button>
                        <button onclick="editarUsuario(${usuario.id}, '${usuario.nombre}', '${usuario.email}', '${usuario.direccion}', '${usuario.telefono}')">Editar</button>
                    `;
                    usuariosDiv.appendChild(usuarioDiv);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    obtenerUsuarios();

    window.eliminarUsuario = function(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            fetch('src/php/eliminarUsuario.php', {
                method: 'POST',
                body: new URLSearchParams({ id })
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                obtenerUsuarios();
            })
            .catch(error => console.error('Error:', error));
        }
    };

    window.editarUsuario = function(id, nombre, email, direccion, telefono) {
        form.id.value = id;
        form.nombre.value = nombre;
        form.email.value = email;
        form.direccion.value = direccion;
        form.telefono.value = telefono;
    };
});
