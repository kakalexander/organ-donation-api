<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1>Documentação do Backend - API de Doação de Órgãos</h1>
  
  <h2>Contextualização</h2>
  <p>
    O projeto de <strong>Doação de Órgãos</strong> tem como objetivo sensibilizar e conscientizar a sociedade
    sobre a importância da doação de órgãos, além de criar uma plataforma tecnológica que facilite o processo.
    Implementado com <strong>Laravel</strong> e <strong>Docker</strong>, o backend fornece APIs seguras para gerenciar doadores, 
    receptores e órgãos cadastrados, além de oferecer funcionalidades específicas para administradores.
  </p>
  
  <h2>Tecnologias Utilizadas</h2>
  <ul>
    <li>PHP 8.x com Laravel</li>
    <li>MySQL como banco de dados</li>
    <li>Redis para cache e filas</li>
    <li>Docker e Docker Compose para containerização</li>
    <li>TailwindCSS para estilos simples</li>
  </ul>
  
  <h2>Estrutura do Projeto</h2>
  <pre>
app/
  ├── Http/
  │   ├── Controllers/
  │   ├── Middleware/
  │   └── Requests/
  ├── Interfaces/
  ├── Models/
  ├── Providers/
  ├── Repositories/
  ├── Services/
bootstrap/
config/
database/
  ├── factories/
  ├── migrations/
  └── seeders/
routes/
  ├── api.php
  └── web.php
tests/
docker/
  ├── Dockerfile
  └── docker-compose.yml
.env.example
  </pre>

  <h3>Pastas Principais</h3>
  <ul>
    <li><strong>Http</strong>: Contém controladores e middlewares para gerenciar as rotas.</li>
    <li><strong>Models</strong>: Modelos do Eloquent para interagir com o banco de dados.</li>
    <li><strong>Repositories</strong>: Implementa a camada de acesso a dados, seguindo o princípio de separação de responsabilidades.</li>
    <li><strong>Services</strong>: Lógica de negócios complexa.</li>
    <li><strong>Routes</strong>:
      <ul>
        <li><strong>api.php</strong>: Define as rotas da API.</li>
        <li><strong>web.php</strong>: Rotas web (não utilizadas diretamente no projeto).</li>
      </ul>
    </li>
  </ul>
  
  <h2>Configuração e Execução Local</h2>
  <h3>Pré-requisitos</h3>
  <ul>
    <li>Docker e Docker Compose</li>
    <li>Composer instalado na máquina local</li>
  </ul>
  
  <h3>Passos</h3>
  <ol>
    <li><strong>Clone o repositório</strong>:
      <pre><code>git clone &lt;url-do-repositorio&gt;
cd organ-donation-api
      </code></pre>
    </li>
    <li><strong>Configure o arquivo .env</strong>:
      <pre><code>
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QqdHGGcmaPPPbA3QIP8qCb8IhtAPhIUF0DtF8q2yre8=
APP_DEBUG=true
APP_TIMEZONE=America/Sao_Paulo
APP_URL=http://localhost:8000

APP_LOCALE=pt_BR
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file

APP_MAINTENANCE_STORE=database


PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=user
DB_PASSWORD=password

SESSION_DRIVER=redis
SESSION_LIFETIME=12000000
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

CACHE_STORE=database
CACHE_PREFIX=
CACHE_DRIVER=redis

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"


</code></pre>
    </li>
    <li><strong>Instale as dependências</strong>:
      <pre><code>composer install</code></pre>
    </li>
    <li><strong>Suba os containers</strong>:
      <pre><code>docker-compose up -d</code></pre>
    </li>
    <li><strong>Acesse o projeto</strong>:
      <p>API: <a href="http://localhost:8000/api" target="_blank">http://localhost:8000/api</a></p>
      <p>FRONTEND: <a href="http://localhost:3000" target="_blank">http://localhost:3000</a></p>
    </li>
  </ol>
  <h2>Caso queira você pode usar os usuarios padrões do sistema</h2>
    <ul>
        <li><strong>email: admin@example.com  senha: admin123</li>
        <li><strong>email: doador@example.com  senha: admin123</li>
        <li><strong>email: receptor@example.com  senha: admin123</li>
    </ul>
  <h2>Rotas Principais</h2>
  <h3>Autenticação</h3>
  <ul>
    <li><strong>POST /register</strong>: Registro de novos usuários.</li>
    <li><strong>POST /login</strong>: Login com autenticação via token.</li>
  </ul>

  <h3>Rotas de Doador</h3>
  <ul>
    <li><strong>GET /doador/orgaos</strong>: Lista órgãos cadastrados pelo doador.</li>
    <li><strong>POST /doador/orgaos</strong>: Cadastro de novos órgãos.</li>
  </ul>

  <h3>Rotas de Administrador</h3>
  <ul>
    <li><strong>GET /admin/orgaos</strong>: Lista todos os órgãos doados.</li>
    <li><strong>POST /admin/orgaos</strong>: Cadastra um órgão (modo administrador).</li>
  </ul>
</body>
</html>
