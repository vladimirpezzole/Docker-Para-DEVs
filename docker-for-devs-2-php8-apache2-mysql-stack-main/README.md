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