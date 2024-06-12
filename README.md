# Generator usage inventory

## Це простий сайт для обліку запуску генераторів

Доступні такі діі:
- типи генераторів
- типи баків генераторів
- типи сервісних робіт
- сторінка з недавніми запусками генераторів
- сторінка з недавніми заправками генераторів
- сторінка з недавніми сервісними роботами
- головна сторінка зі списком генераторів та діями з ними

Основні діі на головній сторінці:
- коли наш генератор запускається ми натискаємо кнопку "запуск"
і обираємо:
час запуску та тип запуску:
- - це аварія електромережі чи щотижневий(наприклад) тест
- - також обираємо чи генератор запустився чи ні.
Якщо генератор запустився - на головній сторінці він відображається як працюючий.
Якщо генератор не запустився - на головній сторінці він відображаєтсья як неробочий.

- коли живлення дали і наш генератор зупинився ми натискаємо кнопку "стоп" і обираємо час.
- якщо у нас генератор був не робочий - то потрібно його запустити як "тест" і запинити.
Тільки після цого генератор переходить в робочий стан

## Встановлення

УВАГА - проєкт налаштований в режимі development (не production)


- створіть окремий домен для сайту
- налаштуйте nginx aбо apache для роботи з фреймворком Codeigniter https://codeigniter.com/user_guide/intro/requirements.html
- налаштуйте базу даних mysql або mariadb

Apache - https://codeigniter.com/user_guide/installation/running.html#hosting-with-apache

Nginx - https://codeigniter.com/user_guide/installation/running.html#hosting-with-nginx

Перейдіть в папку вашого проєкту

Клонуйте код

`git clone https://github.com/alexlansovich/generator.git` 

Змініть права на папку "writable"

`chmod 777 -R ./writable`

Імпортуйте базу даних

`generators-git.sql`

Виконайте оновлення фреймворку

`composer install`

## Налаштування

Файл `app/Config/App.php`

Змінити строку `'$baseURL'` на ваш домен

Файл `app/Config/Mail.php` потрібно редагувати якщо ви будете використовувати відправку звіту щодня на пошту.
Дані налаштування прописані для авторизаціі по SMTP протоколу з окремим обліковим записом.

Змінити пошту `$fromEmail  = 'system-generator@DOMAIN.com'`
Вказати SMTP користувача `$SMTPUser = 'system-generator@DOMAIN.com'`
Вказати пароль до користувача `$SMTPPass = 'PASSWORD'`
Вказати порт, якщо він відрізняється `$SMTPPort = 465`

Файл `app/Controllers/MyCli.php` потрібно редагувати поштові скриньки отрумувачів

Від кого `$email->setFrom('system-generator@DOMAIN', 'Генератор');`

Кому `$email->setTo('recepient1@DOMAIN');`

Копія `$email->setCC('recepient2@DOMAIN');`

Від кого `$email->setReplyTo('system-generator@DOMAIN', 'Admin');`

Для активації відправки пропишіть завдання в cron 

`30 7 * * * root /usr/bin/php /var/www/*розміщення*/public/index.php MyCli reportRunsDayMail`


Файл `app/Config/Database.php` потрібно прописати ваші налаштування бази даних

`'hostname'     => 'localhost',`

`'username'     => 'generators-git',`

`'password'     => 'generators-git',`

`'database'     => 'generators-git',`

Файл `app/Config/AuthGroups.php` визначає список груп користувачів які мають різні права:

`superadmin` - мають повний доступ

`noc` - моніторять і додають запуски

`manager` - моніторять і додають запуски

`mechanic` - мониторить і додає сервіси та паливо

`fueler` - мониторить і додає сервіси та паливо

Для керування користувачами потрібно використовувати консоль(в поточній версіі)

Створити користувача:

`php spark shield:user create -n userName -e userMail`

Додати користувача в группу:

`php spark shield:user addgroup -n userName -g uasrGroup`

Видалити користувача:

`php spark shield:user delete`

Повний список команд https://shield.codeigniter.com/user_management/managing_users/

