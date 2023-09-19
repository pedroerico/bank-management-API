# API

Foi desenvolvida uma API de gestão bancária utilizando o Laravel 10 e PHP 8.2, seguindo as melhores práticas e utilizando alguns design patterns.

## Máquina virtual (Docker)
## Pré-requisitos
Para execução, é necessário [Docker](https://docs.docker.com/) e [docker-compose](https://docs.docker.com/compose/install/), para subir aplicação.

## Configuração
O projecto está configurado por padrão para rodar com docker

## Execução
execute o comando na pasta local

Para criar o docker-compose.yml
```bash
cp docker-compose.yml.sample docker-compose.yml
```

Para rodar o docker
```bash
docker-compose up -d
```

## Commando Laravel Test

Comando para executar os tests, ou pode entrar no container e executar por dentro:
```bash
docker-compose exec php php artisan test
```

## Documentação

*Não houve necessidade da criação da documentação*

## Desenvolvido

Desenvolvido em 08 de Setembro de 2023.

Desenvolvedor: Pedro Érico.
Email: pedroerico.desenvolvedor@gmail.com
