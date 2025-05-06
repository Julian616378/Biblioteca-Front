<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Préstamos</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --color-papel: #f5f5f0;
            --color-tapa: #5d4037;
            --color-lomo: #8d6e63;
            --color-letra: #3e2723;
            --color-acento: #a1887f;
            --color-boton: #6d4c41;
            --color-boton-hover: #8d6e63;
            --color-exito: #2e7d32;
            --color-error: #c62828;
            --color-advertencia: #ff8f00;
            --color-info: #0277bd;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--color-papel);
            color: var(--color-letra);
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }
        
        h1, h2 {
            font-family: 'Merriweather', serif;
            color: var(--color-tapa);
        }
        
        h1 {
            border-bottom: 3px solid var(--color-lomo);
            padding-bottom: 10px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.2rem;
        }
        
        h2 {
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 2px dashed var(--color-acento);
        }
        
        button {
            background-color: var(--color-boton);
            color: white;
            border: none;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        button:hover {
            background-color: var(--color-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .libro-card {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid var(--color-lomo);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .libro-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .prestamo-card {
            background-color: white;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid var(--color-exito);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .prestamo-card:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .resumen-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            border-left: 5px solid var(--color-lomo);
            animation: fadeIn 0.5s ease-out;
        }
        
        .resumen-item {
            margin: 8px 0;
            padding: 8px;
            border-bottom: 1px solid var(--color-papel);
        }
        
        .resumen-item strong {
            color: var(--color-tapa);
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-left: 8px;
        }
        
        .badge-warning {
            background-color: var(--color-advertencia);
            color: white;
        }
        
        .badge-success {
            background-color: var(--color-exito);
            color: white;
        }
        
        .badge-danger {
            background-color: var(--color-error);
            color: white;
        }
        
        .badge-info {
            background-color: var(--color-info);
            color: white;
        }
        
        .btn-success {
            background-color: var(--color-exito);
        }
        
        .btn-success:hover {
            background-color: #388e3c;
        }
        
        .btn-warning {
            background-color: var(--color-advertencia);
        }
        
        .btn-warning:hover {
            background-color: #ff6f00;
        }
        
        .btn-danger {
            background-color: var(--color-error);
        }
        
        .btn-danger:hover {
            background-color: #b71c1c;
        }
        
        .btn-group {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
        }
        
        .status {
            font-weight: bold;
            margin: 5px 0;
        }
        
        .status-pendiente {
            color: var(--color-advertencia);
        }
        
        .status-activo {
            color: var(--color-exito);
        }
        
        .status-devuelto {
            color: var(--color-info);
        }
        
        .status-no-disponible {
            color: var(--color-error);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-bounce {
            animation: bounce 0.5s;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .loading {
            text-align: center;
            padding: 20px;
            color: var(--color-acento);
        }
        
        .empty-state {
            text-align: center;
            padding: 30px;
            color: var(--color-acento);
            font-style: italic;
        }
        
        .libro-info {
            margin-bottom: 8px;
        }
        
        .libro-title {
            font-weight: bold;
            color: var(--color-tapa);
            font-size: 1.1rem;
        }
        
        .libro-author {
            color: var(--color-acento);
            font-style: italic;
        }
        .close{
            display: flex;
            position: absolute;
            z-index: 9999;
        }
        
    </style>
</head>




<body>
    <div class="cont">
    <button onclick="cerrarSesion()" style="float:right;" class="close">🚪 Cerrar sesión</button>
    <h1 class="animate__animated animate__fadeIn">Mis Préstamos</h1>
    
    </div>
    <!-- Resumen del usuario -->
    <div class="resumen-card animate__animated animate__fadeIn">
        <h2>Mi Resumen</h2>
        <div class="resumen-item">
            <strong>Nombre:</strong> <span id="nombreUsuario">Cargando...</span>
        </div>
        <div class="resumen-item">
            <strong>Multas pendientes:</strong> 
            <span id="cantidadMultas">0</span>
            <span class="badge badge-danger" id="valorMultas">$0</span>
        </div>
        <div class="resumen-item">
            <strong>Préstamos activos:</strong> 
            <span id="cantidadPrestamos">0</span>
        </div>
    </div>

    <!-- Listado de libros disponibles -->
    <h2 class="animate__animated animate__fadeIn">Libros Disponibles</h2>
    <div id="listaLibros" class="animate__animated animate__fadeIn">
        <div class="loading">Cargando libros...</div>
    </div>

    <!-- Mis préstamos aprobados -->
    <h2 class="animate__animated animate__fadeIn">Mis Préstamos</h2>
    <div id="misPrestamos" class="animate__animated animate__fadeIn">
        <div class="loading">Cargando préstamos...</div>
    </div>

    
  


<script>







// Cargar listado de libros disponibles
function cargarLibros() {
    const token = sessionStorage.getItem('token');
    const listaLibrosDiv = document.getElementById('listaLibros');
    listaLibrosDiv.innerHTML = '<div class="loading">Cargando libros...</div>';

    axios.get('http://localhost:8000/api/libros-solicitados', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(resSolicitados => {
        const librosSolicitados = resSolicitados.data.librosSolicitados;

        axios.get('http://localhost:8000/api/libros', {
            headers: { Authorization: 'Bearer ' + token }
        })
        .then(res => {
            if (res.data.length === 0) {
                listaLibrosDiv.innerHTML = '<div class="empty-state">No hay libros disponibles en este momento</div>';
                return;
            }

            let html = '';
            res.data.forEach(libro => {
                const yaSolicitado = librosSolicitados.includes(libro.id);

                html += `
                    <div class="libro-card animate__animated animate__fadeIn">
                        <div class="libro-info">
                            <div class="libro-title">${libro.titulo}</div>
                            <div class="libro-author">${libro.autor}</div>
                        </div>
                        ${libro.disponible ? `
                            ${yaSolicitado ? 
                                '<div class="status status-pendiente">Solicitud pendiente de aprobación</div>' :
                                `<button id="btn-solicitar-${libro.id}" onclick="solicitarPrestamo(${libro.id})" 
                                  class="btn-success animate__animated animate__pulse animate__infinite animate__slower">
                                    📚 Solicitar Préstamo
                                </button>`
                            }
                        ` : '<div class="status status-no-disponible">No disponible actualmente</div>'}
                    </div>
                `;
            });

            listaLibrosDiv.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            listaLibrosDiv.innerHTML = '<div class="empty-state">Error al cargar los libros</div>';
        });
    })
    .catch(err => {
        console.error(err);
        listaLibrosDiv.innerHTML = '<div class="empty-state">Error al cargar los libros solicitados</div>';
    });
}

// Solicitar préstamo
function solicitarPrestamo(libroId) {
    const token = sessionStorage.getItem('token');
    const boton = document.getElementById(`btn-solicitar-${libroId}`);

    if (boton) {
        boton.disabled = true;
        boton.classList.remove('animate__pulse', 'animate__infinite');
        boton.innerHTML = '<span class="animate__animated animate__flash">⌛ Procesando solicitud...</span>';
    }

    axios.post('http://localhost:8000/api/prestamos', { libro_id: libroId }, {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        if (boton) {
            boton.innerHTML = '<span class="animate__animated animate__bounceIn">✓ Solicitud enviada</span>';
            setTimeout(() => {
                boton.innerHTML = 'Solicitud pendiente';
                boton.style.backgroundColor = 'var(--color-advertencia)';
                boton.disabled = true;
            }, 2000);
        }
        
        // Actualizar listados
        setTimeout(() => {
            cargarMisPrestamos();
            cargarLibros();
        }, 500);
    })
    .catch(err => {
        console.error(err);
        if (boton) {
            boton.innerHTML = '<span class="animate__animated animate__shakeX">✗ Error al solicitar</span>';
            setTimeout(() => {
                boton.innerHTML = '📚 Solicitar Préstamo';
                boton.classList.add('animate__pulse', 'animate__infinite', 'animate__slower');
                boton.disabled = false;
            }, 2000);
        }
    });
}

// Devolver libro
function devolverPrestamo(prestamoId) {
    const token = sessionStorage.getItem('token');
    const card = document.querySelector(`button[onclick="devolverPrestamo(${prestamoId})"]`).closest('.prestamo-card');
    
    if (card) {
        card.classList.add('animate__animated', 'animate__pulse');
    }

    axios.put(`http://localhost:8000/api/prestamos/${prestamoId}/devolver`, {}, {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        if (card) {
            card.classList.remove('animate__pulse');
            card.classList.add('animate__bounceOut');
            setTimeout(() => {
                cargarMisPrestamos();
                cargarLibros();
            }, 500);
        }
    })
    .catch(err => {
        console.error(err);
        if (card) {
            card.classList.remove('animate__pulse');
            card.classList.add('animate__shakeX');
            setTimeout(() => {
                card.classList.remove('animate__shakeX');
            }, 1000);
        }
    });
}

// Renovar préstamo
function renovarPrestamo(prestamoId) {
    const token = sessionStorage.getItem('token');
    const card = document.querySelector(`button[onclick="renovarPrestamo(${prestamoId})"]`).closest('.prestamo-card');
    
    if (card) {
        card.classList.add('animate__animated', 'animate__pulse');
    }

    axios.post(`http://localhost:8000/api/prestamos/${prestamoId}/renovar`, {}, {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        if (card) {
            card.classList.remove('animate__pulse');
            card.classList.add('animate__flipInY');
            setTimeout(() => {
                cargarMisPrestamos();
                actualizarResumen();
            }, 1000);
        }
    })
    .catch(err => {
        console.error(err);
        if (card) {
            card.classList.remove('animate__pulse');
            card.classList.add('animate__shakeX');
            setTimeout(() => {
                card.classList.remove('animate__shakeX');
            }, 1000);
        }
    });
}

// Cargar préstamos aprobados del usuario y actualizar resumen
function cargarMisPrestamos() {
    const token = sessionStorage.getItem('token');
    const misPrestamosDiv = document.getElementById('misPrestamos');
    misPrestamosDiv.innerHTML = '<div class="loading">Cargando préstamos...</div>';

    axios.get('http://localhost:8000/api/prestamos', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        if (res.data.length === 0) {
            misPrestamosDiv.innerHTML = '<div class="empty-state">No tienes préstamos activos</div>';
            return;
        }

        let html = '';
        res.data.forEach(prestamo => {
            const esActivo = !prestamo.devuelto;

            html += `
                <div class="prestamo-card animate__animated animate__fadeIn">
                    <div class="libro-info">
                        <div class="libro-title">${prestamo.libro.titulo}</div>
                        <div class="libro-author">${prestamo.libro.autor}</div>
                    </div>
                    <div><strong>Préstamo:</strong> ${prestamo.fecha_prestamo}</div>
                    <div><strong>Devolución:</strong> ${prestamo.fecha_devolucion}</div>
                    <div class="status ${prestamo.devuelto ? 'status-devuelto' : 'status-activo'}">
                        ${prestamo.devuelto ? 'Devuelto' : 'Activo'}
                    </div>
                    ${prestamo.devuelto ? '' : `  
                        <div class="btn-group">
                            <button onclick="renovarPrestamo(${prestamo.id})" class="btn-warning">🔄 Renovar</button>
                            <button onclick="devolverPrestamo(${prestamo.id})" class="btn-danger">📌 Devolver</button>
                        </div>
                    `}
                </div>
            `;
        });

        misPrestamosDiv.innerHTML = html;
        actualizarResumen();
    })
    .catch(err => {
        console.error(err);
        misPrestamosDiv.innerHTML = '<div class="empty-state">Error al cargar tus préstamos</div>';
    });
}

// Actualizar resumen de multas y préstamos activos
function actualizarResumen() {
    const token = sessionStorage.getItem('token');

    axios.get('http://localhost:8000/api/resumen-prestamos', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        const cantidadMultas = res.data.cantidad_multas || 0;
        const cantidadPrestamos = res.data.cantidad_prestamos || 0;
        const valorTotalMultas = cantidadMultas * 3000;

        document.getElementById('cantidadMultas').innerText = cantidadMultas;
        document.getElementById('valorMultas').innerText = `$${valorTotalMultas}`;
        document.getElementById('cantidadPrestamos').innerText = cantidadPrestamos;
        
        // Animación de actualización
        const resumenCard = document.querySelector('.resumen-card');
        resumenCard.classList.add('animate__animated', 'animate__pulse');
        setTimeout(() => {
            resumenCard.classList.remove('animate__animated', 'animate__pulse');
        }, 1000);
    })
    .catch(err => {
        console.error(err);
    });
}

// Cargar nombre del usuario
function cargarNombreUsuario() {
    const token = sessionStorage.getItem('token');

    axios.get('http://localhost:8000/api/user', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        document.getElementById('nombreUsuario').innerText = res.data.nombre;
    })
    .catch(err => {
        console.error(err);
        document.getElementById('nombreUsuario').innerText = "Usuario";
    });
}

// Cargar todo al inicio
document.addEventListener('DOMContentLoaded', function() {
    cargarNombreUsuario();
    cargarLibros();
    cargarMisPrestamos();


});
function cerrarSesion() {
        const login = "{{ URL('/') }}"

    sessionStorage.clear();
    window.location.href = login; // Cambia la ruta
}
</script>

</body>
</html>