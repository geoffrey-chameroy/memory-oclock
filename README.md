# Memory O'Clock

## Pre requires

- docker-compose

## How to install

Copy docker-compose override file and update it if necessary
```
cp docker-compose.override.yml.dist docker-compose.override.yml
```

Start docker containers
```
docker-compose up -d
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
