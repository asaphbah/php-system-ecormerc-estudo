<?php 
namespace Controller;

use DAO\CarrinhoDAO;
use DAO\ProdutoDAO;
use Model\Produto;

require_once '/xampp/htdocs/php-system-ecormerc/app/DAO/ProdutoDAO.php';
require_once '/xampp/htdocs/php-system-ecormerc/app/DAO/CarrinhoDAO.php';

class ProdutoController{
    private $produtoDAO;
    private $carrinhoDAO;

    public function __construct() {
        $this->produtoDAO = new ProdutoDAO();
        $this->carrinhoDAO = new CarrinhoDAO();
    }
    public function getProdutoById($id){
        $produto = $this->produtoDAO->getProdutoById($id);
        include '/xampp/htdocs/php-system-ecormerc/app/View/';
    }
    public function getAllProdutos(){
        $produtos = $this->produtoDAO->listProducts();
        include '/xampp/htdocs/php-system-ecormerc/app/View/home.php';
    }

}