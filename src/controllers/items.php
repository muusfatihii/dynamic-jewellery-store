<?php

require_once('src/model/item.php');
require_once('src/model/category.php');

require_once('src/lib/DatabaseConnection.php');



function items()
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;


    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;



    $items = $itemRepo->getItems();

    $categories = $categoryRepo->getCategories();


    require('templates/galleryuser.php');

}


function itemsAdmin()
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;


    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;



    $items = $itemRepo->getItems();

    $categories = $categoryRepo->getCategories();


    require('templates/galleryadmin.php');

}