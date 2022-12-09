<?php


require_once('src/model/admin.php');
require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');

function login($input){

    $connectiondb = new DatabaseConnection();

    $adminRepo = new AdminRepository();
    $adminRepo->connectiondb = $connectiondb;

    $auth = $adminRepo->checkAdmin($input);

    if(!$auth){
    $em="Ce compte n’existe pas";
    require('templates/login.php');
    }else{

        $itemRepo = new ItemRepository();
        $itemRepo->connectiondb = $connectiondb;

        $items = $itemRepo->getRecentItems();
        require('templates/adminpage.php');
    }

}