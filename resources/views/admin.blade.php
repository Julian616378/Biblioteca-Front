<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administrador</title>
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
            font-size: 2.5rem;
        }
        
        h2 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px dashed var(--color-acento);
        }
        
        button {
            background-color: var(--color-boton);
            color: white;
            border: none;
            padding: 12px 20px;
            margin: 5px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        button:hover {
            background-color: var(--color-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .seccion-botones {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
            gap: 10px;
        }
        
        .seccion-contenido {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 20px;
            animation: fadeIn 0.5s ease-out;
            border-left: 5px solid var(--color-lomo);
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid var(--color-acento);
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus {
            border-color: var(--color-tapa);
            outline: none;
            box-shadow: 0 0 0 2px rgba(93, 64, 55, 0.2);
        }
        
        #listaPendientes, #listaAprobados {
            margin-top: 20px;
        }
        
        .prestamo-item {
            background-color: var(--color-papel);
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid var(--color-lomo);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .prestamo-item:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .prestamo-item strong {
            color: var(--color-tapa);
        }
        
        .prestamo-item button {
            margin-top: 10px;
            background-color: var(--color-exito);
        }
        
        .prestamo-item button:hover {
            background-color: #388e3c;
        }
        
        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0,0,0,0), var(--color-acento), rgba(0,0,0,0));
            margin: 20px 0;
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
        
        .libro-form {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .refresh-btn {
            background-color: var(--color-acento);
            margin-bottom: 20px;
        }
        
        .refresh-btn:hover {
            background-color: var(--color-lomo);
        }
        
        .no-items {
            text-align: center;
            color: var(--color-acento);
            font-style: italic;
            padding: 20px;
        }
        .close{
            display: flex;
            position: absolute;
            z-index: 999;
        }
        
    </style>
</head>
<body>
<button onclick="cerrarSesion()" style="float:right;" class="close">🚪 Cerrar sesión</button>
    <h1 class="animate__animated animate__fadeIn">Panel de Administrador</h1>

    <div class="seccion-botones">
        <button onclick="mostrarSeccion('crear')" class="animate__animated animate__fadeInLeft">📚 Crear Libro</button>
        <button onclick="mostrarSeccion('pendientes')" class="animate__animated animate__fadeInUp">⏳ Aprobar Préstamos</button>
        <button onclick="mostrarSeccion('aprobados')" class="animate__animated animate__fadeInRight">✅ Ver Préstamos Aprobados</button>
    </div>

    <div id="seccionCrear" class="seccion-contenido" style="display:none;">
        <h2>Crear nuevo libro</h2>
        <div class="libro-form">
            <input type="text" id="titulo" placeholder="Título"><br>
            <input type="text" id="autor" placeholder="Autor"><br>
            <input type="text" id="materia" placeholder="Materia"><br>
            <input type="text" id="genero" placeholder="Género"><br>
            <button onclick="crearLibro()" class="animate__animated animate__pulse animate__infinite">Crear libro</button>
        </div>
    </div>

    <div id="seccionPendientes" class="seccion-contenido" style="display:none;">
        <h2>Préstamos pendientes de aprobación</h2>
        <div id="listaPendientes"></div>
    </div>

    <div id="seccionAprobados" class="seccion-contenido" style="display:none;">
        <h2>Préstamos aprobados</h2>
        <button onclick="cargarAprobados()" class="refresh-btn animate__animated animate__pulse animate__infinite animate__slower">🔄 Actualizar lista de aprobados</button>
        <div id="listaAprobados"></div>
    </div>

<script>
    const token = sessionStorage.getItem('token');
    const role = sessionStorage.getItem('role');

    // Proteger la vista: solo admin

    function mostrarSeccion(seccion) {
        document.getElementById('seccionCrear').style.display = 'none';
        document.getElementById('seccionPendientes').style.display = 'none';
        document.getElementById('seccionAprobados').style.display = 'none';

        if (seccion === 'crear') {
            document.getElementById('seccionCrear').style.display = 'block';
        } else if (seccion === 'pendientes') {
            document.getElementById('seccionPendientes').style.display = 'block';
            cargarPendientes();
        } else if (seccion === 'aprobados') {
            document.getElementById('seccionAprobados').style.display = 'block';
            cargarAprobados();
        }
    }

    function crearLibro() {
        const titulo = document.getElementById('titulo').value;
        const autor = document.getElementById('autor').value;
        
        if (!titulo || !autor) {
            alert('El título y el autor son campos obligatorios');
            return;
        }

        const data = {
            titulo: titulo,
            autor: document.getElementById('autor').value,
            materia: document.getElementById('materia').value,
            genero: document.getElementById('genero').value
        };

        const btn = document.querySelector('#seccionCrear button');
        btn.classList.remove('animate__pulse', 'animate__infinite');
        btn.textContent = 'Creando...';
        btn.style.backgroundColor = 'var(--color-acento)';

        axios.post('http://localhost:8000/api/libros', data, {
            headers: { Authorization: 'Bearer ' + token }
        })
        .then(res => {
            btn.textContent = '✓ Libro Creado';
            btn.style.backgroundColor = 'var(--color-exito)';
            setTimeout(() => {
                btn.textContent = 'Crear libro';
                btn.style.backgroundColor = 'var(--color-boton)';
                btn.classList.add('animate__pulse', 'animate__infinite');
            }, 2000);
            
            // Limpiar campos
            document.getElementById('titulo').value = '';
            document.getElementById('autor').value = '';
            document.getElementById('materia').value = '';
            document.getElementById('genero').value = '';
            
            // Animación de éxito
            const seccion = document.getElementById('seccionCrear');
            seccion.classList.add('animate__animated', 'animate__tada');
            setTimeout(() => {
                seccion.classList.remove('animate__animated', 'animate__tada');
            }, 1000);
        })
        .catch(err => {
            console.error('Error al crear libro:', err);
            btn.textContent = 'Error al crear';
            btn.style.backgroundColor = 'var(--color-error)';
            setTimeout(() => {
                btn.textContent = 'Crear libro';
                btn.style.backgroundColor = 'var(--color-boton)';
                btn.classList.add('animate__pulse', 'animate__infinite');
            }, 2000);
        });
    }

    function cargarPendientes() {
    const lista = document.getElementById('listaPendientes');
    lista.innerHTML = '<p>Cargando préstamos pendientes...</p>';
    
    axios.get('http://localhost:8000/api/prestamos', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        const prestamos = res.data;
        const pendientes = prestamos.filter(p => p.libro.disponible);

        let html = '';
        if (pendientes.length === 0) {
            html = '<p class="no-items">No hay préstamos pendientes de aprobación</p>';
        } else {
            pendientes.forEach(p => {
                html += `
                    <div class="prestamo-item animate__animated animate__fadeIn" id="prestamo-${p.id}">
                        <p><strong>Libro:</strong> ${p.libro.titulo} <br>
                        <strong>Autor:</strong> ${p.libro.autor} <br>
                        <strong>Usuario ID:</strong> ${p.user_id} <br>
                        <strong>Solicitado el:</strong> ${p.fecha_prestamo}</p>
                        <div class="btn-group">
                            <button onclick="aprobarPrestamo(${p.id}, this)" class="btn-success">Aprobar Préstamo</button>
                            <button onclick="ocultarPrestamo(${p.id}, this)" class="btn-warning">👁️ Ocultar</button>
                        </div>
                    </div>
                `;
            });
        }

        lista.innerHTML = html;
    })
    .catch(err => {
        console.error('Error al cargar préstamos pendientes:', err);
        lista.innerHTML = '<p class="no-items" style="color:var(--color-error)">Error al cargar préstamos pendientes</p>';
    });
}
function ocultarPrestamo(prestamoId, btn) {
    btn.disabled = true;
    btn.textContent = 'Ocultando...';
    
    // Aquí puedes implementar la lógica para marcar el préstamo como oculto
    // Por ahora solo lo quitaremos del frontend sin afectar la base de datos
    
    const item = document.getElementById(`prestamo-${prestamoId}`);
    if (item) {
        item.classList.add('animate__animated', 'animate__fadeOut');
        setTimeout(() => {
            item.remove();
            if (document.querySelectorAll('.prestamo-item').length === 0) {
                document.getElementById('listaPendientes').innerHTML = 
                    '<p class="no-items">No hay préstamos pendientes de aprobación</p>';
            }
        }, 500);
    }
    
}
    function aprobarPrestamo(id, btn) {
        btn.textContent = 'Aprobando...';
        btn.disabled = true;
        
        axios.post(`http://localhost:8000/api/prestamos/${id}/aprobar`, {}, {
            headers: { Authorization: 'Bearer ' + token }
        })
        .then(res => {
            btn.textContent = '✓ Aprobado';
            btn.style.backgroundColor = 'var(--color-exito)';
            
            // Animación al aprobar
            const item = btn.closest('.prestamo-item');
            item.classList.add('animate__animated', 'animate__bounceOutLeft');
            
            setTimeout(() => {
                cargarPendientes(); // Actualiza la lista
            }, 500);
        })
        .catch(err => {
            console.error('Error al aprobar préstamo:', err);
            btn.textContent = 'Error al aprobar';
            btn.style.backgroundColor = 'var(--color-error)';
            setTimeout(() => {
                btn.textContent = 'Aprobar Préstamo';
                btn.style.backgroundColor = 'var(--color-exito)';
                btn.disabled = false;
            }, 2000);
        });
    }

    function cargarAprobados() {
    const lista = document.getElementById('listaAprobados');
    lista.innerHTML = '<p>Cargando préstamos aprobados...</p>';
    
    const refreshBtn = document.querySelector('#seccionAprobados button');
    refreshBtn.classList.remove('animate__pulse', 'animate__infinite');
    refreshBtn.textContent = 'Cargando...';
    
    axios.get('http://localhost:8000/api/prestamos', {
        headers: { Authorization: 'Bearer ' + token }
    })
    .then(res => {
        let html = '';
        if (res.data.length === 0) {
            html = '<p class="no-items">No hay préstamos registrados</p>';
        } else {
            res.data.forEach(p => {
                html += `
                    <div class="prestamo-item animate__animated animate__fadeIn" data-id="${p.id}">
                        <p><strong>Libro:</strong> ${p.libro.titulo} <br>
                        <strong>Autor:</strong> ${p.libro.autor} <br>
                        <strong>Usuario:</strong> ${p.user ? p.user.name : 'ID: '+p.user_id} <br>
                        <strong>Fecha Préstamo:</strong> ${p.fecha_prestamo} <br>
                        <strong>Fecha Devolución:</strong> ${p.fecha_devolucion} <br>
                        <strong>Estado:</strong> ${p.devuelto ? 
                            '<span style="color:var(--color-exito);">✓ Devuelto</span>' : 
                            '<span style="color:var(--color-error);">✗ Prestado</span>'}
                        </p>
                        ${!p.devuelto ? `
                            <button onclick="marcarDevuelto(${p.id}, this)" class="btn-success">
                                ✅ Marcar como devuelto
                            </button>
                        ` : ''}
                    </div>
                `;
            });
        }

        lista.innerHTML = html;
        refreshBtn.textContent = '🔄 Actualizar lista';
        refreshBtn.classList.add('animate__pulse', 'animate__infinite', 'animate__slower');
    })
    .catch(err => {
        console.error('Error al cargar préstamos:', err);
        lista.innerHTML = '<p class="no-items" style="color:var(--color-error)">Error al cargar préstamos</p>';
        refreshBtn.textContent = '🔄 Intentar nuevamente';
        refreshBtn.classList.add('animate__pulse', 'animate__infinite', 'animate__slower');
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
            const item = btn.closest('.prestamo-item');
            item.classList.add('animate__animated', 'animate__bounceOut');
            setTimeout(() => cargarAprobados(), 500);
        } else {
            throw new Error(res.data.mensaje || 'Error al marcar como devuelto');
        }
    })
    .catch(err => {
        console.error('Error:', err);
        btn.disabled = false;
        btn.textContent = '✅ Marcar como devuelto';
        alert(err.message || 'Error al procesar la solicitud');
    });
}
    function cerrarSesion() {
        const login = "{{ URL('/') }}"

    sessionStorage.clear();
    window.location.href = login; // Cambia la ruta
}
</script>

</body>
</html>