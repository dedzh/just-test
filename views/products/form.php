<?php

/** @var array $old */
/** @var array $errors */
/** @var bool $isEdit */
$isEdit = isset($product);
$title = $isEdit ? 'Редактировать товар' : 'Новый товар';
$action = $isEdit ? "/?action=edit&id={$product['id']}" : "/?action=create";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/script/stayle.css">
</head>

<body>
    <div class="container narrow">
        <h1><?= $title ?></h1>
        <a href="/" class="back">← Назад к списку</a>

        <form method="post" action="<?= $action ?>" class="card">
            <label>Артикул*
                <input type="text" name="sku" value="<?= htmlspecialchars((string) $old['sku'], ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if (isset($errors['sku'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['sku'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </label>

            <label>Название*
                <input type="text" name="name" value="<?= htmlspecialchars((string) $old['name'], ENT_QUOTES, 'UTF-8') ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </label>

            <label>Количество
                <input type="number" name="quantity" min="0" value="<?= (int) $old['quantity'] ?>">
                <?php if (isset($errors['quantity'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['quantity'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </label>

            <label>Цена, ₽
                <input type="number" name="price" min="0" step="0.01" value="<?= (float) $old['price'] ?>">
                <?php if (isset($errors['price'])): ?>
                    <span class="error"><?= htmlspecialchars($errors['price'], ENT_QUOTES, 'UTF-8') ?></span>
                <?php endif; ?>
            </label>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</body>

</html>