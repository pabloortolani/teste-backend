# Desafio Técnico

## Instalação

A api foi desenvolvida com laravel 9 e laravel Sail para rodar localmente com o docker

#### instação de depedências
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
#### Copiei o arquivo ".env.example" e crie um novo chamado ".env" na raiz do projeto e altere os valores das seguintes variáveis:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

#### Subindo aplicação
```
./vendor/bin/sail up -d
```

#### Criação das tabelas no banco de dados
```
./vendor/bin/sail artisan migrate
```

#### Alimentando a base de dados
```
./vendor/bin/sail artisan db:seed
```

#### Documentação dos Endpoints
- https://documenter.getpostman.com/view/9163946/UzBtnPq3
