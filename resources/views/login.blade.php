<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión | Biblioteca</title>
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
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeInUp 0.6s ease-out;
            border-top: 5px solid var(--color-lomo);
        }
        
        h1 {
            font-family: 'Merriweather', serif;
            color: var(--color-tapa);
            margin-bottom: 30px;
            font-size: 2rem;
        }
        
        input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid var(--color-acento);
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        input:focus {
            border-color: var(--color-tapa);
            outline: none;
            box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.2);
        }
        
        button {
            background-color: var(--color-boton);
            color: white;
            border: none;
            padding: 12px 25px;
            margin-top: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        }
        
        button:hover {
            background-color: var(--color-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s;
        }
        
        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: zoomIn 0.3s;
            border-top: 5px solid var(--color-error);
        }
        
        .modal-success {
            border-top-color: var(--color-exito);
        }
        
        .modal h2 {
            margin-top: 0;
            color: var(--color-tapa);
        }
        
        .modal p {
            margin-bottom: 25px;
        }
        
        .modal-btn {
            background-color: var(--color-boton);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .modal-btn:hover {
            background-color: var(--color-boton-hover);
        }
        
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 10px;
            vertical-align: middle;
        }
        
        .register-link {
            margin-top: 20px;
            color: var(--color-acento);
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: var(--color-tapa);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .register-link a:hover {
            color: var(--color-lomo);
            text-decoration: underline;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes zoomIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s;
        }
        
        .logo {
            max-width: 120px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Logo Biblioteca" class="logo">
        <h1>Iniciar Sesión</h1>
        <input type="email" id="email" placeholder="Correo electrónico" autocomplete="username">
        <input type="password" id="password" placeholder="Contraseña" autocomplete="current-password">
        <button onclick="login()" id="loginBtn">Iniciar sesión</button>
        
        <div class="register-link">
            ¿No tienes una cuenta? <a href="{{URL('/registro')}}">Regístrate aquí</a>
        </div>
    </div>

    <!-- Modal de error -->
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <h2>Error al iniciar sesión</h2>
            <p id="errorMessage">Credenciales incorrectas. Por favor, inténtalo de nuevo.</p>
            <button class="modal-btn" onclick="closeModal('errorModal')">Aceptar</button>
        </div>
    </div>

    <!-- Modal de carga -->
    <div id="loadingModal" class="modal">
        <div class="modal-content modal-success">
            <h2>Iniciando sesión</h2>
            <p>Por favor, espera un momento...</p>
            <div style="text-align: center;">
                <div class="loading"></div>
            </div>
        </div>
    </div>

    <script>
        function showModal(modalId, message = '') {
            if (message) {
                document.getElementById('errorMessage').textContent = message;
            }
            document.getElementById(modalId).style.display = 'flex';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        function login() {
            const home = "{{ route('home') }}";
            const admin = "{{ route('admin') }}";
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Validación básica
            if (!email || !password) {
                showModal('errorModal', 'Por favor completa todos los campos');
                document.getElementById('loginBtn').classList.add('shake');
                setTimeout(() => {
                    document.getElementById('loginBtn').classList.remove('shake');
                }, 500);
                return;
            }
            
            const data = { email, password };
            const loginBtn = document.getElementById('loginBtn');
            
            // Mostrar modal de carga
            showModal('loadingModal');
            loginBtn.disabled = true;
            loginBtn.innerHTML = '<span class="loading"></span> Procesando...';
            
            axios.post('http://localhost:8000/api/login', data)
            .then(res => {
                const token = res.data.token;
                sessionStorage.setItem('token', token);
                
                // Ocultar modal de carga
                closeModal('loadingModal');
                
                // Redirigir según el rol
                setTimeout(() => {
                    if (res.data.role === 'admin') {
                        location.href = admin;
                    } else {
                        location.href = home;
                    }
                }, 500);
            })
            .catch(err => {
                console.error('Error al iniciar sesión:', err);
                closeModal('loadingModal');
                
                // Mostrar modal de error
                let errorMessage = 'Error al iniciar sesión. Intenta de nuevo.';
                if (err.response && err.response.data && err.response.data.message) {
                    errorMessage = err.response.data.message;
                }
                
                showModal('errorModal', errorMessage);
                
                // Restaurar botón
                loginBtn.disabled = false;
                loginBtn.textContent = 'Iniciar sesión';
                
                // Animación de error
                document.querySelector('.login-container').classList.add('animate__animated', 'animate__shakeX');
                setTimeout(() => {
                    document.querySelector('.login-container').classList.remove('animate__animated', 'animate__shakeX');
                }, 1000);
            });
        }
        
        // Permitir cerrar modales haciendo clic fuera del contenido
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
        
        // Permitir login con Enter
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                login();
            }
        });
    </script>
</body>
</html>