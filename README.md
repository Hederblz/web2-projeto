# 🛒 E-commerce Web 2 (Serverless)

Este projeto é um sistema web completo de E-commerce seguindo a arquitetura MVC (Model-View-Controller). Foi desenvolvido no backend com Laravel, banco de dados PostgreSQL (Supabase) e utiliza o paradigma Serverless para deploy no AWS Lambda via Bref.

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
DB_PASSWORD=6UacANOEEIUdMWg4
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
