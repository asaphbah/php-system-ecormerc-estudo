<?php

use DAO\CompraDAO;
use DAO\ProdutoDAO;
use DAO\UsuarioDAO;
use Models\Compra;

class CompraController {
    private $compraDAO;
    private $usuarioDAO;
    private $produtoDAO;

    public function __construct() {
        $this->compraDAO = new CompraDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->produtoDAO = new ProdutoDAO();
    }
    public function saveCompra($total, $usuario_id) {
        $compra = new Compra(
            $total,
            $usuario_id
        );
        $compraDb = $this->compraDAO->criarCompra($compra);
        $this->compraDAO->adicionarProdutosACompra($compraDb->getId(), $this->produtoDAO->getProdutosNoCarrinho( $_SESSION['usuario_id']) );
        $this->compraDAO->removerProdutosDoCarrinho( $_SESSION['usuario_id']);
        header('Location: /php-system-ecormerc/public/index.php/carrinho');
    }
}
