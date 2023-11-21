<?php
namespace Controller;

use DAO\CarrinhoDAO;
use DAO\ProdutoDAO;
use DAO\UsuarioDAO;

require_once '/xampp/htdocs/php-system-ecormerc/app/DAO/UsuarioDAO.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/DAO/ProdutoDAO.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/DAO/CompraDAO.php';

class UsuarioController {
    private $userDAO;
    private $produtoDAO;
    private $carrinhoDAO;

    public function __construct() {
        $this->userDAO = new UsuarioDAO();
        $this->produtoDAO = new ProdutoDAO();
        $this->carrinhoDAO = new CarrinhoDAO();
    }

    public function produtoCarrinho($usuario_id){
        $compras = $this->userDAO->getHistoricoComprasUsuario($usuario_id);
        include '/xampp/htdocs/php-system-ecormerc/app/View/historico.php';
    }
    public function historico($usuario_id){
        $compras = $this->produtoDAO->getProdutosNoCarrinho($usuario_id);
    }
    public function addCarrinhoProduto($usuario_id, $product_id){
        $this->userDAO->addProductToCart($usuario_id, $product_id);
       
    }
    public function listProdutosCarrinho($usuario_id) {
        $carrinhos = $this->carrinhoDAO->listProdutosCarrinho($usuario_id);
        include '/xampp/htdocs/php-system-ecormerc/app/View/carrinho.php';
    }
    public function removeProdutoCarrinho($usuario_id, $product_id){
        $this->userDAO->removeProductFromCart($usuario_id, $product_id);
        header('Location: /php-system-ecormerc/public/index.php/carrinho');
    }
    public function criaUsuario(){
        include '/xampp/htdocs/php-system-ecormerc/app/View/form.php';
    }
    public function insertUsuario($nome, $email, $senha){
        $this->userDAO->createUser($nome, $email, $senha);
        return true;
    }
    public function login(){
        include '/xampp/htdocs/php-system-ecormerc/app/View/login.php';
    }
    public function autenticaçãoUsuario($email, $senha){
        $usuario = $this->userDAO->autenticaUsuario($email, $senha);
        if($usuario) {
            // Iniciar a sessão
            session_start();
    
            $_SESSION['usuario_id'] = $usuario->getId();    

            header('Location: /php-system-ecormerc/public/index.php/produtos');
            exit();
        } else {

            header('Location: /php-system-ecormerc/public/index.php/login');
            exit();
        }
    }
}
