# Desafio Técnico: API de Gestão de Pessoas 

Este projeto é uma API RESTful desenvolvida em **Laravel 11** para o gerenciamento de registros de pessoas. O foco principal foi a implementação de regras de negócio sólidas e a garantia de qualidade através de testes automatizados.

---

## Tecnologias e Ferramentas

* **Framework:** [Laravel 11](https://laravel.com)
* **Linguagem:** PHP 8.2+
* **Banco de Dados:** SQLite (Pronto para uso sem configurações extras)
* **Testes:** PHPUnit
* **Padrões:** Form Requests, Route Model Binding e API Resources.

---

## Como Rodar o Projeto Localmente

Siga estes passos simples para configurar o ambiente:

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/desafio-upcities.git](https://github.com/seu-usuario/desafio-upcities.git)
    cd desafio-upcities
    ```

2.  **Instale as dependências do Composer:**
    ```bash
    composer install
    ```

3.  **Configure o arquivo de ambiente:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Prepare o Banco de Dados (SQLite):**
    O projeto está configurado para usar SQLite por padrão. Certifique-se de que o arquivo existe e rode as migrações:
    ```bash
    touch database/database.sqlite
    php artisan migrate
    ```

5.  **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```
    A API estará disponível em: `http://localhost:8000`

---

## Testes Automatizados

A aplicação possui uma suíte de testes que cobre os principais fluxos. Para rodar todos os testes e verificar a integridade, use:

```bash
php artisan test

```

## O que foi testado?
CRUD : Criação, listagem, edição e exclusão de pessoas.

Regra de Idade: Bloqueio de cadastro para menores de 18 anos.

Integridade de Dados: Garantia de que e-mails sejam únicos (mesmo durante o update).

Tratamento de Erros: Respostas JSON padronizadas para registros não encontrados (404).

## Algumas decisões de desenvolvimento:
* **Como desenvolvedora, priorizei a organização e a manutenibilidade do código:
* **Form Requests: Toda a validação foi isolada em classes Request (ex: UpdatePersonRequest), mantendo os Controllers enxutos.
* **Global Exceptions: Configurei o bootstrap/app.php para que a API sempre responda em formato JSON, facilitando a integração com Front-ends.


