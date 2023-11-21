<?php 

    namespace Models;

    class Carrinho {
        private $user_id;
        private $id;
        private $produto_id;


        public function __construct($produto_id, $id, $user_id) {
            $this->produto_id = $produto_id;
            $this->id = $id;
            $this->user_id = $user_id;
        }
        //get
        public function getId() {
            return $this->id;
        }
        public function getProdutoId() {
            return $this->produto_id;
        }
        public function getUsuarioId() {
            return $this->user_id;
        }
        // Set
        public function setUserId($user_id) {
            $this->user_id = $user_id;
        }
        public function setId($id) {
            $this->id = $id;
        }
        public function setProdutoId($produto_id) {
            $this->produto_id = $produto_id;
        }

    }
