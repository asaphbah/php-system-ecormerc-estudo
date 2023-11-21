<?php 

namespace Controller;

use DAO\CarrinhoDAO;
use Model\Carrinho;

class CarrinhoController{
    private $carrinhoDAO;

    public function __construct() {
        $this->carrinhoDAO = new CarrinhoDAO();
    }
    public function getProdutoById($id){
    
    }
    public function getAllProdutos(){
        
    }
    public function saveProduto($carrinhoData){
      
    }
    public function updadeProduto($carrinhoData){
      
    }
    public function deleteProduto($id){
       
    }
}