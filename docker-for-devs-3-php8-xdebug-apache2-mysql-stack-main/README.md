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