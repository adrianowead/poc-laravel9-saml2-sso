# POC SAML2 com Laravel 9.x

Este repositório é apenas um exemplo funcional, utilizando o Laravel como **Service Provider (SP)**, e o **SimpleSAMLphp** como **Identity Provider**.

## Setup

O projeto já contém o mapeamento no docker, bem como o banco de dados funcional, tanto para fonte de autenticação do IdP, quanto para as demandas locais de cada SP.

### Etapa 1

Clonar esse repositório.

### Etapa 2

Executar o docker build, bem como o docker-compose up. Lembre-se de ter as seguintes portas livres para uso do projeto:

- 80
- 3679
- 3307
- 3308

### Etapa 3

Ao inicializar, entre na máquina via ssh e instale as respectivas dependências:

_Para o Identity Provider_

```shell
$ cd /var/www/html/IdP
$ composer install --no-dev
```

_Para o Serviço 1_

```shell
$ cd /var/www/html/sp-a
$ composer install --no-dev
```

_Para o Serviço 2_

```shell
$ cd /var/www/html/sp-b
$ composer install --no-dev
```

### Etapa 4

Na sua máquina host, adicione os endereços DNS das instâncias.

O objetivo é testar a autenticação com _root domains_ diferentes.

Para isso altere seu arquivo **hosts** (verifice o seu sistema operacional), _e.g. /etc/hosts (Linux)_

```shell
...
# POC SAML
127.0.0.1	poc.saml.idp
127.0.0.1	poc.saml.sp-a
127.0.0.1	poc.saml.sp-b
...
```

### Etapa 5

Acesse seu navegador, abra duas abas, uma para cada SP (http://poc.saml.sp-a e http://poc.saml.sp-b).

Ao navegar será solicitada autenticação, entre com o usuário padrão:

**user:** adriano_mail@hotmail.com

**pass:** 123enter

Observe que ao se logar em qualquer serviço sua sessão é criada, e quando o segundo serviço precisar de autenticação, será aproveitado o login já feito no outro.

## Material de apoio

### SimpleSAMLphp

- https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-simplesamlphp-for-saml-authentication-on-ubuntu-18-04-pt
- https://medium.com/@_gabiCavalcante/simplesamlphp-como-idp-ae19a38a2d81