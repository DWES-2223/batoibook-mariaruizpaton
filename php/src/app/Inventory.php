<?php

namespace BatBook;

class Inventory
{
    const STOCK_BAJO = 5;

    public function __construct($idProduct, int $stock)
    {
    }

    public function getProduct()
    {
        $book = new Book();
        return $book->findIdBook($this->idProduct);
    }

    public function updateStock($quantity)
    {
        return $this->stock + $quantity;
    }

    public function showStock()
    {
        return $this->stock;
    }

    public static function getLowStockProducts()
    {
        $stocks = QueryBuilder::sql(Inventory::class);
        $lowStock = [];
        foreach ($stocks as $item) {
            if ($item->stock < self::STOCK_BAJO) {
                array_push($lowStock, $item);
            }
        }
        return $lowStock;
    }
}