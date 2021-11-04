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
Заполнение тестовыми данными таблицы происходит через запуск файла seed. 
Он имеет дефолтные значения, но можно заполнить и своими по желанию.

Команда: 
```
docker exec nevosoft_app_1 php seed.php
```