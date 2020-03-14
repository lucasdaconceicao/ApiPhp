<?php

namespace Pearl\Controllers\Api\Users;
use Pearl\Services\Cidadaos;
use Pearl\Controllers\Interfaces\ApiController;

Class ListCidadao extends ApiController
{
    public function renderPage():void
    {
        $data= file_get_contents('php://input');
        if($data != "") {
            $data = json_decode($data);
            $cpf = $data->cpf;
            $retorno = $this->getCore()->getCidadaos()->findByCpf($cpf);
            $this->display($retorno);
        }
    }
}
