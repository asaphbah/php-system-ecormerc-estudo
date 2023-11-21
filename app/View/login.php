<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Minha Loja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/login.css">
</head>
<style>
    body {
        height: 100vh;
        transition: background-color 0.3s ease;
        margin: 0;
    }
    
    .dark-theme{
        background-color: #111;
        color: #f9f9f9;
    }
    .dark-theme nav, header{
        background-color: #252525;
        color: #f9f9f9;
    }
    .navbar {
        background-color: #252525 !important;
    }
    
    .navbar-brand, .navbar-nav .nav-link {
        color: #f9f9f9 !important;
        transition: color 0.3s ease;
    }
    
    .dark-theme .navbar,.dark-theme .card{
        background-color: #111 !important;
    }
    
    .dark-theme .navbar-brand, .dark-theme .navbar-nav .nav-link {
        color: #f9f9f9 !important;
    }
    
    .main-content {
        width: 100%;
        max-width: 500px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        background-color: #fff;
        margin-top: 20px;
    }
    
    .dark-theme .main-content {
        background-color: #222;
        border-color: #444;
    }
    
    .card-header {
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
        background-color: #333;
        color: #f9f9f9;
        padding: 10px 0;
        border-radius: 5px 5px 0 0;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .btn-login {
        width: 100%;
        background-color: #4caf50;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .btn-login:hover {
        background-color: #45a049;
    }
    
    .theme-toggle {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .btn-theme {
        background-color: #f39c12;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .btn-theme:hover {
        background-color: #e68a00;
    }

    /* Estilos para o link 'cadastrar-se' */
    a.signup-link {
        display: block;
        text-align: center;
        color: #333;
        margin-top: 10px;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
    }
    
    a.signup-link:hover {
        color: #f39c12;
    }

    /* Estilos específicos para o modo dark */
    .dark-theme a.signup-link {
        color: #f9f9f9;
    }
</style>
<body>
    <header class=" py-3">
        <div class="container">
            <h1 class="logo">Minha Loja Online</h1>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Minha Loja Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-light btn-theme" id="theme-toggle">Alternar Tema</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
        </div>
    </header>

    <main class="py-5">
        <div class="container main-content">
            <div class="card">
                <div class="card-header">Login</div>
                <form method="POST" action="/php-system-ecormerc/public/index.php/auth">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Digite seu email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
                    </div>
                    <a href="/php-system-ecormerc/public/index.php/cadastroUser" class="signup-link">Cadastrar-se</a>
                    <button type="submit" class="btn btn-login">Entrar</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
        });
    </script>
</body>
</html>
