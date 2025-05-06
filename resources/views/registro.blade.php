<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario - Biblioteca</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=Roboto:wght@300;400&display=swap');
        
        body {
            background: #f5f1e9;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(94, 80, 63, 0.7);
            z-index: 0;
        }
        
        .registro-form {
            background: #fffdf9;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(94, 80, 63, 0.4);
            width: 100%;
            max-width: 420px;
            animation: fadeInUp 0.8s ease-out;
            position: relative;
            z-index: 1;
            border: 1px solid #d4c8b5;
            transform-style: preserve-3d;
            perspective: 1000px;
        }
        
        .registro-form::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #8b7355, #d4c8b5, #5e503f);
            z-index: -1;
            border-radius: 18px;
            opacity: 0.3;
            animation: gradientRotate 8s ease infinite;
            background-size: 200% 200%;
        }
        
        .registro-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #5e503f;
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 28px;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .registro-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #8b7355;
            border-radius: 3px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
            animation: fadeIn 0.6s ease-out;
            animation-fill-mode: both;
        }
        
        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }
        .form-group:nth-child(3) { animation-delay: 0.4s; }
        .form-group:nth-child(4) { animation-delay: 0.5s; }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #5e503f;
            font-weight: 400;
            font-size: 14px;
            letter-spacing: 0.5px;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d4c8b5;
            transition: all 0.4s ease;
            background: #fffdf9;
            color: #5e503f;
            font-size: 15px;
            box-shadow: 0 2px 5px rgba(94, 80, 63, 0.05);
        }
        
        .form-group input:focus, .form-group select:focus {
            border-color: #8b7355;
            outline: none;
            box-shadow: 0 4px 10px rgba(139, 115, 85, 0.15);
            transform: translateY(-2px);
        }
        
        .form-group input::placeholder {
            color: #b8a99a;
        }
        
        .boton {
            width: 100%;
            background-color: #8b7355;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.4s ease;
            font-size: 16px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(139, 115, 85, 0.3);
        }
        
        .boton:hover {
            background-color: #5e503f;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(94, 80, 63, 0.4);
        }
        
        .boton:active {
            transform: translateY(0);
        }
        
        .mensaje {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            animation: fadeIn 0.5s ease-out;
        }
        
        .mensaje.error {
            color: #a64444;
            background-color: #f8e8e8;
            border: 1px solid #e8c8c8;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(94, 80, 63, 0.8);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.4s ease-out;
            backdrop-filter: blur(5px);
        }
        
        .modal-contenido {
            background: #fffdf9;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            max-width: 380px;
            box-shadow: 0 15px 30px rgba(94, 80, 63, 0.5);
            animation: modalAppear 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #d4c8b5;
            position: relative;
            overflow: hidden;
        }
        
        .modal-contenido::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #8b7355, #d4c8b5, #5e503f);
        }
        
        .modal-contenido h3 {
            margin-bottom: 20px;
            color: #5e503f;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
        }
        
        .modal-contenido p {
            margin-bottom: 25px;
            color: #5e503f;
            line-height: 1.6;
        }
        
        .modal-contenido .boton {
            background-color: #5e503f;
            width: auto;
            padding: 12px 30px;
            display: inline-block;
        }
        
        .modal-contenido .boton:hover {
            background-color: #3a3228;
        }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes modalAppear {
            from { 
                opacity: 0;
                transform: scale(0.8) translateY(20px);
            }
            to { 
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        
        @keyframes gradientRotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Efecto libro abierto */
        .registro-form {
            position: relative;
        }
        
        .registro-form::after {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, transparent, #d4c8b5, transparent);
            opacity: 0.5;
        }
        
        /* Decoración */
        .libro-icon {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
        }
        
        .libro-icon.top-left {
            top: 20px;
            left: 20px;
            font-size: 60px;
            transform: rotate(-15deg);
            animation: float 6s ease-in-out infinite;
        }
        
        .libro-icon.bottom-right {
            bottom: 20px;
            right: 20px;
            font-size: 50px;
            transform: rotate(10deg);
            animation: float 7s ease-in-out infinite 1s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-15deg); }
            50% { transform: translateY(-10px) rotate(-18deg); }
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .registro-form {
                padding: 30px 20px;
                margin: 0 15px;
            }
        }
    </style>
</head>
<body>

<div class="registro-form">
    <span class="libro-icon top-left">📚</span>
    <span class="libro-icon bottom-right">📖</span>
    
    <h2>Registro de Biblioteca</h2>
    <div class="form-group">
        <label for="nombre">Nombre Completo</label>
        <input type="text" id="nombre" placeholder="Ej: María González">
    </div>

    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" placeholder="usuario@biblioteca.com">
    </div>

    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Mínimo 6 caracteres">
    </div>

    <div class="form-group">
        <label for="role">Tipo de Usuario</label>
        <select id="role">
            <option value="usuario" selected>Usuario General</option>
            <option value="admin">Administrador</option>
        </select>
    </div>

    <button class="boton" onclick="registrarse()">
        <span>Registrarse</span>
    </button>

    <div id="mensaje" class="mensaje"></div>
</div>

<!-- Modal -->
<div id="modalExito" class="modal">
    <div class="modal-contenido">
        <h3>¡Registro Completado!</h3>
        <p>Bienvenido/a a nuestra biblioteca. Tu cuenta ha sido creada exitosamente. Ahora puedes acceder a todos nuestros recursos.</p>
        <button class="boton" onclick="irAlLogin()">Ir al Inicio de Sesión</button>
    </div>
</div>

<script>
    function registrarse() {
        const nombre = document.getElementById('nombre').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const role = document.getElementById('role').value;

        const mensajeDiv = document.getElementById('mensaje');
        mensajeDiv.innerText = '';
        mensajeDiv.className = 'mensaje';

        if (!nombre || !email || !password) {
            mensajeDiv.innerText = 'Por favor completa todos los campos';
            mensajeDiv.classList.add('error');
            return;
        }

        // Animación de carga
        const boton = document.querySelector('.boton');
        boton.innerHTML = '<span>Registrando...</span>';
        boton.style.pointerEvents = 'none';
        
        // Simulamos una petición con setTimeout para ver las animaciones
        setTimeout(() => {
            axios.post('http://localhost:8000/api/register', {
                nombre: nombre,
                email: email,
                password: password,
                role: role
            })
            .then(res => {
                // Mostrar el modal con éxito
                document.getElementById('modalExito').style.display = 'flex';
                
                // Limpiar campos
                document.getElementById('nombre').value = '';
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
                document.getElementById('role').value = 'usuario';
            })
            .catch(err => {
                if (err.response && err.response.data.errors) {
                    const errores = Object.values(err.response.data.errors).flat().join(' ');
                    mensajeDiv.innerText = errores;
                } else {
                    mensajeDiv.innerText = 'Error al registrar. Por favor intente nuevamente.';
                }
                mensajeDiv.classList.add('error');
            })
            .finally(() => {
                boton.innerHTML = '<span>Registrarse</span>';
                boton.style.pointerEvents = 'auto';
            });
        }, 1500);
    }

    function irAlLogin() {
        window.location.href = "{{ URL('/') }}";
    }
</script>

</body>
</html>