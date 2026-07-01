# 🛒 E-commerce Web 2 (Serverless)

Este projeto é um sistema web completo de E-commerce seguindo a arquitetura MVC (Model-View-Controller). Foi desenvolvido no backend com Laravel, banco de dados PostgreSQL (Supabase) e utiliza o paradigma Serverless para deploy no AWS Lambda via Bref.

## Tecnologias Utilizadas

### Frontend

Vite: Empacotador para assets moderno e rápido, garantindo builds otimizadas.

Tailwind CSS & @tailwindcss/forms: Estilização utilitária e responsiva para um design limpo e adaptável.

Alpine.js: Reatividade leve no frontend sem a necessidade de frameworks pesados.

Blade Components: Reutilização inteligente de elementos visuais do Laravel.

### Backend

PHP 8.3 & Laravel 13

Arquitetura MVC: Estruturação limpa dividindo Models (Categoria, Produto, Pedido, User), Views e Controllers.

Autenticação (Laravel Breeze): Gestão robusta de login, registo, logout e proteção de rotas privadas.

### Banco de Dados e Cache

PostgreSQL (via Supabase): Banco de dados relacional na nuvem seguro e escalável.

Sessões e Cache em Banco: Configuração centralizada usando SESSION_DRIVER=database e CACHE_STORE=database.

Migrations & Seeders: Versionamento estrutural das tabelas (usuários, produtos, categorias, pedidos e tabelas de relacionamento).

## DevOps e Nuvem (Serverless)

AWS Lambda & Serverless Framework: Hospedagem sem servidores fixos, escalando do zero ao infinito automaticamente.

Bref (bref/bref e bref/laravel-bridge): A ponte mágica que permite o PHP rodar nativamente dentro da AWS Lambda.

## Automação de Deploy (CI/CD)

Não realizamos deploys manuais. O nosso sistema está integrado com o GitHub Actions para garantir entregas contínuas e seguras.

O Workflow: Sempre que um novo código é aprovado na branch main, o nosso robô provisiona um ambiente temporário, instala dependências (Composer/NPM), gera a build de produção dos ficheiros CSS/JS e realiza o deploy da infraestrutura diretamente para a AWS de forma transparente.

## Funcionalidades do sistema

- **Autenticação de usuários**
  - login, registro, logout
  - edição de perfil (`/profile`)
  - proteção de rotas com middleware `auth` e `verified`

- **Gestão de categorias**
  - listagem de categorias
  - visualização de categoria
  - criação, edição e exclusão de categorias

- **Gestão de produtos**
  - listagem de produtos
  - visualização de produto
  - criação, edição e exclusão de produtos

- **Gestão de pedidos**
  - CRUD completo de pedidos
  - provavelmente relacionamento de pedidos com produtos (`pedido_produto`)

- **Arquitetura MVC**
  - Models para entidades: `Categoria`, `Produto`, `Pedido`, `User`
  - Controllers para lógica de categoria, produto, pedido e perfil
  - views para templates Blade

- **Cache de navegador**
  - rotas públicas usam middleware `CacheBrowser::class` para cache no browser

- **Sessão e cache em banco**
  - configuração `SESSION_DRIVER=database`
  - `CACHE_STORE=database`

- **Serverless / AWS**
  - suporte para deploy em AWS Lambda via Serverless Framework
  - uso de serverless.yml para configuração do ambiente em nuvem

- **Banco e migrações**
  - migrations para usuários, categorias, produtos, pedidos e tabela ponte pedido_produto
  - seeders possíveis para popular dados

- **Front-end responsivo**
  - estilos com Tailwind e Blade components
  - integração com Vite para bundling e asset pipeline

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- Git
- PHP (versão 8.2 ou superior) com a extensão pdo_pgsql ativa.
- Composer (Gerenciador de pacotes do PHP).
- Node.js e NPM (Necessário para empacotar o deploy na AWS).

## 🛠️ Configuração do Projeto e Banco de Dados (Local)

1. Clonar o repositório e entrar na pasta

