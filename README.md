# Docker-Para-DEVs

<i>Exercícios utilizando **Docker** orientado por [Luis Machado Reis](https://github.com/luismr) </i>

* [Slides Geral](https://drive.google.com/drive/folders/1evXBiO-1R9DscZ57s8bMmYj8wlYwhhSl?usp=share_link)

<hr>
<!-- 1. Docker-Para-DEVs: -->

## 1. Docker-Para-DEVs: [docker-for-devs-1-testing-php-app-in-several-php-and-linux-distros-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-1-testing-php-app-in-several-php-and-linux-distros-main)

<hr>

**References**

Testar uma aplicação PHP no Debian e CentOS rodando no Apache

Imagine que você tenha que testar o comportamento de uma aplicação PHP dentro de diferentes sistemas operacionais rodando com o Apache

Você vai instalar AUTOMATICAMENTE cada distribuição de Linux em um container Docker, geralmente rodando na sua máquina física,  já contendo o Apache, PHP e o mod-php para fazer funcionar necessário para a tarefa.

* [Repositório original](https://github.com/luismr/docker-for-devs-1-testing-php-app-in-several-php-and-linux-distros) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1_R1zaeQlOTERrJLcgRJpcych_2kVjmCkEJKNrsIRlFQ/edit?usp=sharing)
* [Video (in portuguese)](https://www.youtube.com/watch?v=yWvGI-9_DJo)

<hr>

Portas utilizadas neste exercício

**9016 => web - apache**

**9018 => web - centos**

// Substitui a imagem **naqoda/centos-apache-php** que não constava mais no **docker.hub** por **identicum/centos-apache-php** //

Para rodar execute:

`docker compose up -d` ou `docker-compose up -d ` 

<i>(dependendo da sua versão do **Docker  Compose**)</i>


**docker-compose.yml:**

```
version: '3.9'

services:
  php-apache-debian:
    image: php:8.1-apache
    ports:
      - "9016:80"
    volumes:
      - ./src:/var/www/html

  php-apache-centos:
    image: identicum/centos-apache-php
    ports:
      - "9018:80"
    volumes:
      - ./src:/var/www/app/public_html


```

<hr>

<hr>
<!-- 2. Docker-Para-DEVs: -->

## 2. Docker-Para-DEVs: [docker-for-devs-2-php8-apache2-mysql-stack-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-2-php8-apache2-mysql-stack-main)

<hr>

**References**

Pilha de Desenvolvimento PHP8 + MySQL + phpMyAdmin

Como padronizar o ambiente de desenvolvimento e execução da sua aplicação PHP para o time de maneira fácil e rápida, só utilizando uma pilha Docker-compose.

A aplicação PHP 8 usa Banco de Dados MariaDB 10 e a interface de Administração e Trabalho para o MySQL chamada phpMyAdmin.

* [Repositório original](https://github.com/luismr/docker-for-devs-2-php8-apache2-mysql-stack) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1K0c4Op8kKbNOc3ymd0ob4YIKa5BAsGAs5ZTe4R5p_4I/edit?usp=sharing)
* [Video (in portuguese)](https://youtu.be/kEayvleOv6E)

<hr>

Portas utilizadas neste exercício

**9014 => web - mysql**

**9015 => web - phpMyAdmin**

**9016 => web - apache**

// 

Para rodar execute:

`docker compose up -d` ou `docker-compose up -d ` 

<i>(dependendo da sua versão do **Docker  Compose**)</i>

**docker-compose.yml:**

```
version: '3.9'

services:
  db:
    image: mariadb:10.5.9
    restart: always
    ports:
      - '9014:3306'
    environment:
      MYSQL_ROOT_PASSWORD: 's3cr3t'
      MYSQL_USER: 'username'
      MYSQL_PASSWORD: 'password'
      MYSQL_DATABASE: 'mydb'
    volumes:
      - db_data:/var/lib/mysql
    healthcheck:
      test: mysqladmin ping -h 127.0.0.1 -u root --password=s3cr3t
      interval: 5s
      retries: 5

  db_admin:
    image: phpmyadmin/phpmyadmin:5
    ports:
      - '9015:80'
    environment:
      - PMA_HOST=db
      - PMA_ABSOLUTE_URI=http://localhost:9015/
    depends_on:
      db:
        condition: service_healthy
    volumes:
      - db_admin_data:/var/www/html

  app:
    build:
      context: .
      dockerfile: docker/php8-mysql/Dockerfile
    ports:
      - '9016:80'
    working_dir: /var/www/html
    volumes:
      - ./src:/var/www/html
    depends_on:
      db:
        condition: service_healthy

volumes:
  db_data:
  db_admin_data:

```

O **Docker Compose** em **app:** constrói (build) uma imagem através **PHP-8.0 com Apache** do Dockerfile em **docker/php8-mysql/Dockerfile:**

```
FROM php:8.0-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y

```

instala, habilita a extensão **mysqli** e atualiza as dependências debian da imagem .

<hr>
<!-- 3. Docker-Para-DEVs: -->

## 3. Docker-Para-DEVs: [docker-for-devs-3-php8-xdebug-apache2-mysql-stack-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-3-php8-xdebug-apache2-mysql-stack-main)

<hr>

**References**

Debug na Pilha de Desenvolvimento PHP8 + MySQL + phpMyAdmin

Através do Docker iremos habilitar o xDebug para a aplicação PHP 8 usa Banco de Dados MariaDB 10 e a interface de Administração e Trabalho para o MySQL chamada phpMyAdmin.

* [Repositório original](https://github.com/luismr/docker-for-devs-3-php8-xdebug-apache2-mysql-stack) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1s3oO_rSqlMGhkdH3pBDF_bnNH_spV_UuhJ23I1AGj5s/edit?usp=sharing)
* [Video (in portuguese)](https://youtu.be/769V68eJnGs) 

<hr>

Portas utilizadas neste exercício

**9014 => web - mysql**

**9015 => web - phpMyAdmin**

**9016 => web - apache**

// 

Para rodar execute:

`docker compose up -d` ou `docker-compose up -d ` 

<i>(dependendo da sua versão do **Docker  Compose**)</i>

**docker-compose.yml:**

```

version: '3.9'

services:
  db:
    image: mariadb:10.5.9
    restart: always
    ports:
      - '9014:3306'
    environment:
      MYSQL_ROOT_PASSWORD: 's3cr3t'
      MYSQL_USER: 'username'
      MYSQL_PASSWORD: 'password'
      MYSQL_DATABASE: 'mydb'
    volumes:
      - db_data:/var/lib/mysql
    healthcheck:
      test: mysqladmin ping -h 127.0.0.1 -u root --password=s3cr3t
      interval: 5s
      retries: 5

  db_admin:
    image: phpmyadmin/phpmyadmin:5
    ports:
      - '9015:80'
    environment:
      - PMA_HOST=db
      - PMA_ABSOLUTE_URI=http://localhost:9015/
    depends_on:
      db:
        condition: service_healthy
    volumes:
      - db_admin_data:/var/www/html

  app:
    build:
      context: .
      dockerfile: docker/php8-mysql-xdebug/Dockerfile
    ports:
      - '9016:80'
    working_dir: /var/www/html
    volumes:
      - ./docker/php8-mysql-xdebug/conf/php/xdebug.ini:/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
      - ./src:/var/www/html
    depends_on:
      db:
        condition: service_healthy

volumes:
  db_data:
  db_admin_data:

```

O **Docker Compose** em **app:** constrói (build) uma imagem através **PHP-8.0 com Apache com Xdebug** do Dockerfile em **docker/php8-mysql-xdebug/Dockerfile:**

```
FROM php:8.0-apache

RUN \
   docker-php-ext-install mysqli && \
   docker-php-ext-enable mysqli

RUN \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

RUN \
   apt-get update && \
   apt-get upgrade -y

```

instala, habilita as extensões **mysqli**, **xdebug** e atualiza as dependências debian da imagem .

<hr>
<!-- 4. Docker-Para-DEVs: -->

## 4. Docker-Para-DEVs: [docker-for-devs-4-php8-fpm-nginx-mysql-stack-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-4-php8-fpm-nginx-mysql-stack-main)

<hr>

**References**

Com base na aplicação PHP feito no Vídeo "Caso #2" vamos executá-la no NGINX usando o PHP em modo FPM que é uma configuração é amplamente utilizada atualmente por desacoplar o PHP do ambiente do servidor HTTP.

Isso é bom para manter a separação de responsabilidades, isolar problemas e fazer trace de erros com mais facilidade.


* [Repositório original](https://github.com/luismr/docker-for-devs-4-php8-fpm-nginx-mysql-stack) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1jLx_LNRzHI8NUX-8FaDOjcpzPmRfIg4bfuXGGNLGyeg/edit?usp=sharing)
* [Video (in portuguese)](https://youtu.be/Bpzyut_fXeA) 

<hr>

Portas utilizadas neste exercício

**9014 => web - mysql**

**9015 => web - phpMyAdmin**

**9016 => web - apache**

// 

Para rodar execute:

`docker compose up -d` ou `docker-compose up -d ` 

<i>(dependendo da sua versão do **Docker  Compose**)</i>

**docker-compose.yml:**

```

version: '3.9'

services:
  db:
    image: mariadb:10.5.9
    restart: always
    ports:
      - '9014:3306'
    environment:
      MYSQL_ROOT_PASSWORD: 's3cr3t'
      MYSQL_USER: 'username'
      MYSQL_PASSWORD: 'password'
      MYSQL_DATABASE: 'mydb'
    volumes:
      - db_data:/var/lib/mysql
      - ./sql/countries-create.sql:/docker-entrypoint-initdb.d/countries-create.sql:ro
      - ./sql/countries-insert.sql:/docker-entrypoint-initdb.d/countries-insert.sql:ro
    healthcheck:
      test: mysqladmin ping -h 127.0.0.1 -u root --password=s3cr3t
      interval: 5s
      retries: 5

  db_admin:
    image: phpmyadmin/phpmyadmin:5
    ports:
      - '9015:80'
    environment:
      - PMA_HOST=db
      - PMA_ABSOLUTE_URI=http://localhost:8001/
    depends_on:
      db:
        condition: service_healthy
    volumes:
      - db_admin_data:/var/www/html

  app:
    build:
      context: .
      dockerfile: docker/php8-fpm-mysql/Dockerfile
    volumes:
      - ./conf/php-fpm.d/www.conf:/usr/local/etc/php-fpm.d/www.conf:ro
      - ./src:/var/www/html
    healthcheck:
      test: php-fpm -t
      interval: 60s
      retries: 5
    depends_on:
      db:
        condition: service_healthy

  web:
    image: nginx:latest
    ports:
      - "9016:80"
    volumes:
      - ./conf/nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
      - ./src:/var/www/html
    working_dir: /var/www/html
    healthcheck:
      test: curl --fail localhost/ping
      interval: 30s
      retries: 6
    depends_on:
      app:
        condition: service_healthy
      db:
        condition: service_healthy

volumes:
  db_data:
  db_admin_data:

```

O **Docker Compose** em **app:** constrói (build) uma imagem através **PHP-8.0 com Apache** do Dockerfile em **docker/php8-fpm-mysql/Dockerfile:**

```
FROM php:8.0-fpm-alpine

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apk update && apk upgrade

```

instala, habilita a extensão **mysqli** e atualiza as dependências debian da imagem .

<hr>

<hr>*************
<!-- x. Docker-Para-DEVs: -->

## x. Docker-Para-DEVs: [...]()

<hr>

**References**

...

* [Repositório original]() 
* [Slides (in portuguese)]()
* [Video (in portuguese)]()

<hr>
#### 
#### 