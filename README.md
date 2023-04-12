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

<hr>
<!-- 3. Docker-Para-DEVs: -->

## 3. Docker-Para-DEVs: [docker-for-devs-3-php8-xdebug-apache2-mysql-stack-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-3-php8-xdebug-apache2-mysql-stack-main)

<hr>

**References**

...

* [Repositório original](https://github.com/luismr/docker-for-devs-3-php8-xdebug-apache2-mysql-stack) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1s3oO_rSqlMGhkdH3pBDF_bnNH_spV_UuhJ23I1AGj5s/edit?usp=sharing)
* [Video (in portuguese)](https://youtu.be/769V68eJnGs) 

<hr>

<hr>
<!-- 4. Docker-Para-DEVs: -->

## 4. Docker-Para-DEVs: [docker-for-devs-4-php8-fpm-nginx-mysql-stack-main](https://github.com/vladimirpezzole/Docker-Para-DEVs/tree/main/docker-for-devs-4-php8-fpm-nginx-mysql-stack-main)

<hr>

**References**

...

* [Repositório original](https://github.com/luismr/docker-for-devs-4-php8-fpm-nginx-mysql-stack) 
* [Slides (in portuguese)](https://docs.google.com/presentation/d/1jLx_LNRzHI8NUX-8FaDOjcpzPmRfIg4bfuXGGNLGyeg/edit?usp=sharing)
* [Video (in portuguese)](https://youtu.be/Bpzyut_fXeA) 

<hr>

<hr>
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