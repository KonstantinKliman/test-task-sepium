# Тестовое задание для Sepium

---

##### Стек: 
- PHP 8.3
- MySQL 8.0
- Docker + Docker compose

---

1. Клонируем проект

```bash
git clone https://github.com/KonstantinKliman/test-task-sepium.git
```

2. Переходим в папку с проектом 

```bash
cd test-task-sepium
```

3. Билдим и поднимаем контейнеры

```bash
docker-compose up --build -d
```

4. Переходим на localhost:8888
- Если зарегистрировать "админа" по логину `admin` и паролю `admin`, то у него будет возможность удалять пользователей
- Доступ к БД доступ через phpmyadmin root/root_password