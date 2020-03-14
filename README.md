## Primeiro instalar o xampp, logo em seguida rodar o script do banco dados (usei o Heidi).
### Para adicionar um usuário utilizar o seguinte endereço: http://127.0.0.1/api/users/add. Method:Post. Exemplo: 
#### {   
    "nome": "lucas",
    "sobrenome": "da conceicao",
    "cpf": "11111111111",
    "email": "lucas@gmail.com",
    "celular": "99999999",
    "cep": "29375000"
####  }
  ### Para listar todos utilizar o seguinte endereço: http://127.0.0.1/api/users/listall.  Method:Get. Exemplo 
  ### Para listar por Cpf utilizar o seguinte endereço: http://127.0.0.1/api/users/list. Method: Get. Exemplo
  #### {
      "cpf": "11111111111",
  #### }
  ### Para deletar utilizar o seguinte endereço: http://127.0.0.1/api/users/delete.  Method: Delete. Exemplo
   #### {
      "cpf": "11111111111",
   #### }
  ### Para atualizar utilizar o seguinte endereço: http://127.0.0.1/api/users/update. Method: Put. Exemplo 
  #### {   
      "nome": "lucas",
      "sobrenome": "da conceicao",
      "cpf": "11111111111",
      "email": "lucas@gmail.com",
      "celular": "99999999",
  #### }
