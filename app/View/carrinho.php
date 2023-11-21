<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Minha Loja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/cart.css">
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
    
    .cart-items {
        list-style: none;
        padding: 0;
    }
    
    .cart-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }
    
    .cart-item:last-child {
        border-bottom: none;
    }
    
    .item-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .item-details {
        display: flex;
        align-items: center;
    }
    
    .item-image {
        width: 80px;
        height: 80px;
        margin-right: 20px;
    }
    
    .item-name {
        font-weight: bold;
    }
    
    .item-price {
        color: #4caf50;
    }
    
    .total-price {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
        text-align: right;
    }
    
    .checkout-btn {
        width: 100%;
        margin-top: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .checkout-btn:hover {
        background-color: #0056b3;
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
                <div class="card-header">Carrinho</div>
                <ul class="cart-items">
                    <?php  $valorTotal = 0 ?>
                    <!-- Exemplo de item no carrinho -->
                   <?php foreach($carrinhos as $produto){
                    $valorTotal += floatval($produto->getValor());
                     ?>
                   <li class="cart-item">
                        <div class="item-info">
                            <div class="item-details">
                                <img src="<?= $produto->getImg()?>" alt="Product Image" class="item-image">
                                <div>
                                    <p class="item-name"><?= $produto->getNome()?></p>
                                    <p class="item-price">$<?= $produto->getValor()?></p>
                                </div>
                            </div>
                            <div class="item-actions">
                                <a href="removerCompra/?usuario_id=<?php $_SESSION['usuario_id'] ?>&produto_id=<?= $produto->getId(); ?>" class="btn btn-danger">Remover</a>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                    <!-- Mais itens podem ser adicionados seguindo a estrutura acima -->
                </ul>
                <div class="total-price">Total: $<?= number_format($valorTotal, 2)?></div>
                <a href="compra/?usuario_id=<?= $_SESSION['usuario_id'] ?>&total=<?= $valorTotal ?>" class="btn checkout-btn">Finalizar Compra</a>
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
