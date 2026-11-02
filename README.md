# Mini-WMS · учебный проект

Мини-система учёта товаров на складе. Pet-проект для изучения чистого PHP (MVC).

## Стек
- PHP 8.1+ (ООП, PDO, prepared statements)
- SQLite (легко заменить на MySQL — SQL идентичен)
- HTML, CSS, минимальный JS (confirm на удаление)
- Git

## Функционал
- CRUD по товарам
- Валидация на бэкенде (обязательные поля, уникальный артикул, неотрицательные числа)
- Защита от SQL-инъекций (prepared statements)
- Защита от XSS (htmlspecialchars)
- POST-only удаление + PRG-паттерн

## Запуск
```bash
php -S localhost:8000 -t public
```
Открыть http://localhost:8000
---
