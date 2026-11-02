<?php

declare(strict_types=1);
class ProductController
{
    private Product $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Product($pdo);
    }

    public function index(): void
    {
        $product = $this->model->all();
        require __DIR__ . '/../../views/products/index.php';
    }

    public function create(): void
    {
        $errors = [];
        $old = ['sku' => '', 'name' => '', 'quantity' => 0, 'price' => 0];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $this->normalize($_POST);
            $errors = $this->validate($old);

            if (empty($errors)) {
                $this->model->create($old);
                header('Location: /');
                exit;
            }
        }

        require __DIR__ . '/../../views/products/form.php';
    }

    public function edit(int $id): void
    {
        $product = $this->model->find($id);
        if ($product === null) {
            http_response_code(404);
            echo "Товар не найден";
            return;
        }

        $errors = [];
        $old = $product;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = $this->normalize($_POST);
            $errors = $this->validate($old, $id);

            if (empty($errors)) {
                $this->model->update($id, $old);
                header('Location: /');
                exit;
            }
        }

        require __DIR__ . '/../../views/products/form.php';
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Метод не разрешён";
            return;
        }
        $this->model->delete($id);
        header('Location: /');
        exit;
    }

    private function normalize(array $input): array
    {
        return [
            'sku'      => trim((string) ($input['sku'] ?? '')),
            'name'     => trim((string) ($input['name'] ?? '')),
            'quantity' => (int) ($input['quantity'] ?? 0),
            'price'    => (float) ($input['price'] ?? 0),
        ];
    }

    private function validate(array $data, ?int $excludeId = null): array
    {
        $errors = [];

        if ($data['sku'] === '') {
            $errors['sku'] = 'Артикул обязателен';
        } elseif ($this->model->skuExist($data['sku'], $excludeId)) {
            $errors['sku'] = 'Такой артикул уже есть';
        }

        if ($data['name'] === '') {
            $errors['name'] = 'Название обязательно';
        }

        if ($data['quantity'] < 0) {
            $errors['quantity'] = 'Количество не может быть отрицательным';
        }

        if ($data['price'] < 0) {
            $errors['price'] = 'Цена не может быть отрицательной';
        }

        return $errors;
    }
}
