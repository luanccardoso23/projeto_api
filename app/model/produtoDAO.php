<?php

namespace App\model;
use App\model\Conexao;
use Exception;

class ProdutoDAO{
    private $tabela = "produto";

    public function consultar(){
        $comando = "SELECT * FROM {$this->tabela}";
        
        $preparacao = Conexao::getConexao()->prepare($comando);
        $preparacao->execute();

        if($preparacao->rowCount() > 0){
            return $preparacao->fetchALL(\PDO::FETCH_ASSOC);

        }
        else{
            throw new \Exception("Nenhum dado encontrado, o banco de dados está vazio");// estamos lançando um erro para ser tratado pelo catch

        }
    }
    public function inserir($dados){
        $comando = "INSERT INTO {$this->tabela} VALUES(NULL, :nome, :preco, :info)";

        $preparacao = Conexao::getConexao()->prepare($comando);

        $preparacao->bindValue(":nome", $dados["nome_produto"]);
        $preparacao->bindValue(":preco", $dados["preco_produto"]);
        $preparacao->bindValue(":info", $dados["info_produto"]);

        $preparacao->execute();

        if($preparacao->rowCount() > 0){
            return "Dados inseridos com sucesso.";

        }
        else{
            throw new \Exeception("Erro ao cadastrar as informações");
        }

    }
}