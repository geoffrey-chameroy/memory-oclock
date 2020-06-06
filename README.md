# Memory O'Clock

## Pre requires

- docker-compose

## How to install

Copy Distributed files, you can update it as you wish
```
cp .env.dist .env
cp docker-compose.override.yml.dist docker-compose.override.yml
```

Start docker containers and install dependencies
```
docker-compose up -d
docker-compose exec app composer install
```

Execute migrations and fixtures
```
docker-compose exec db bash
mysql -u admin -padmin oclock < /srv/migrations.sql
mysql -u admin -padmin oclock < /srv/fixtures.sql
```

## Usefull links

Application: http://localhost

PHP MyAdmin: http://localhost:8080
