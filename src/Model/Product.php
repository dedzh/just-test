<?php
declare(strict_types=1);
class Product
{
    public function __construct(private Pdo $pdo){}

    public function all(): array  
    {
        $stmt = $this->pdo -> query("SELECT * FROM products ORDER BY created_at DESC");
        return  $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo -> prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row =$stmt->fetch();
        return  $row? : null;
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo -> prepare("INSERT INTO products(sku, name, quantity, price) VALUES (?,?,?,?)");
        $stmt->execute([
            $data['sku'],
            $data['name'],
            $data['quantity'],
            $data['price'],
        ]);
        return (int) $this ->pdo -> lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo -> prepare("UPDATE producta SET sku=?, name=?, quantity=?, price=?)");
        $stmt->execute([
            $data['sku'],
            $data['name'],
            $data['quantity'],
            $data['price'],
            $id,
        ]);
    }

    public function delete(int $id): void  
    {
        $stmt = $this->pdo -> query("DELETE * FROM products WHERE id =?");
        $stmt->execute([$id]);
    }

    public function skuExist(string $sku, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM products WHERE sku = ?";
        $params = [$sku];

        if($excludeId !==null){
            $sql .="AND id !=?";
            $params[] = $excludeId;
        }

        
        $stmt = $this->pdo -> prepare($sql);
        $stmt->execute([$params]);
        return(int) $stmt -> fetchColumn() >0;
    }
    

}




