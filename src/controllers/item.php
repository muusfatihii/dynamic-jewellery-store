<?php

require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');



function item(string $identifier)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $catRepo = new CategoryRepository();
    $catRepo->connectiondb = $connectiondb;



    $item = $itemRepo->getItem($identifier);
    $cat = $catRepo->getCategoryName($item->idCategory);


    
    require('templates/itemDescription.php');
}
