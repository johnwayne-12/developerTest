# CBC API - Teste Técnico

API REST em PHP para gerenciamento de recursos financeiros de clubes.

## Requisitos

- PHP 7.3 ou superior
- MySQL 5.7 ou superior

## Instalação

1. Clone o repositório:

   git clone https://github.com/seu-usuario/cbc-api.git
   cd cbc-api

2. Crie o banco de dados:

   mysql -u root -p < sql/init.sql

3. Configure o servidor para apontar para a pasta `public` como raiz.

4. Ajuste os dados de conexão no arquivo `config/database.php` se necessário.

## Endpoints

### Listar Clubes
- `GET /clubes`
- **Response**: Lista de clubes

### Cadastrar Clube
- `POST /clubes`
- **Body**:
  ```json
  {
    "clube": "Clube A",
    "saldo_disponivel": "2000.00"
  }

### Consumir Recurso
- `POST /consumir`
- **Body**:
  ```json
  {
    "clube_id": 1,
    "recurso_id": 1,
    "valor_consumo": "500.00"
  }

## Observações:

- Os dados dos recursos já são inseridos automaticamente no banco.
- Os clubes são cadastrados via API.
- O sistema impede consumo de recursos se o saldo do clube for insuficiente.



Desenvolvido para o Comitê Brasileiro de Clubes (CBC)