# Memory O'Clock

## Pré requis

- [docker](https://docs.docker.com/compose/install/)
- [docker-compose](https://docs.docker.com/compose/install/)

## Comment installer

Copier les fichiers distribués
```
cp .env.dist .env
cp docker-compose.override.yml.dist docker-compose.override.yml
```

Démarrer les containers docker et installer les dépendances
```
docker-compose up -d
docker-compose exec app composer install
```

Exécuter les migrations et fixtures
```
docker-compose exec db bash
mysql -u admin -padmin oclock < /srv/migrations.sql
mysql -u admin -padmin oclock < /srv/fixtures.sql
```

## Liens utiles

Application: [http://localhost](http://localhost)

PHP MyAdmin: [http://localhost:8080](http://localhost:8080)
