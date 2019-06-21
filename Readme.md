# Set up

Clone the repository, enter the main folder and run:

```
cp docker-compose-dev.dist.yaml docker-compose.yaml &&\
cp .env.dist .env
```

The default configuration should work but if You have some port conflicts
update the docker-compose.yaml according to needs.

Than run:
```
docker-compose up -d
```

When containers are up and running, execute:
```
docker exec -it speed_php composer install
```

# Usage

To create a benchmark make a `POST` request to `http://localhost:7000/api/benchmark`.

# Contribution

