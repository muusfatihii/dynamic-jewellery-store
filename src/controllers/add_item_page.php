<?php

require_once ('src/model/category.php');
require_once ('src/lib/DatabaseConnection.php');

function addPage(){

    $connectiondb = new DatabaseConnection();

    $categoryRepo = new CategoryRepository();
    $categoryRepo->connectiondb = $connectiondb;

    $categories = $categoryRepo->getCategories();

    require_once ('templates/additem.php');
}