```bash
git clone https://github.com/SEU-USUARIO/NOME-DO-REPOSITORIO.git
cd NOME-DO-REPOSITORIO
```

2. Instalar as dependências do PHP

```bash
composer install
```

3. Configurar as Variáveis de Ambiente (O Cofre)

   Crie uma cópia do arquivo de configuração padrão:

```bash
cp .env.example .env
```

   Abra o arquivo .env gerado e preencha as configurações do banco de dados na nuvem (solicite as credenciais do Supabase ao administrador do projeto):

```env
DB_CONNECTION=pgsql
DB_HOST=aws-1-sa-east-1.pooler.supabase.com
DB_PORT=6543
DB_DATABASE=postgres
DB_USERNAME=postgres.sqdvzczxyuttxjwmlbbi
DB_PASSWORD=senha_secreta_aqui
```

4. Gerar a Chave da Aplicação

```bash
php artisan key:generate
```

5. Iniciar o Servidor Local

```bash
php artisan serve
```

O terminal exibirá um link (ex: http://127.0.0.1:8000). O projeto já estará rodando na sua máquina e conectado ao banco de dados oficial na nuvem!

## ☁️ Como fazer o Deploy para a AWS (Serverless)

Como o projeto utiliza o AWS Academy Learner Lab, as chaves de acesso são temporárias e expiram a cada sessão (aprox. 4 horas). Para enviar atualizações de código para a nuvem, siga os passos abaixo.

### 1. Instalar o Serverless Framework

No terminal da raiz do projeto, instale a ferramenta globalmente:

```bash
npm install -g serverless
```

### 2. Configurar as Credenciais da AWS

Inicie o seu Learner Lab, clique em AWS Details e depois em AWS CLI. Copie o bloco de credenciais temporárias fornecido pela plataforma.

#### Se você usa Windows:

- Abra o Explorador de Arquivos e vá até a pasta do seu usuário (ex: C:\Users\SeuNome).
- Crie uma pasta chamada .aws (com o ponto no início).
- Dentro dela, crie um arquivo chamado credentials.
- Abra este arquivo no Bloco de Notas, cole o bloco de credenciais do Learner Lab e salve.

#### Se você usa Linux ou Mac:

- Abra o terminal e crie/edite o arquivo de credenciais rodando:

```bash
nano ~/.aws/credentials
```

- Cole o bloco de credenciais do Learner Lab.
- Salve o arquivo apertando Ctrl + O (Enter) e feche com Ctrl + X.

### ⚠️ ATENÇÃO: O Problema do .txt Oculto

Muitos editores de texto (especialmente o Bloco de Notas no Windows) salvam o arquivo silenciosamente como credentials.txt. A AWS e o Serverless exigem que o arquivo se chame EXATAMENTE credentials (sem nenhuma extensão), caso contrário o acesso será negado.

Para verificar e corrigir isso via terminal:

#### No Windows (PowerShell):

Verifique o nome do arquivo rodando:

```powershell
ls C:\Users\SeuNome\.aws
```

(Substitua SeuNome pela sua pasta de usuário).

Se o arquivo estiver listado como credentials.txt, corrija rodando o comando:

```powershell
Rename-Item -Path C:\Users\SeuNome\.aws\credentials.txt -NewName credentials
```

#### No Linux / Mac:

Verifique o nome do arquivo rodando:

```bash
ls ~/.aws
```

Se o arquivo estiver listado como credentials.txt, corrija rodando:

```bash
mv ~/.aws/credentials.txt ~/.aws/credentials
```

### 3. Executar o Deploy

Com as credenciais salvas e com o nome correto, volte ao terminal na pasta do projeto e rode o comando abaixo para empacotar e enviar o sistema para o AWS Lambda:

```bash
serverless deploy
```

### 4. Rodar as Migrations na Nuvem

Após o deploy, se você precisar criar ou alterar tabelas no banco de dados através da AWS, utilize o comando abaixo para rodar as migrations diretamente na nuvem (funciona igual no Windows e Linux):

```bash
serverless bref:cli --args="migrate --force"
```