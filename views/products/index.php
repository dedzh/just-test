<!DOCTYPE html>
<html lang=" ru">
<head>
    <meta charset=" UTF-8">
    <title>Мини ппроектики</title>
    <link rel ="stylesheet" href="/script/stayle.css">
</head>
<body>
<div class="container">
        <h1>📦 Мини-WMS · Склад</h1>
        <a href="/?action=create" class="btn btn-primary">+ Добавить товар</a>

        <?php if (empty($products)): ?>
            <p class="empty">Пока товаров нет. Добавьте первый!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Артикул</th>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена, ₽</th>
                        <th>Создан</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= (int) $p['id'] ?></td>
                        <td><code><?= htmlspecialchars($p['sku'], ENT_QUOTES, 'UTF-8') ?></code></td>
                        <td><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= (int) $p['quantity'] ?></td>
                        <td><?= number_format((float) $p['price'], 2, ',', ' ') ?></td>
                        <td><?= htmlspecialchars($p['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="actions">
                            <a href="/?action=edit&id=<?= (int) $p['id'] ?>" class="btn">✏️</a>
                            <form method="post"
                                  action="/?action=delete&id=<?= (int) $p['id'] ?>"
                                  class="inline"
                                  onsubmit="return confirm('Удалить «<?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?>»?');">
                                <button type="submit" class="btn btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>