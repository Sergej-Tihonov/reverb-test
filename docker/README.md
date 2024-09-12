# Docker
Custom Docker for Laravel development

## Setup

- Copy **.env.example** to **.env**
```
cp .env.example .env
```

- Change \<docker\> to your project name in the **.env**
```
COMPOSE_PROJECT_NAME=docker
```

- If you like to change the project folder name, do it in:
    - ./docker-compose.yml (2 places)
    - ./nginx/default.conf (1 place)
- Keep the project name to be laravel inside the docker


- _optional:_ Change the database name in the **.env** file. Replace **docker**
```
MYSQL_DATABASE=docker
```

## Commands

Start and run the containers in the background
```
docker compose up -d
```
---
List the containers
```
docker compose ps
```
---
Stop the containers
```
docker compose stop
```
---
Delete everything, including images and orphan containers
```
docker compose down -v --rmi all --remove-orphans
```
---
Delete all unused images
```
docker image prune -a
```
---
Delete all unused containers
```
docker volume prune
```
