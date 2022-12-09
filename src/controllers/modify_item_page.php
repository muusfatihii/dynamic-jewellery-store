<?php

require_once ('src/model/category.php');
require_once ('src/model/item.php');
require_once ('src/lib/DatabaseConnection.php');

function modifyPage(string $identifier){

    $connectiondb = new DatabaseConnection();

    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $item = $itemRepo->getItem($identifier);
    $category = $categoryRepo->getCategoryName($item->idCategory);

    $categories = $categoryRepo->getCategoriesNames($item->idCategory);

    require_once ('templates/modifyitem.php');
}