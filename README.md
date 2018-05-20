Saloon
======

Saloon é um sistema de agendamento e reserva para salas/auditórios.

O sistema foi desenvolvido em PHP, utilizando o Yii Framework em sua segunda versão.
Está hospedado no heroku através de integração contínua com o GitHub.
O certificado TLS é fornecido pela https://www.cloudflare.com
Domínio fornecido pela http://www.freenom.com


ESTRUTURA DE DIRETÓRIOS
-----------------------

      assets/             definições dos assets
      commands/           console de comandos (controllers)
      components/         componentes extras que extendem o framework
      config/             configurações do sistema
      controllers/        classes dos Controllers
      dump/               inicializador do banco de dados
      mail/               views dos e-mails
      models/             classes dos Modelos
      runtime/            arquivos gerados em tempo de execução
      tests/              testes básicos
      vendor/             pacotes de terceiros
      views/              views do sistema
      web/                todos os assets utilizados
      widgets/            componentes visuais



REQUERIMENTO
------------

O projeto foi desenvolvido e testado utilizando o PHP versão PHP 7.2.5. Não foi testado em versões anteriores.
Para o banco de dados, é recomendado o MySQL versão 5.5 (ou MariaDB compatível).


INSTALAÇÃO
----------

### Instalação a partir do Arquivo

Extraia o arquivo que pode ser baixado clicando [aqui](https://github.com/AndersonBargas/saloon/archive/master.zip) para
o diretório raiz do seu WebServer.

Execute o comando composer install, para que baixe todas as bibliotecas necessárias.
Caso você não tenha o composer, poderá fazer o download no endereço https://getcomposer.org/

Configure o arquivo `config/web.php` e troque a chave de validação de cookie para um código randômico que só você saiba, exemplo:

```php
'request' => [
    'cookieValidationKey' => '<o código secreto e randômico vai aqui>',
],
```

Então você poderá acessar o sistema a partir do seguinte endereço URL:

~~~
http://localhost/
~~~


CONFIGURAÇÃO
------------

### Banco de dados

Edite o arquivo `config/db.php` para que fique de acordo com o seu banco de dados, por exemplo:

```php
return [
    'class'    => 'yii\db\Connection',
    'dsn'      => 'mysql:host=localhost;dbname=nomedabase',
    'username' => 'root',
    'password' => '1234',
    'charset'  => 'utf8',
];
```

### Rotas

O sistema possui um sistema de rotas. Para que ele funcione corretamente o Apache deve estar
com o mod_rewrite instalado e ativado. Caso seu WebServer seja o NGINX, então deverá utilizar
a seguinte configuração:

```conf
location / {
    # Redireciona tudo que não é um arquivo real para index.php
    try_files $uri $uri/ /index.php?$args;
}
    	
location ~ \.php$ {
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root/$fastcgi_script_name;
    fastcgi_pass 127.0.0.1:9056; # de acordo com o seu servidor php
    try_files $uri =404;
}
```

**OBSERVAÇÕES:**
- O sistema não irá criar o banco de dados para você, por isso utilize o arquivo `dump/init.sql` para criá-lo.