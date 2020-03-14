<?php
namespace Pearl\Services;
use Pearl\Models\Cidadao;
Class Cidadaos {
    public function AddCidadao($nome,$sobrenome,$cpf,$email,$celular,$cep):bool {
        /** @var TYPE_NAME $exception */
        try {
            $data = $this->findCep($cep);
            if ($data){
                $cidadao = new Cidadao();
                $cidadao->nome = $nome;
                $cidadao->sobrenome = $sobrenome;
                $cidadao->cpf = $cpf;
                $cidadao->email = $email;
                $cidadao->celular = $celular;
                $cidadao->cep = $cep;
                $cidadao->logradouro = $data->logradouro;
                $cidadao->cidade = $data->localidade;
                $cidadao->uf = $data->uf;
                $cidadao->bairro = $data->bairro;
                $cidadao->save();
                return true;
            }
            else{
                return false;
            }
        }
        catch (Exception $e){
            return false;
        }
    }
    private function findCep($cep){
        try {
            $pagina = "viacep.com.br/ws/{$cep}/json/";
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $pagina );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $retorno = curl_exec( $ch );
            curl_close( $ch );
            $data=json_decode($retorno);
            return $data;
        }catch (Exception $e){
            return null;
        }
    }
    public function findAll(){
       return Cidadao::orderBy('nome')->get();
    }

    public function findByCpf($cpf){
        return Cidadao::where('cpf',$cpf)->first();
    }
    public function Update($nome,$sobrenome,$cpf,$email,$celular):bool {
        try {
            $dados = $this->findByCpf($cpf);
            $dados->nome = $nome;
            $dados->sobrenome = $sobrenome;
            $dados->email = $email;
            $dados->celular = $celular;
            $dados->save();
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    public function Deletar($cpf):bool{
        try {
        $dados = $this->findByCpf($cpf);
        $dados->delete();
        return true;
        }catch (\Exception $e){
            return false;
        }
    }
}