<?php

namespace Pearl\Controllers\Api\Users;
use Pearl\Controllers\Interfaces\ApiController;

class Add extends ApiController
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
       $cep = $data->cep;
       if($nome == ""||$sobrenome == ""||$cpf == ""||$email == ""||$celular == ""||$cep == ""){
          $this->display("Preencha Corretamente!");
       }
        $retorno= $this->getCore()->getCidadaos()->AddCidadao($nome,$sobrenome,$cpf,$email,$celular,$cep);
      if ($retorno){
          $this->display("Cadastrado com Sucesso!");
      }else{
          $this->display("Erro ao Cadastrar!");
      }
   }
}