<?php

require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');



function filterItems(string $idcategory)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;


    $items = $itemRepo->getfilteredItems($idcategory);
    $categories = $categoryRepo->getCategories();

    require('templates/galleryuser.php');


}



function filterItemsadmin(string $idcategory)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;


    $items = $itemRepo->getfilteredItems($idcategory);
    $categories = $categoryRepo->getCategories();

    require('templates/galleryadmin.php');


}