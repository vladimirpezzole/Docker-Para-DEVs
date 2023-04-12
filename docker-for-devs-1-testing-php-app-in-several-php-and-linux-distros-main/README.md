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