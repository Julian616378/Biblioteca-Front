<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Préstamos</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
</head>
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

* {
    box-sizing: border-box;
    transition: all 0.3s ease-out;
}

body {
    font-family: 'Open Sans', sans-serif;
    background-color: var(--color-papel);
    color: var(--color-letra);
    margin: 0;
    padding: 0;
    line-height: 1.6;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2 {
    font-family: 'Merriweather', serif;
    color: var(--color-tapa);
    margin: 0;
}

h1 {
    padding: 20px 0;
    margin-bottom: 20px;
    text-align: center;
    font-size: 2.2rem;
    position: relative;
}

h1:after {
    content: '';
    display: block;
    width: 100px;
    height: 4px;
    background: var(--color-lomo);
    margin: 10px auto 0;
    border-radius: 2px;
}

h2 {
    margin: 30px 0 15px;
    padding-bottom: 8px;
    border-bottom: 2px dashed var(--color-acento);
    font-size: 1.5rem;
}

button {
    background-color: var(--color-boton);
    color: white;
    border: none;
    padding: 12px 20px;
    margin: 5px 0;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
}

button:hover {
    background-color: var(--color-boton-hover);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

button:active {
    transform: translateY(0);
}

.card {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
}

.card:before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--color-lomo);
}

.libro-card {
    border-left-color: var(--color-lomo);
}

.prestamo-card {
    border-left-color: var(--color-exito);
}

.resumen-card {
    background-color: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    border-left: 5px solid var(--color-lomo);
}

.resumen-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.resumen-item {
    padding: 12px;
    background: rgba(161, 136, 127, 0.1);
    border-radius: 6px;
}

.resumen-item strong {
    color: var(--color-tapa);
    display: block;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 16px;
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
    margin-top: 15px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.status {
    font-weight: bold;
    margin: 10px 0;
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-block;
    font-size: 0.85rem;
}

.status-pendiente {
    background-color: rgba(255, 143, 0, 0.1);
    color: var(--color-advertencia);
}

.status-activo {
    background-color: rgba(46, 125, 50, 0.1);
    color: var(--color-exito);
}

.status-devuelto {
    background-color: rgba(2, 119, 189, 0.1);
    color: var(--color-info);
}

.status-no-disponible {
    background-color: rgba(198, 40, 40, 0.1);
    color: var(--color-error);
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.loading {
    text-align: center;
    padding: 30px;
    color: var(--color-acento);
    font-size: 1.1rem;
}

.empty-state {
    text-align: center;
    padding: 30px;
    color: var(--color-acento);
    font-style: italic;
    background: rgba(161, 136, 127, 0.05);
    border-radius: 8px;
}

.libro-info {
    margin-bottom: 10px;
}

.libro-title {
    font-weight: bold;
    color: var(--color-tapa);
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.libro-author {
    color: var(--color-acento);
    font-style: italic;
    font-size: 0.95rem;
}

.close {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 999;
    background: var(--color-error);
}

.close:hover {
    background: #b71c1c;
}

.grid-libros {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.grid-prestamos {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.fade-in {
    animation: fadeIn 0.6s both;
}

.delay-1 {
    animation-delay: 0.1s;
}

.delay-2 {
    animation-delay: 0.2s;
}

.delay-3 {
    animation-delay: 0.3s;
}
</style>
<body>
    <div class="container">
        <button onclick="cerrarSesion()" class="close">🚪 Cerrar sesión</button>
        <h1 class="animate__animated animate__fadeIn">Mis Préstamos</h1>
        
        <!-- Resumen del usuario -->
        <div class="resumen-card animate__animated animate__fadeIn">
            <h2>Mi Resumen</h2>
            <div class="resumen-grid">
                <div class="resumen-item">
                    <strong>Nombre:</strong>
                    <span id="nombreUsuario">Cargando...</span>
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
    </div>

<script>
// [Todas las funciones JavaScript se mantienen exactamente igual que en tu código original]
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

            let html = '<div class="grid-libros">';
            res.data.forEach((libro, index) => {
                const yaSolicitado = librosSolicitados.includes(libro.id);

                html += `
                    <div class="libro-card fade-in delay-${index % 3}">
                        <div class="libro-info">
                            <div class="libro-title">${libro.titulo}</div>
                            <div class="libro-author">${libro.autor}</div>
                        </div>
                        ${libro.disponible ? `
                            ${yaSolicitado ? 
                                '<div class="status status-pendiente">Solicitud pendiente de aprobación</div>' :
                                `<button id="btn-solicitar-${libro.id}" onclick="solicitarPrestamo(${libro.id})" 
                                  class="btn-success animate-float">
                                    📚 Solicitar Préstamo
                                </button>`
                            }
                        ` : '<div class="status status-no-disponible">No disponible actualmente</div>'}
                    </div>
                `;
            });
            html += '</div>';

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
        boton.classList.remove('animate-float');
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
                boton.classList.add('animate-float');
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
            card.classList.add('animate__animated', 'animate__zoomOut');
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
            card.classList.add('animate__animated', 'animate__headShake');
            setTimeout(() => {
                card.classList.remove('animate__headShake');
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

        let html = '<div class="grid-prestamos">';
        res.data.forEach((prestamo, index) => {
            const esActivo = !prestamo.devuelto;

            html += `
                <div class="prestamo-card fade-in delay-${index % 3}">
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
                            <button onclick="devolverPrestamo(${prestamo.id})" class="btn-danger">📌 Devolver</button>
                        </div>
                    `}
                </div>
            `;
        });
        html += '</div>';

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
        const valorTotalMultas = cantidadMultas * 6000;

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
    window.location.href = login;
}
</script>

</body>
</html>