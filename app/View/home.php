<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/home.css">
</head>
<style>
/* Estilos CSS personalizados */

/* Barra de navegação */
nav ul.nav {
    display: flex;
    justify-content: flex-end;
}

nav ul.nav li {
    margin-right: 20px;
}

nav ul.nav li a {
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: bold;
}

nav ul.nav li a:hover {
    color: #f39c12;
}

/* Cards de produtos */
.card {
    transition: transform 0.3s ease;
    border: none;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 20px;
    margin-bottom: 8px;
}

.card-text {
    color: #555;
    margin-bottom: 15px;
}

.btn-success {
    background-color: #4caf50;
    color: #fff;
    border: none;
    transition: background-color 0.3s ease;
}

.btn-success:hover {
    background-color: #45a049;
}

/* Footer */
footer {
    text-align: center;
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

footer p {
    margin-bottom: 0;
}
.dark-theme body {
    background-color: #111;
    color: #f9f9f9;
    transition: background-color 0.3s ease;
}

.dark-theme main {
    background-color: #222;
    color: #f9f9f9;
    transition: background-color 0.3s ease;
}
.dark-theme nav ul.nav li a {
    color: #f9f9f9;
}

.dark-theme nav ul.nav li a:hover {
    color: #f39c12;
}

/* Cards de produtos para a versão escura */
.dark-theme body {
    background-color: #111;
    color: #f9f9f9;
    transition: background-color 0.3s ease;
}

.dark-theme main {
    background-color: #222;
    color: #f9f9f9;
    transition: background-color 0.3s ease;
}

.dark-theme header, .dark-theme .navbar {
    background-color: #111 !important;
    color: #f9f9f9;
}

.dark-theme .navbar-nav .nav-link {
    color: #f9f9f9 !important;
}

.dark-theme .navbar-toggler-icon {
    background-color: #f9f9f9 !important;
}

.dark-theme .navbar-toggler {
    border-color: #f9f9f9 !important;
}

.dark-theme .navbar-toggler-icon:hover {
    background-color: #ccc !important;
}
.dark-theme .card {
    background-color: #333;
    color: #f9f9f9;
    transition: transform 0.3s ease;
    border: none;
}

.dark-theme .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
}

.dark-theme .card-title {
    font-size: 20px;
    margin-bottom: 8px;
    color: #f9f9f9;
}

.dark-theme .card-text {
    color: #ccc;
    margin-bottom: 15px;
}
.img {
    height: 320px; 
    overflow: hidden;
}

.card {
    margin-bottom: 20px; 
}
.dark-theme .btn-success {
    background-color: #45a049;
    color: #fff;
    border: none;
    transition: background-color 0.3s ease;
}

.dark-theme .btn-success:hover {
    background-color: #4caf50;
}

/* Footer para a versão escura */
.dark-theme footer {
    background-color: #1f1f1f;
    color: #f9f9f9;
    padding: 20px 0;
}

.dark-theme footer p {
    margin-bottom: 0;
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

    <main class="py-5">
        <div class="container">
            <h2 class="mb-4">Nossos Produtos</h2>
            <div class="row">
                <?php foreach ($produtos as $produto) { ?>
                <div class="col-md-4 mb-4 ">
                    <div class="card h-100">
                        <img src="<?= $produto->getImg() ?>" class="card-img-top img" alt="<?= $produto->getNome() ?>">
                        <div class="card-body">
                            <h3 class="card-title"><?= $produto->getNome() ?></h3>
                            <p class="card-text"><?= $produto->getDescricao() ?></p>
                            <p class="card-text">$<?= $produto->getValor() ?></p>
                            <?php if ( isset($_SESSION['usuario_id'])) {?>
                                <a href="/php-system-ecormerc/public/index.php/addCarrinho/?usuario_id=<?= $_SESSION['usuario_id'] ?>&produto_id=<?= $produto->getId(); ?>" class="btn btn-success btn-block">Adicionar ao Carrinho</a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <footer class="bg-dark text-light py-3">
        <div class="container">
            <p>&copy; 2023 Minha Loja Online. Todos os direitos reservados.</p>
        </div>
    </footer>
    <script>
    document.getElementById('theme-toggle').addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
