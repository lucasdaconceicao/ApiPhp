<?php

namespace Pearl\Controllers\Api\Users;
use Pearl\Controllers\Interfaces\ApiController;

class Update extends ApiController
{
   public function renderPage():void
   {
       $data = file_get_contents('php://input');
       $data = json_decode($data);
       $nome = $data->nome;
       $sobrenome = $data->sobrenome;
       $cpf = $data->cpf;
       $email = $data->email;
       $celular = $data->celular;
       if($nome == ""||$sobrenome == ""||$cpf == ""||$email == ""||$celular == ""){
          $this->display("Preencha Corretamente!");
       }
        $retorno = $this->getCore()->getCidadaos()->Update($nome,$sobrenome,$cpf,$email,$celular);
      if ($retorno){
          $this->display("Atualizado com Sucesso!");
      }else{
          $this->display("Erro ao Atualizar!");
      }
   }
}