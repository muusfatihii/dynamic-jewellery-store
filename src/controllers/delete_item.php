<?php

require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');



function deleteItem(string $identifier)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    $success = $itemRepo->deleteItem($identifier);

    if (!$success) {
        throw new Exception("Impossible de supprimer l'article !");
    } else {
        header('Location: index.php?action=items&user=admin');
    }

}
