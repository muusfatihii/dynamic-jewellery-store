<?php

require_once('src/controllers/add_item.php');
require_once('src/controllers/modify_item.php');
require_once('src/controllers/delete_item.php');
require_once('src/controllers/item.php');
require_once('src/controllers/items.php');
require_once('src/controllers/filter_items.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/add_item_page.php');
require_once('src/controllers/modify_item_page.php');
require_once('src/controllers/loginpage.php');
require_once('src/controllers/aboutpage.php');
require_once('src/controllers/login.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {


        switch($_GET['action']) {

            case 'item':
              
                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $identifier = $_GET['id'];
            
                    item($identifier);
                } else {
                    throw new Exception("Aucun identifiant d'article n'est envoyé");
                }

                break;

            case 'items':

                if (isset($_GET['user']) && $_GET['user']=='admin') {
            
                    itemsAdmin();

                }else{
                    items();
                }
                break;
              
            case 'addItem':

              addItem($_POST, $_FILES['pic']);

              break;

            case 'modifyItem':

                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $identifier = $_GET['id'];
            
                    modifyItem($identifier, $_POST, $_FILES['pic']);
                } else {
                    throw new Exception("Aucun identifiant d'article n'est envoyé");
                }
                break;

            case 'deleteItem':

                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $identifier = $_GET['id'];
            
                    deleteItem($identifier);
                } else {
                    throw new Exception("Aucun identifiant d'article n'est envoyé");
                }
            
            case 'filter':

                if (isset($_POST['categoryid']) && !empty($_POST['categoryid'])) {
                    $idcategory = $_POST['categoryid'];
                    if (isset($_GET['user']) && $_GET['user'] == 'admin'){
                        filterItemsAdmin($idcategory);
                    }else{
                        filterItems($idcategory);
                    }
                    
                } else {

                    if (isset($_GET['user']) && $_GET['user']=='admin') {
            
                        itemsAdmin();
    
                    }else{
                        items();
                    }
                }

                break;

            case 'loginPage':

                loginPage();

                break;

            case 'login':

                login($_POST);

                break;

            case 'aboutPage':

                aboutPage();

                break;

            case 'addPage':

                addPage();

                break;
                
            case 'modifyPage':

                if (isset($_GET['id']) && $_GET['id'] > 0) {
                    $identifier = $_GET['id'];
            
                    modifyPage($identifier);
                } else {
                    throw new Exception("Aucun identifiant d'article n'est envoyé");
                }

                break;

            default:
            throw new Exception("La page que vous recherchez n'existe pas.");
          }

    } else {


        homepage();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}
