<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras - Minha Loja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/history.css">
</head>
<style>
    body {
        height: 100vh;
        transition: background-color 0.3s ease;
        margin: 0;
    }
    
    .dark-theme {
        background-color: #111;
        color: #f9f9f9;
    }
    
    .dark-theme nav, header {
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
    
    .dark-theme .navbar, .dark-theme .card {
        background-color: #111 !important;
    }
    
    .dark-theme .navbar-brand, .dark-theme .navbar-nav .nav-link {
        color: #f9f9f9 !important;
    }
    
    .main-content {
        width: 100%;
        max-width: 800px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        background-color: #fff;
        margin: 20px auto;
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
    
    .purchase-history {
        list-style: none;
        padding: 0;
    }
    
    .purchase-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }
    
    .purchase-item:last-child {
        border-bottom: none;
    }
    
    .purchase-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .purchase-info {
        display: flex;
        align-items: center;
    }
    
    .purchase-id {
        font-weight: bold;
        margin-right: 10px;
    }
    
    .purchase-date {
        color: #777;
    }
    
    .purchase-amount {
        font-weight: bold;
        color: #4caf50;
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
                        <li class="nav-item">
                            <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/produtos">Home</a>
                        </li>
                        <?php  if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {?>
                            <li class="nav-item">
                            <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/historico">Histórico</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/carrinho">Carrinho</a>
                            </li>
                            <li class="nav-item">
                            <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/logout">deslogar</a>
                        </li>
                        <?php }?>

                        <li class="nav-item">
                            <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light btn-theme" href="/php-system-ecormerc/public/index.php/cadastroUser">Cadastro de usuario</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

    <main>
        <div class="container main-content">
            <div class="card">
                <div class="card-header">Histórico de Compras</div>
                <ul class="purchase-history">
                    <!-- Exemplo de item no histórico -->
                    <?php foreach($compras as $compra){?>
                    <li class="purchase-item">
                        <div class="purchase-details">
                            <div class="purchase-info">
                                <p class="purchase-id">Compra #<?= $compra->getId()?></p>
                               <div>
                               <p class="purchase-date">Data: <?= $compra->getData()?></p>
                               <p class="purchase-date">Hora: <?= $compra->getHora()?></p>
                               </div>
                            </div>
                            <p class="purchase-amount">$<?= $compra->getTotal()?></p>
                        </div>
                    </li>
                    <?php } ?>
                    <!-- Mais itens podem ser adicionados seguindo a estrutura acima -->
                </ul>
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
