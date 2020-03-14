<?php

namespace Pearl\Controllers\Api\Users;
use Pearl\Controllers\Interfaces\ApiController;

class Delete extends ApiController
{
   public function renderPage():void
   {
       $data = file_get_contents('php://input');
       $data = json_decode($data);
       $cpf = $data->cpf;
       if($cpf == ""){
          $this->display("Preencha Corretamente!");
       }
        $retorno = $this->getCore()->getCidadaos()->Deletar($cpf);
      if ($retorno){
          $this->display("Excluído com Sucesso!");
      }else{
          $this->display("Erro ao Excluir!");
      }
   }
}