<?php

use BatBook\Inventory;
use BatBook\QueryBuilder;

include_once '../load.php';
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $productoId = $_GET['id'];
    if (!isset($productoId)){
        $inventory = QueryBuilder::sql(Inventory::class);
        foreach ($inventory as $item){
            echo $item->toJson().', ';
        }
    } else {
        $inventory = QueryBuilder::find(Inventory::class, $productoId);
        echo $inventory->toJson();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $bookId = $_POST['bookId'];
    $stock = $_POST['stock'];
    $inventory = new Inventory($bookId, $stock);
    $result = $inventory->save();
    if ($result){
        return json_encode('Correcte', $result);
    } else {
        return json_encode('No actualizado');
    }
}