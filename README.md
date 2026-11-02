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

## 🚀 Шаг 10. Запуск и проверка

```bash
cd mini-wms
php -S localhost:8000 -t public
```

Открой http://localhost:8000. Должна открыться пустая таблица.