# Fragmentos de Loki - Loja de Artefatos Temporais

Bem-vindo ao Fragmentos de Loki, um e-commerce temático totalmente dedicado ao multiverso do Deus da Trapaça. Explore e adquira variantes, dispositivos da AVT e artefatos temporais únicos.

Este projeto é uma aplicação web desenvolvida em PHP puro, seguindo o paradigma de programação procedural, com um banco de dados MySQL para persistência de dados e estilização com Bootstrap e CSS customizado.

## 📜 Sobre o Projeto

A loja "Fragmentos de Loki" foi criada como um sistema de e-commerce funcional, onde os usuários podem se cadastrar, fazer login, navegar pelos produtos, adicioná-los ao carrinho e muito mais. A aplicação conta com uma área administrativa para gerenciamento completo de usuários e produtos.

---

## ✨ Funcionalidades

### Para Usuários (Variantes)
- **Cadastro e Login:** Sistema de autenticação seguro com senhas criptografadas.
- **Navegação:** Visualização dos produtos disponíveis na página inicial.
- **Filtro por Categoria:** Capacidade de filtrar produtos por categorias (Variantes do Loki, Dispositivos da AVT, Artefatos Temporais).
- **Carrinho de Compras:** Adicione ou remova itens do seu carrinho de compras.

### Para Administradores (Agentes da AVT)
- **Painel Administrativo:** Área restrita para gerenciamento do sistema.
- **Gerenciamento de Usuários:**
    - Criar novos usuários (comum ou administrador).
    - Visualizar todos os usuários cadastrados.
    - Editar informações dos usuários.
    - Excluir usuários.
- **Gerenciamento de Produtos:**
    - Adicionar novos produtos com nome, preço, categoria, raridade, universo e imagem.
    - Visualizar a lista completa de produtos.
    - Editar os detalhes dos produtos existentes.
    - Excluir produtos da loja.
- **Integração com API ViaCEP:** Durante o cadastro de usuários, o endereço é preenchido automaticamente ao inserir o CEP.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP
- **Frontend:** HTML5, CSS3, JavaScript
- **Framework CSS:** Bootstrap 5
- **Banco de Dados:** MySQL
- **Servidor Web:** Apache (utilizado via XAMPP)
- **API Externa:** [ViaCEP](https://viacep.com.br/) para consulta de endereços.

---

## 🚀 Como Executar o Projeto

Siga os passos abaixo para configurar e rodar o projeto em seu ambiente local.

### Pré-requisitos
- Um ambiente de servidor local como XAMPP, WAMP ou MAMP.
- Um gerenciador de banco de dados, como o phpMyAdmin.

### Passos
1.  **Clone o Repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/PHP-LojaFragmentosLoki.git](https://github.com/seu-usuario/PHP-LojaFragmentosLoki.git)
    ```
2.  **Mova para a Pasta do Servidor:**
    Mova a pasta do projeto para o diretório `htdocs` (no caso do XAMPP).

3.  **Crie o Banco de Dados:**
    - Abra o phpMyAdmin.
    - Crie um novo banco de dados chamado `loja_loki`.
    - Selecione o banco `loja_loki` e vá para a aba "Importar".
    - Importe o arquivo `sql/database.sql` para criar todas as tabelas e inserir os dados iniciais.

4.  **Configure a Conexão:**
    - Verifique se as credenciais do banco de dados no arquivo `src/config/conexao.php` correspondem às do seu ambiente. Por padrão, a configuração é:
      ```php
      $host = 'localhost';
      $usuario = 'root';
      $senha = '';
      $nome_banco = 'loja_loki';
      ```

5.  **Acesse a Aplicação:**
    - Inicie o seu servidor Apache e o MySQL.
    - Abra o navegador e acesse: `http://localhost/PHP-LojaFragmentosLoki/public/`

### Credenciais de Acesso (Admin)
- **Email:** `joao@gmail.com`
- **Senha:** `123`

---
