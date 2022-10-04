<?php
require_once("vendor/autoload.php");
//use App\controller\ProdutoController;

  //print_r($_GET);
  $rota = !empty($_GET["url"]) ? $_GET["url"] : "Nada ainda aqui";// Verifica se a url não está vazia, se estiver exibe um texto, caso contrário atribui o conteúdo normal
  echo $rota;


  $rota = explode("/",$rota);// explode irá criar um vetor separando as informações quando encontrar uma /

  echo "<hr>";
  print_r($rota);
  //Verificando se o usuário está querendo acessar a API
  if($rota[0] === "api"){
      echo "Chegou na api <hr>";
      array_shift($rota);
      print_r($rota);

    //   $meuProduto = new App\controller\ProdutoController();
    //   echo "<hr>";
    //   $meuProduto->inicio();

      //PEGANDO A INFORMAÇÃO DO SERVIÇO QUE O USUÁRIO QUER ACESSAR

      if(!file_exists("App\controller\\".$rota[0]."Controller.php")){
          echo "<hr> Esse serviço não está disponível";

      }
      else{
        $servico = "App\controller\\".ucfirst($rota[0])."Controller";//organizando o caminho para deixar com o mesmo da classe da pasta controller
        echo "<hr> {$servico}";


        array_shift($rota);
        $verboHTTP = strtolower($_SERVER["REQUEST_METHOD"]);//está pegando o verbo http que é o método de envio dos dados, ou seja, get, post, put e delete.
        echo "<hr> {$verboHTTP}";
        try {
          array_shift($rota);
          $resposta = call_user_func_array(array(new $servico, $verboHTTP), $rota);//Estamos instanciando dinamicamente a classe ProdutoController e informando qual método da classe será executado, passando a variável $verboHTTP, que será get, post, put, delete. A variável $rota será utilizada para passar o parametro para o metodo da nossa classe, seria algo como delete(1) ou por exemplo put(1).

          echo $resposta;
        } catch (\Exception $erro) {
          
        }
      }
     



     }
       else{
         echo"Tá querendo acessar outra coisa né?";

     }