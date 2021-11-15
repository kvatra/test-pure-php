## Задание
**Задача**: Разработать страницу для просмотра логов

Требования:

Каждая запись в таблице с логами представляет из себя следующий набор обязательных полей:
ts - время создания записи
type - числовой тип записи, с возможными значениями от 1 до 10
message - текстовое описание события

Логи должны отображаться в виде таблицы с постраничной навигацией по 100 элементов на странице, 
возможностью сортировки по времени и фильтром по типу записи. 
Удаления логов из базы не предполагается, логи только пишутся и читаются.

Время отображения любой страницы не должно превышать 500мс. 
Backend должен быть написан на чистом PHP, без фреймворков. 
В качестве базы данных можно использовать одну из следующих РСУБД: MySQL | MariaDB | PostgreSQL.

По фронтенду никаких требований нет, достаточно простого html-table со ссылкой для сортировки, 
текстовым инпутом для фильтра, с кнопками "вперед-назад" и возможностью выбрать страницу руками.

## Сопроводительная
Есть места, которые можно улучшить, но дабы не растягивать, сделано так. В расчете, 
что функционал не предусматривается расширять и т.п. Все поднимается через докер, ниже инструкция.

По заданию не требовалось покрывать тестами. Если интересно, можно глянуть пример в другом задании. 
Например, тут: https://github.com/kvatra/test-excel-parser

Как в действительности я пишу код архитектурно, например в своих проектах, можно глянуть тут:
https://github.com/kvatra/test-tickets-gate. 
Там все по направлению к CQRS.

## Deploy:
```
docker-compose build
```
```
docker-compose up -d
```
Приложение будет доступно на 8000 порту.

Для прогона миграции на создание таблицы нужно вызвать команду:
```
docker exec nevosoft_app_1 php migration.php
```
Заполнение тестовыми данными таблицы происходит через запуск файла seed.php. 
Он имеет дефолтные значения, но можно заполнить и своими по желанию.
Команда: 
```
docker exec nevosoft_app_1 php seed.php
```
