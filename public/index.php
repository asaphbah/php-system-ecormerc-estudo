<?php

use Controller\CarrinhoController;
use Controller\ProdutoController;
use Controller\UsuarioController;

require_once '/xampp/htdocs/php-system-ecormerc/app/Controllers/ProdutoController.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/Controllers/UsuarioControllers.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/Controllers/CarrinhoController.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/Controllers/CompraController.php';
// Obtém a URL e separa os parâmetros
$request = $_SERVER['REQUEST_URI'];
$params = explode('/', $request);
session_start();
// Verifica o primeiro parâmetro para determinar a ação
switch ($params[4]) {
    case 'produtos':
        $produtoController = new ProdutoController();
        $produtoController->getAllProdutos();
        break;
    
    case 'login':
        $usuarioController = new UsuarioController();
        $usuarioController->login();
        break;
    case 'auth':
        $usuarioController = new UsuarioController();
        $usuarioController->autenticaçãoUsuario($_POST['email'],$_POST['senha']);
        break;
    case 'cadastroUser':
    
        $usuarioController = new UsuarioController();
        $usuarioController->criaUsuario();
            break;
    case 'insertUser':
        $usuarioController = new UsuarioController();
        $verifica = $usuarioController->insertUsuario($_POST['nome'],$_POST['email'],$_POST['senha']);
        if ($verifica) {
            header('Location: /php-system-ecormerc/public/index.php/login');
        } else {
            header('Location: /php-system-ecormerc/public/index.php/cadastroUser?erro=erro');
        }
    break;
    case 'compra':
        if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) { 
            $compraController = new CompraController();
            $compraController->saveCompra($_GET['total'],$_GET['usuario_id']);
        }
        break;
    case 'removerCompra':
        if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {
            $usuarioController = new UsuarioController();
            $usuarioController->removeProdutoCarrinho($_SESSION['usuario_id'], $_GET['produto_id']);
        }   
         break;
    case 'logout':
            // Limpa todas as variáveis de sessão
            if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {
                $_SESSION['usuario_id'] = 0;
            
                // Redireciona para a página de login ou outra página desejada
                header('Location: /php-system-ecormerc/public/index.php/login');
            }
       
        break;
        case 'addCarrinho':
            if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {
                $usuarioController = new UsuarioController();
                $usuarioController->addCarrinhoProduto($_GET['usuario_id'], $_GET['produto_id']);
                header('Location: /php-system-ecormerc/public/index.php/produtos');
            }
            break;
    
        case 'historico':
            if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {
            $usuarioController = new UsuarioController();
            $usuarioController->produtoCarrinho($_SESSION['usuario_id']);
            }
            break;
        case 'carrinho':
            if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_id'] != 0) {
            $usuarioController = new UsuarioController();
            $usuarioController->listProdutosCarrinho($_SESSION['usuario_id']);
            if (isset($params[5]) && $params[5] == 'compra') {
                $compraController = new CompraController();
                $compraController->saveCompra($_GET['total'],$_GET['usuario_id']);
            }
        }
            break;
    default:
        // Rota não encontrada
        echo "Rota não encontrada...";
        break;
}
