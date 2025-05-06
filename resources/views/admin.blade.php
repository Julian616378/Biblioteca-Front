<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="{{asset('CSS/admin.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    

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
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: var(--color-papel);
    color: var(--color-letra);
    line-height: 1.6;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

h1, h2, h3 {
    color: var(--color-tapa);
    margin-bottom: 20px;
}

button {
    background-color: var(--color-boton);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: 5px;
}

button:hover {
    background-color: var(--color-boton-hover);
    transform: translateY(-2px);
}

button:disabled {
    background-color: #cccccc;
    cursor: not-allowed;
    transform: none;
}

.btn-logout {
    background-color: var(--color-error);
    float: right;
}

.btn-logout:hover {
    background-color: #d32f2f;
}

.nav-buttons {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.section {
    display: none;
    animation: fadeIn 0.5s ease;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.section.active {
    display: block;
}

.form-group {
    margin-bottom: 15px;
}

input[type="text"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--color-acento);
    border-radius: 4px;
    margin-bottom: 10px;
}

.prestamo-card {
    background: white;
    border-left: 5px solid var(--color-lomo);
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.prestamo-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.prestamo-card p {
    margin-bottom: 8px;
}

.card-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.btn-success {
    background-color: var(--color-exito);
}

.btn-warning {
    background-color: var(--color-advertencia);
}

.btn-info {
    background-color: var(--color-info);
}

.btn-danger {
    background-color: var(--color-error);
}

.loading {
    text-align: center;
    padding: 20px;
    color: var(--color-acento);
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    animation: slideUp 0.4s ease;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--color-acento);
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid var(--color-acento);
}

.close-modal {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: var(--color-letra);
}

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

.date-picker {
    display: flex;
    align-items: center;
    gap: 10px;
}

.date-display {
    padding: 8px 12px;
    background-color: var(--color-papel);
    border-radius: 4px;
    cursor: pointer;
    border: 1px solid var(--color-acento);
}

.tabs {
    display: flex;
    margin-bottom: 20px;
    border-bottom: 1px solid var(--color-acento);
}

.tab {
    padding: 10px 20px;
    cursor: pointer;
    border-bottom: 3px solid transparent;
}

.tab.active {
    border-bottom: 3px solid var(--color-tapa);
    font-weight: bold;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.success-message {
    color: var(--color-exito);
    background-color: rgba(46, 125, 50, 0.1);
    padding: 10px;
    border-radius: 4px;
    margin: 10px 0;
    text-align: center;
    animation: fadeIn 0.5s ease;
}

.error-message {
    color: var(--color-error);
    background-color: rgba(198, 40, 40, 0.1);
    padding: 10px;
    border-radius: 4px;
    margin: 10px 0;
    text-align: center;
    animation: fadeIn 0.5s ease;
}
</style>
<body>
    <div class="container">
        <button onclick="cerrarSesion()" class="btn-logout">Cerrar sesión</button>
        <h1>Panel de Administrador</h1>

        <div class="nav-buttons">
            <button onclick="mostrarSeccion('crear')">Crear Libro</button>
            <button onclick="mostrarSeccion('pendientes')">Aprobar Préstamos</button>
            <button onclick="mostrarSeccion('aprobados')">Ver Préstamos Aprobados</button>
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
            <h2>Préstamos aprobados</h2>
            <button onclick="cargarAprobados()" class="btn-info">Actualizar lista</button>
            
            <div class="tabs">
                <div class="tab active" onclick="cambiarTab('activos')">Préstamos Activos</div>
                <div class="tab" onclick="cambiarTab('devueltos')">Préstamos Devueltos</div>
            </div>
            
            <div id="tabActivos" class="tab-content active">
                <div id="listaAprobadosActivos" class="loading">Cargando préstamos activos...</div>
            </div>
            
            <div id="tabDevueltos" class="tab-content">
                <div id="listaAprobadosDevueltos" class="loading">Cargando préstamos devueltos...</div>
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
                <input type="date" id="modalFechaDevolucion" style="width: 100%; padding: 10px;">
            </div>
            <div class="modal-footer">
                <button onclick="cerrarModal()">Cancelar</button>
                <button onclick="confirmarFechaDevolucion()" class="btn-success">Confirmar</button>
            </div>
        </div>
    </div>

    <script>
        const token = sessionStorage.getItem('token');
        let currentPrestamoId = null;

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
            
            listaActivos.innerHTML = '<div class="loading">Cargando préstamos activos...</div>';
            listaDevueltos.innerHTML = '<div class="loading">Cargando préstamos devueltos...</div>';
            
            const refreshBtn = document.querySelector('#seccionAprobados button');
            refreshBtn.disabled = true;
            refreshBtn.textContent = 'Cargando...';
            
            axios.get('http://localhost:8000/api/prestamos', {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then(res => {
                let htmlActivos = '';
                let htmlDevueltos = '';
                
                const prestamos = res.data;
                const activos = prestamos.filter(p => !p.devuelto);
                const devueltos = prestamos.filter(p => p.devuelto);

                if (activos.length === 0) {
                    htmlActivos = '<div class="loading">No hay préstamos activos</div>';
                } else {
                    activos.forEach(p => {
                        const fechaDevolucion = p.fecha_devolucion ? p.fecha_devolucion.split(' ')[0] : '';
                        
                        htmlActivos += `
                            <div class="prestamo-card" id="prestamo-aprobado-${p.id}">
                                <p><strong>Libro:</strong> ${p.libro.titulo}</p>
                                <p><strong>Autor:</strong> ${p.libro.autor}</p>
                                <p><strong>Usuario:</strong> ${p.user ? p.user.name : 'ID: '+p.user_id}</p>
                                <p><strong>Fecha Préstamo:</strong> ${p.fecha_prestamo}</p>
                                <div class="date-picker">
                                    <strong>Fecha Devolución:</strong>
                                    <div class="date-display" onclick="abrirModalFecha(${p.id}, '${fechaDevolucion}')">
                                        ${fechaDevolucion || 'Seleccionar fecha'}
                                    </div>
                                </div>
                                ${p.multa > 0 ? `<p><strong>Multa:</strong> $${p.multa}</p>` : ''}
                                <div class="card-actions">
                                    <button onclick="marcarDevuelto(${p.id}, this)" class="btn-success">Marcar como devuelto</button>
                                </div>
                            </div>
                        `;
                    });
                }

                if (devueltos.length === 0) {
                    htmlDevueltos = '<div class="loading">No hay préstamos devueltos</div>';
                } else {
                    devueltos.forEach(p => {
                        htmlDevueltos += `
                            <div class="prestamo-card">
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

                listaActivos.innerHTML = htmlActivos;
                listaDevueltos.innerHTML = htmlDevueltos;
                refreshBtn.textContent = 'Actualizar lista';
                refreshBtn.disabled = false;
            })
            .catch(err => {
                console.error('Error al cargar préstamos:', err);
                listaActivos.innerHTML = '<div class="error-message">Error al cargar préstamos activos</div>';
                listaDevueltos.innerHTML = '<div class="error-message">Error al cargar préstamos devueltos</div>';
                refreshBtn.textContent = 'Intentar nuevamente';
                refreshBtn.disabled = false;
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

        // Mostrar la sección de creación por defecto
        mostrarSeccion('crear');
    </script>
</body>
</html>