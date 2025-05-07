<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administrador</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<style>
    :root {
        --primary-color: #5d4037; /* Marrón libro antiguo */
        --secondary-color: #8d6e63; /* Marrón más claro */
        --accent-color: #d7ccc8; /* Beige claro */
        --text-color: #3e2723; /* Marrón oscuro */
        --light-text: #f5f5f5;
        --success-color: #2e7d32; /* Verde */
        --warning-color: #ff8f00; /* Naranja */
        --danger-color: #c62828; /* Rojo */
        --info-color: #0277bd; /* Azul */
        --page-color: #fff9f0; /* Color de página de libro */
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Open Sans', sans-serif;
        background-color: var(--page-color);
        color: var(--text-color);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        animation: fadeIn 0.5s ease-in-out;
    }

    h1, h2, h3 {
        font-family: 'Merriweather', serif;
        color: var(--primary-color);
    }

    h1 {
        text-align: center;
        margin: 20px 0;
        font-size: 2.5rem;
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 10px;
        position: relative;
    }

    h1::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--secondary-color);
    }

    h2 {
        margin: 20px 0;
        font-size: 1.8rem;
        color: var(--secondary-color);
        border-left: 4px solid var(--secondary-color);
        padding-left: 10px;
    }

    .btn-logout {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: var(--danger-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-logout:hover {
        background-color: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .nav-buttons {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .nav-buttons button {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 200px;
        font-size: 1rem;
    }

    .nav-buttons button:hover {
        background-color: var(--primary-color);
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .section {
        display: none;
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        animation: slideUp 0.5s ease-out;
    }

    .section.active {
        display: block;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--accent-color);
        border-radius: 4px;
        font-size: 1rem;
        transition: border 0.3s ease;
    }

    .form-group input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 2px rgba(141, 110, 99, 0.2);
    }

    .btn-success {
        background-color: var(--success-color);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #1b5e20;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .btn-info {
        background-color: var(--info-color);
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .btn-info:hover {
        background-color: #01579b;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .btn-warning {
        background-color: var(--warning-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e65100;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .prestamo-card {
        background: white;
        border-left: 4px solid var(--secondary-color);
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .prestamo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .prestamo-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--secondary-color);
    }

    .prestamo-card p {
        margin: 8px 0;
    }

    .card-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .loading {
        text-align: center;
        padding: 20px;
        color: var(--secondary-color);
        font-style: italic;
    }

    .success-message {
        color: var(--success-color);
        background-color: #e8f5e9;
        padding: 10px;
        border-radius: 4px;
        margin-top: 15px;
        border-left: 4px solid var(--success-color);
        animation: fadeIn 0.5s ease-in-out;
    }

    .error-message {
        color: var(--danger-color);
        background-color: #ffebee;
        padding: 10px;
        border-radius: 4px;
        margin-top: 15px;
        border-left: 4px solid var(--danger-color);
        animation: fadeIn 0.5s ease-in-out;
    }

    .tabs {
        display: flex;
        border-bottom: 1px solid var(--accent-color);
        margin-bottom: 20px;
    }

    .tab {
        padding: 10px 20px;
        cursor: pointer;
        font-weight: 600;
        color: var(--secondary-color);
        transition: all 0.3s ease;
        position: relative;
    }

    .tab:hover {
        color: var(--primary-color);
    }

    .tab.active {
        color: var(--primary-color);
    }

    .tab.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary-color);
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease-in-out;
    }

    .tab-content.active {
        display: block;
    }

    .date-picker {
        margin: 15px 0;
    }

    .date-display {
        display: inline-block;
        padding: 8px 15px;
        background-color: var(--accent-color);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-left: 10px;
    }

    .date-display:hover {
        background-color: #bcaaa4;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content {
        background-color: white;
        padding: 25px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        animation: slideUp 0.4s ease-out;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--accent-color);
    }

    .modal-header h3 {
        color: var(--primary-color);
        margin: 0;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--secondary-color);
        transition: all 0.3s ease;
    }

    .close-modal:hover {
        color: var(--primary-color);
        transform: rotate(90deg);
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid var(--accent-color);
    }

    /* Special styles for fines section */
    .prestamo-con-multa {
        border-left-color: var(--warning-color);
        background-color: #fff3e0;
    }

    .prestamo-con-multa::before {
        background: var(--warning-color);
    }

    .prestamo-devuelto {
        border-left-color: var(--success-color);
        background-color: #e8f5e9;
    }

    .prestamo-devuelto::before {
        background: var(--success-color);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .nav-buttons {
            flex-direction: column;
            gap: 10px;
        }
        
        .nav-buttons button {
            width: 100%;
        }
        
        .card-actions {
            flex-direction: column;
        }
        
        .card-actions button {
            width: 100%;
        }
    }
    .renovacion-info {
    margin: 10px 0;
    padding: 8px;
    border-radius: 4px;
    background-color: #f5f5f5;
}

.info-text {
    color: var(--info-color);
}

.success-text {
    color: var(--success-color);
    font-weight: bold;
}

.error-text {
    color: var(--danger-color);
}

/* Estilo para botones deshabilitados */
.btn-warning:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-warning:disabled:hover {
    background-color: #cccccc;
}
</style>
<body>
    <div class="container">
        <button onclick="cerrarSesion()" class="btn-logout">Cerrar sesión</button>
        <h1>Panel de Administrador</h1>

        <div class="nav-buttons">
            <button onclick="mostrarSeccion('crear')">Crear Libro</button>
            <button onclick="mostrarSeccion('pendientes')">Aprobar Préstamos</button>
            <button onclick="mostrarSeccion('aprobados')">Gestionar Préstamos</button>
        </div>

        <div id="seccionCrear" class="section">
            <h2>Crear nuevo libro</h2>
            <div class="form-group">
                <input type="text" id="titulo" placeholder="Título *" required>
            </div>
            <div class="form-group">
                <input type="text" id="autor" placeholder="Autor *" required>
            </div>
            <div class="form-group">
                <input type="text" id="materia" placeholder="Materia">
            </div>
            <div class="form-group">
                <input type="text" id="genero" placeholder="Género">
            </div>
            <button onclick="crearLibro()" class="btn-success">Crear libro</button>
            <div id="crearLibroMessage" style="display:none;"></div>
        </div>

        <div id="seccionPendientes" class="section">
            <h2>Préstamos pendientes de aprobación</h2>
            <div id="listaPendientes" class="loading">Cargando préstamos pendientes...</div>
        </div>

        <div id="seccionAprobados" class="section">
            <h2>Gestión de Préstamos</h2>
            <button onclick="cargarAprobados()" class="btn-info">Actualizar lista</button>
            
            <div class="tabs">
                <div class="tab active" onclick="cambiarTab('activos')">Préstamos Activos</div>
                <div class="tab" onclick="cambiarTab('multas')">Préstamos con Multas</div>
                <div class="tab" onclick="cambiarTab('devueltos')">Historial de Préstamos</div>
            </div>
            
            <div id="tabActivos" class="tab-content active">
                <div id="listaAprobadosActivos" class="loading">Cargando préstamos activos...</div>
            </div>
            
            <div id="tabMultas" class="tab-content">
                <div id="listaAprobadosMultas" class="loading">Cargando préstamos con multas...</div>
            </div>
            
            <div id="tabDevueltos" class="tab-content">
                <div id="listaAprobadosDevueltos" class="loading">Cargando historial de préstamos...</div>
            </div>
        </div>
    </div>

    <!-- Modal para calendario -->
    <div id="calendarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Seleccionar fecha de devolución</h3>
                <button class="close-modal" onclick="cerrarModal()">&times;</button>
            </div>
            <div>
                <input type="date" id="modalFechaDevolucion" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div class="modal-footer">
                <button onclick="cerrarModal()" class="btn-warning">Cancelar</button>
                <button onclick="confirmarFechaDevolucion()" class="btn-success">Confirmar</button>
            </div>
        </div>
    </div>

    <script>

          
function esDiaRenovacion(fechaDevolucion) {
    if (!fechaDevolucion) return false;
    
    const hoy = new Date();
    const fechaDev = new Date(fechaDevolucion);
    
    // Diferencia en días
    const diffTime = fechaDev - hoy;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    return diffDays === 0; // Es el último día (día 3)
}


function calcularDiasRenovacion(fechaDevolucion) {
    if (!fechaDevolucion) return '<p class="info-text">Fecha de devolución no definida</p>';
    
    const hoy = new Date();
    const fechaDev = new Date(fechaDevolucion);
    const diffTime = fechaDev - hoy;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays > 1) {
        return `<p class="info-text">Días restantes: ${diffDays}</p>`;
    } else if (diffDays === 1) {
        return `<p class="info-text">Último día antes de renovación/multa</p>`;
    } else if (diffDays === 0) {
        return `<p class="success-text">¡Hoy es el día para renovar!</p>`;
    } else {
        return `<p class="error-text">Préstamo vencido. Multa aplicada.</p>`;
    }
}


        // Variables globales
        const token = sessionStorage.getItem('token');
        let currentPrestamoId = null;

        // Funciones auxiliares
        function esUltimoDia(fechaDevolucion) {
    if (!fechaDevolucion) return false;
    
    const hoy = new Date();
    const fechaDev = new Date(fechaDevolucion);
    
    // Ajustar ambas fechas a medianoche para comparar solo día/mes/año
    const hoyAjustado = new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate());
    const fechaDevAjustada = new Date(fechaDev.getFullYear(), fechaDev.getMonth(), fechaDev.getDate());
    
    return hoyAjustado.getTime() === fechaDevAjustada.getTime();
}

        function calcularDiasRenovacion(fechaDevolucion) {
            if (!fechaDevolucion) return '<p class="info-text">Fecha de devolución no definida</p>';
            
            const hoy = new Date();
            const fechaDev = new Date(fechaDevolucion);
            const diffTime = fechaDev - hoy;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            
            if (diffDays > 1) {
                return `<p class="info-text">Puedes renovar en ${diffDays} días</p>`;
            } else if (diffDays === 1) {
                return `<p class="info-text">Puedes renovar mañana</p>`;
            } else if (diffDays === 0) {
                return `<p class="success-text">¡Hoy es el último día para renovar!</p>`;
            } else {
                return `<p class="error-text">Fecha de devolución pasada</p>`;
            }
        }

        function formatFecha(fechaString) {
            if (!fechaString) return 'No definida';
            const fecha = new Date(fechaString);
            return fecha.toLocaleDateString('es-ES', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        // Funciones principales
        function mostrarSeccion(seccion) {
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            
            if (seccion === 'crear') {
                document.getElementById('seccionCrear').classList.add('active');
            } else if (seccion === 'pendientes') {
                document.getElementById('seccionPendientes').classList.add('active');
                cargarPendientes();
            } else if (seccion === 'aprobados') {
                document.getElementById('seccionAprobados').classList.add('active');
                cargarAprobados();
            }
        }

        function cambiarTab(tab) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            document.querySelector(`.tab[onclick="cambiarTab('${tab}')"]`).classList.add('active');
            document.getElementById(`tab${tab.charAt(0).toUpperCase() + tab.slice(1)}`).classList.add('active');
            
            if (tab === 'multas') {
                cargarPrestamosConMultas();
            }
        }

        function crearLibro() {
            const titulo = document.getElementById('titulo').value;
            const autor = document.getElementById('autor').value;
            
            if (!titulo || !autor) {
                mostrarMensaje('crearLibroMessage', 'El título y el autor son campos obligatorios', 'error');
                return;
            }

            const data = {
                titulo: titulo,
                autor: document.getElementById('autor').value,
                materia: document.getElementById('materia').value,
                genero: document.getElementById('genero').value
            };

            const btn = document.querySelector('#seccionCrear button');
            btn.disabled = true;
            btn.textContent = 'Creando...';

            axios.post('http://localhost:8000/api/libros', data, {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                mostrarMensaje('crearLibroMessage', 'Libro creado exitosamente', 'success');
                btn.textContent = 'Crear libro';
                btn.disabled = false;
                
                // Limpiar campos
                document.getElementById('titulo').value = '';
                document.getElementById('autor').value = '';
                document.getElementById('materia').value = '';
                document.getElementById('genero').value = '';
            })
            .catch(err => {
                console.error('Error al crear libro:', err);
                mostrarMensaje('crearLibroMessage', 'Error al crear el libro', 'error');
                btn.textContent = 'Crear libro';
                btn.disabled = false;
            });
        }

        function mostrarMensaje(elementId, mensaje, tipo) {
            const element = document.getElementById(elementId);
            element.textContent = mensaje;
            element.style.display = 'block';
            element.className = tipo === 'success' ? 'success-message' : 'error-message';
            
            setTimeout(() => {
                element.style.display = 'none';
            }, 3000);
        }

        function cargarPendientes() {
            const lista = document.getElementById('listaPendientes');
            lista.innerHTML = '<div class="loading">Cargando préstamos pendientes...</div>';
            
            axios.get('http://localhost:8000/api/prestamos', {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                const prestamos = res.data;
                const pendientes = prestamos.filter(p => p.libro.disponible);

                let html = '';
                if (pendientes.length === 0) {
                    html = '<div class="loading">No hay préstamos pendientes de aprobación</div>';
                } else {
                    pendientes.forEach(p => {
                        html += `
                            <div class="prestamo-card" id="prestamo-${p.id}">
                                <p><strong>Libro:</strong> ${p.libro.titulo}</p>
                                <p><strong>Autor:</strong> ${p.libro.autor}</p>
                                <p><strong>Usuario ID:</strong> ${p.user_id}</p>
                                <p><strong>Solicitado el:</strong> ${p.fecha_prestamo}</p>
                                <div class="card-actions">
                                    <button onclick="aprobarPrestamo(${p.id}, this)" class="btn-success">Aprobar Préstamo</button>
                                    <button onclick="ocultarPrestamo(${p.id}, this)" class="btn-warning">Ocultar</button>
                                </div>
                            </div>
                        `;
                    });
                }

                lista.innerHTML = html;
            })
            .catch(err => {
                console.error('Error al cargar préstamos pendientes:', err);
                lista.innerHTML = '<div class="error-message">Error al cargar préstamos pendientes</div>';
            });
        }

        function ocultarPrestamo(prestamoId, btn) {
            btn.disabled = true;
            btn.textContent = 'Ocultando...';
            
            const item = document.getElementById(`prestamo-${prestamoId}`);
            if (item) {
                item.style.opacity = '0.5';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        }

        function aprobarPrestamo(id, btn) {
            btn.disabled = true;
            btn.textContent = 'Aprobando...';
            
            axios.post(`http://localhost:8000/api/prestamos/${id}/aprobar`, {}, {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                btn.textContent = '✓ Aprobado';
                btn.className = 'btn-success';
                const item = document.getElementById(`prestamo-${id}`);
                if (item) {
                    item.style.opacity = '0.5';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 500);
                }
            })
            .catch(err => {
                console.error('Error al aprobar préstamo:', err);
                btn.textContent = 'Error al aprobar';
                btn.className = 'btn-danger';
                setTimeout(() => {
                    btn.textContent = 'Aprobar Préstamo';
                    btn.className = 'btn-success';
                    btn.disabled = false;
                }, 2000);
            });
        }

       function cargarAprobados() {
    const listaActivos = document.getElementById('listaAprobadosActivos');
    const listaDevueltos = document.getElementById('listaAprobadosDevueltos');
    const listaMultas = document.getElementById('listaAprobadosMultas');
    
    listaActivos.innerHTML = '<div class="loading">Cargando préstamos activos...</div>';
    listaDevueltos.innerHTML = '<div class="loading">Cargando historial de préstamos...</div>';
    listaMultas.innerHTML = '<div class="loading">Cargando préstamos con multas...</div>';
    
    const refreshBtn = document.querySelector('#seccionAprobados button');
    refreshBtn.disabled = true;
    refreshBtn.textContent = 'Cargando...';
    
    axios.get('http://localhost:8000/api/prestamos', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        let htmlActivos = '';
        let htmlDevueltos = '';
        let htmlMultas = '';
        
        const prestamos = res.data;
        const activos = prestamos.filter(p => !p.devuelto);
        const devueltos = prestamos.filter(p => p.devuelto);
        const conMultas = prestamos.filter(p => p.multa > 0);

        // Préstamos activos
        if (activos.length === 0) {
            htmlActivos = '<div class="loading">No hay préstamos activos</div>';
        } else {
            activos.forEach(p => {
                const esUltimoDiaValido = esUltimoDia(p.fecha_devolucion);
                htmlActivos += `
    <div class="prestamo-card ${p.multa > 0 ? 'prestamo-con-multa' : ''}" id="prestamo-aprobado-${p.id}">
        <div class="prestamo-header">
            <h3>${p.libro.titulo}</h3>
            <span class="estado ${p.devuelto ? 'devuelto' : 'activo'}">
                ${p.devuelto ? 'DEVUELTO' : 'ACTIVO'}
            </span>
        </div>
        
        <div class="prestamo-info">
            <div class="info-row">
                <span class="info-label">Autor:</span>
                <span class="info-value">${p.libro.autor}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Usuario:</span>
                <span class="info-value">${p.user ? p.user.name : 'ID: '+p.user_id}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Fecha Préstamo:</span>
                <span class="info-value">${formatFecha(p.fecha_prestamo)}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Fecha Devolución:</span>
                <span class="info-value ${p.devuelto ? '' : (new Date(p.fecha_devolucion) < new Date() ? 'text-danger' : '')}">
                    ${formatFecha(p.fecha_devolucion)}
                </span>
            </div>
            
            ${p.multa > 0 ? `
            <div class="info-row">
                <span class="info-label">Multa:</span>
                <span class="info-value text-danger">$${p.multa.toLocaleString()}</span>
            </div>
            ` : ''}
        </div>
        
        <div class="renovacion-info">
            ${calcularDiasRenovacion(p.fecha_devolucion)}
        </div>
        
        <div class="card-actions">
            <button onclick="renovarPrestamo(${p.id}, this, '${p.fecha_devolucion}')" 
                    class="btn-warning" 
                    ${!esDiaRenovacion(p.fecha_devolucion) ? 'disabled' : ''}>
                Renovar Préstamo (3 días)
            </button>
            
            ${!p.devuelto ? `
            <button onclick="marcarDevuelto(${p.id}, this)" class="btn-success">
                Marcar como devuelto
            </button>
            ` : ''}
        </div>
    </div>
`;
            });
        }

        // Resto del código permanece exactamente igual...
        // Préstamos devueltos
        if (devueltos.length === 0) {
            htmlDevueltos = '<div class="loading">No hay historial de préstamos</div>';
        } else {
            devueltos.forEach(p => {
                htmlDevueltos += `
                    <div class="prestamo-card prestamo-devuelto">
                        <p><strong>Libro:</strong> ${p.libro.titulo}</p>
                        <p><strong>Autor:</strong> ${p.libro.autor}</p>
                        <p><strong>Usuario:</strong> ${p.user ? p.user.name : 'ID: '+p.user_id}</p>
                        <p><strong>Fecha Préstamo:</strong> ${p.fecha_prestamo}</p>
                        <p><strong>Fecha Devolución:</strong> ${p.fecha_devolucion}</p>
                        ${p.multa > 0 ? `<p><strong>Multa:</strong> $${p.multa}</p>` : ''}
                        <p><strong>Estado:</strong> Devuelto</p>
                    </div>
                `;
            });
        }

        // Préstamos con multas
        if (conMultas.length === 0) {
            htmlMultas = '<div class="loading">No hay préstamos con multas pendientes</div>';
        } else {
            conMultas.forEach(p => {
                htmlMultas += `
                    <div class="prestamo-card prestamo-con-multa">
                        <p><strong>Libro:</strong> ${p.libro.titulo}</p>
                        <p><strong>Autor:</strong> ${p.libro.autor}</p>
                        <p><strong>Usuario:</strong> ${p.user ? p.user.name : 'ID: '+p.user_id}</p>
                        <p><strong>Fecha Préstamo:</strong> ${p.fecha_prestamo}</p>
                        <p><strong>Fecha Devolución:</strong> ${p.fecha_devolucion || 'Pendiente'}</p>
                        <p class="multa-text"><strong>Multa:</strong> $${p.multa}</p>
                        <p><strong>Estado:</strong> ${p.devuelto ? 'Devuelto' : 'Activo'}</p>
                        ${!p.devuelto ? `
                        <div class="card-actions">
                            <button onclick="marcarDevuelto(${p.id}, this)" class="btn-success">Marcar como devuelto</button>
                        </div>
                        ` : ''}
                    </div>
                `;
            });
        }

        listaActivos.innerHTML = htmlActivos;
        listaDevueltos.innerHTML = htmlDevueltos;
        listaMultas.innerHTML = htmlMultas;
        refreshBtn.textContent = 'Actualizar lista';
        refreshBtn.disabled = false;
    })
    .catch(err => {
        console.error('Error al cargar préstamos:', err);
        listaActivos.innerHTML = '<div class="error-message">Error al cargar préstamos activos</div>';
        listaDevueltos.innerHTML = '<div class="error-message">Error al cargar historial de préstamos</div>';
        listaMultas.innerHTML = '<div class="error-message">Error al cargar préstamos con multas</div>';
        refreshBtn.textContent = 'Intentar nuevamente';
        refreshBtn.disabled = false;
    });
}
        function cargarPrestamosConMultas() {
            const listaMultas = document.getElementById('listaAprobadosMultas');
            listaMultas.innerHTML = '<div class="loading">Cargando préstamos con multas...</div>';
            
            axios.get('http://localhost:8000/api/prestamos', {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                let htmlMultas = '';
                const prestamos = res.data;
                const conMultas = prestamos.filter(p => p.multa > 0);

                if (conMultas.length === 0) {
                    htmlMultas = '<div class="loading">No hay préstamos con multas pendientes</div>';
                } else {
                    conMultas.forEach(p => {
                        htmlMultas += `
                            <div class="prestamo-card prestamo-con-multa">
                                <p><strong>Libro:</strong> ${p.libro.titulo}</p>
                                <p><strong>Autor:</strong> ${p.libro.autor}</p>
                                <p><strong>Usuario:</strong> ${p.user ? p.user.name : 'ID: '+p.user_id}</p>
                                <p><strong>Fecha Préstamo:</strong> ${p.fecha_prestamo}</p>
                                <p><strong>Fecha Devolución:</strong> ${p.fecha_devolucion || 'Pendiente'}</p>
                                <p class="multa-text"><strong>Multa:</strong> $${p.multa}</p>
                                <p><strong>Estado:</strong> ${p.devuelto ? 'Devuelto' : 'Activo'}</p>
                                ${!p.devuelto ? `
                                <div class="card-actions">
                                    <button onclick="marcarDevuelto(${p.id}, this)" class="btn-success">Marcar como devuelto</button>
                                </div>
                                ` : ''}
                            </div>
                        `;
                    });
                }

                listaMultas.innerHTML = htmlMultas;
            })
            .catch(err => {
                console.error('Error al cargar préstamos con multas:', err);
                listaMultas.innerHTML = '<div class="error-message">Error al cargar préstamos con multas</div>';
            });
        }

        function abrirModalFecha(prestamoId, fechaActual) {
            currentPrestamoId = prestamoId;
            document.getElementById('modalFechaDevolucion').value = fechaActual;
            document.getElementById('calendarModal').style.display = 'flex';
        }

        function cerrarModal() {
            document.getElementById('calendarModal').style.display = 'none';
        }

        function confirmarFechaDevolucion() {
            const nuevaFecha = document.getElementById('modalFechaDevolucion').value;
            
            if (!nuevaFecha) {
                alert('Por favor selecciona una fecha válida');
                return;
            }

            axios.put(`http://localhost:8000/api/prestamos/${currentPrestamoId}/fecha-devolucion`, {
                fecha_devolucion: nuevaFecha
            }, {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                cerrarModal();
                cargarAprobados();
            })
            .catch(err => {
                console.error('Error al actualizar fecha:', err);
                alert('Error al actualizar la fecha');
            });
        }

        function marcarDevuelto(prestamoId, btn) {
            if (!confirm('¿Estás seguro de marcar este préstamo como devuelto?')) {
                return;
            }
            
            btn.disabled = true;
            btn.textContent = 'Procesando...';
            
            axios.post(`http://localhost:8000/api/prestamos/${prestamoId}/devolver`, {}, {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                if (res.data.success) {
                    btn.textContent = '✓ Devuelto';
                    btn.className = 'btn-success';
                    setTimeout(() => {
                        cargarAprobados();
                    }, 1000);
                } else {
                    throw new Error(res.data.mensaje || 'Error al marcar como devuelto');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                btn.textContent = 'Error';
                btn.className = 'btn-danger';
                setTimeout(() => {
                    btn.textContent = 'Marcar como devuelto';
                    btn.className = 'btn-success';
                    btn.disabled = false;
                }, 2000);
            });
        }

        function cerrarSesion() {
            sessionStorage.clear();
            window.location.href = "{{ URL('/') }}";
        }
        async function renovarPrestamo(prestamoId, btn, fechaDevolucion) {
    try {
        btn.disabled = true;
        btn.textContent = 'Procesando...';
        
        if (!esDiaRenovacion(fechaDevolucion)) {
            const fechaFormateada = formatFecha(fechaDevolucion);
            throw new Error(`Solo puedes renovar el día ${fechaFormateada}`);
        }

        if (!confirm('¿Renovar este préstamo por 3 días adicionales?')) {
            btn.disabled = false;
            btn.textContent = 'Renovar Préstamo';
            return;
        }

        const response = await axios.put(
            `http://localhost:8000/api/prestamos/${prestamoId}/renovar`, 
            {},
            {
                headers: { 
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            }
        );

        if (response.data.success) {
            mostrarNotificacion(
                'success', 
                'Préstamo renovado', 
                `Nueva fecha: ${formatFecha(response.data.nueva_fecha_devolucion)}`
            );
            cargarAprobados();
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion(
            'error', 
            'Error en renovación', 
            error.response?.data?.message || error.message
        );
    } finally {
        btn.textContent = 'Renovar Préstamo';
        btn.disabled = !esDiaRenovacion(fechaDevolucion);
    }
}
// Función auxiliar para calcular días restantes
function calcularDiasRestantes(fechaDevolucion) {
    const hoy = new Date();
    const fechaDev = new Date(fechaDevolucion);
    const diffTime = fechaDev - hoy;
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays > 0) {
        return `Faltan ${diffDays} días para la fecha de renovación.`;
    } else {
        return 'La fecha de devolución ya pasó.';
    }
}
function mostrarNotificacion(tipo, titulo, mensaje) {
    // Crea el elemento de notificación
    const notificacion = document.createElement('div');
    notificacion.className = `notificacion ${tipo}`;
    notificacion.innerHTML = `
        <strong>${titulo}</strong>
        <p>${mensaje}</p>
    `;
    
    // Agrega al cuerpo del documento
    document.body.appendChild(notificacion);
    
    // Elimina después de 5 segundos
    setTimeout(() => {
        notificacion.remove();
    }, 5000);
}

// Y el CSS correspondiente
const style = document.createElement('style');
style.textContent = `
.notificacion {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px;
    border-radius: 5px;
    color: white;
    max-width: 300px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    z-index: 1000;
    animation: fadeIn 0.3s;
}
.notificacion.success {
    background-color: #28a745;
}
.notificacion.error {
    background-color: #dc3545;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
`;
document.head.appendChild(style);

        // Inicialización
        mostrarSeccion('crear');
  
    </script>
</body>
</html>