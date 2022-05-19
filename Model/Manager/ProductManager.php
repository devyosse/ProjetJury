<?php

use App\Model\Database;

class ProductManager
{
    public const TABLE = 'product';

    /**
     * Return all products.
     * @return array
     */
    public static function getAllProducts(): array
    {
        $products = [];
        $result = Database::getPDO()->query("SELECT * FROM " . self::TABLE);
        if($result->execute()) {
            foreach ($result->fetchAll() as $item) {
                $products[] = (new Product)
                    ->setName($item['name'])
                    ->setContent($item['content'])
                    ->setDateRelease($item['date_release'])
                    ->setId($item['id'])
                ;
            }
        }
        return $products;
    }

    /**
     * Get a product by its id.
     * @param int $id
     * @return void
     */
    public static function getProduct(int $id): ?Product
    {
        $stmt = Database::getPDO()->query("SELECT * FROM " . self::TABLE . ' WHERE id = ' . filter_var($id, FILTER_VALIDATE_INT));
        if($stmt->execute() && $item = $stmt->fetch()) {
            return (new Product())
                ->setId($item['id'])
                ->setName($item['name'])
                ->setContent($item['content'])
                ->setDateRelease($item['date_release'])
            ;
        }

        return null;
    }

    /**
     * @param Product|null $product
     * @return bool
     */
    public static function updateProduct(?Product $product): bool
    {
        $stmt = Database::getPDO()->prepare('
            UPDATE '.self::TABLE.' SET name=:name, content=:content, date_release=:date_release WHERE id=:id
        ');

        $stmt->bindValue(":name", $product->getName());
        $stmt->bindValue(":content", $product->getContent());
        $stmt->bindValue(":date_release", $product->getDateRelease());
        $stmt->bindValue(":id", $product->getId());

        return $stmt->execute();
    }


    /**
     * Insert a new product.
     * @param Product $product
     * @return bool
     */
    public static function addProduct(Product &$product): bool
    {
        $stmt = Database::getPDO()->prepare('
            INSERT INTO '.self::TABLE.' (name, content, date_release) VALUES (:name, :content, :date_release)
        ');

        $stmt->bindValue(":name", $product->getName());
        $stmt->bindValue(":content", $product->getContent());
        $stmt->bindValue(":date_release", $product->getDateRelease());

        $result = $stmt->execute();
        $product->setId(Database::getPDO()->lastInsertId());
        return $result;
    }


    /**
     * Delete a product.
     * @param int $id
     * @return bool
     */
    public static function deleteProduct(int $id): bool
    {
        $stmt = Database::getPDO()->prepare("DELETE FROM ". self::TABLE." WHERE id=:id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }
}