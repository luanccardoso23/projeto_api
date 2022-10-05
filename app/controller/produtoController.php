<?php
namespace App\controller;// utilizando namespace para identificar nossa classe
use App\model\ProdutoDAO;

class ProdutoController{
    public function get(){
        $meuProduto = new ProdutoDAO();
        return $meuProduto->consultar();
    }
    public function post(){
       $meuProduto = new ProdutoDAO();
       return $meuProduto->inserir($_POST);
      // var_dump($_POST);
    }
    public function put($id){
       return "estou no método put";
    }
    public function delete($id){
        return "Estou no método delete";
    }

}