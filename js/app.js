document.addEventListener('DOMContentLoaded', function() {
    const usuarioForm = document.getElementById('usuarioForm');
    usuarioForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(usuarioForm);
        fetch('php/insert.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                loadUsuarios();
            } else {
                alert('Error al agregar usuario.');
            }
        });
    });

    function loadUsuarios() {
        fetch('php/select.php')
            .then(response => response.json())
            .then(data => {
                let usuariosDiv = document.getElementById('usuarios');
                usuariosDiv.innerHTML = '';
                data.forEach(usuario => {
                    let usuarioElement = document.createElement('p');
                    usuarioElement.textContent = usuario.nombre;
                    usuariosDiv.appendChild(usuarioElement);
                });
            });
    }

    loadUsuarios();
});
