<?php

namespace Pearl\Controllers\Api\Users;
use Pearl\Controllers\Interfaces\ApiController;

Class ListAll extends ApiController
{
    public function renderPage():void
    {
       $retorno =$this->getCore()->getCidadaos()->findAll();
       $this->display($retorno);
    }
}
