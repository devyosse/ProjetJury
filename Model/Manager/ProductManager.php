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
}