### Deploy:
```
docker-compose build
```
```
docker-compose up -d
```
Для прогона миграции на создание таблицы нужно вызвать команду:
```
docker exec nevosoft_app_1 php migration.php
```