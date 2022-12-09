<?php



require_once 'src/model/item.php';



function homepage()
{

    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $items = $itemRepo->getRecentItems();

    require('templates/homepage.php');
}
