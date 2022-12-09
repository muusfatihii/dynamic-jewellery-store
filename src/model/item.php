<?php


require_once ('src/lib/DatabaseConnection.php');




class Item{
    public string $id;
    public string $name;
    public string $price;
    public string $quantity; 
    public string $idCategory; 
    public string $addDate; 
    public string $pic;
    public string $description;
}


class ItemRepository
{

    public DatabaseConnection $connectiondb;

    public function getItems():array
{

    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`, `name`, `price`, `quantity`, `id_category`, DATE_FORMAT(add_date, '%d/%m/%Y à %Hh%imin%ss') AS add_date, `pic`, `description` FROM `item` WHERE 1"
    );
    $statement->execute();

    $items = [];
    while (($row = $statement->fetch())) {
        $item = new Item();
        $item->id = $row['id'];
        $item->name = $row['name'];
        $item->price = $row['price'];
        $item->quantity = $row['quantity'];
        $item->idCategory = $row['id_category'];
        $item->addDate = $row['add_date'];
        $item->pic = $row['pic'];
        $item->description = $row['description'];

        $items[] = $item;
    }

    return $items;
}



public function getRecentItems():array
{

    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`, `name`, `price`, `quantity`, `id_category`, DATE_FORMAT(add_date, '%d/%m/%Y à %Hh%imin%ss') AS add_date, `pic`, `description` FROM `item` ORDER BY add_date LIMIT 3"
    );
    $statement->execute();

    $items = [];
    while (($row = $statement->fetch())) {
        $item = new Item();
        $item->id = $row['id'];
        $item->name = $row['name'];
        $item->price = $row['price'];
        $item->quantity = $row['quantity'];
        $item->idCategory = $row['id_category'];
        $item->addDate = $row['add_date'];
        $item->pic = $row['pic'];
        $item->description = $row['description'];

        $items[] = $item;
    }

    return $items;
}


public function getfilteredItems($idcategory):array
{


    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`, `name`, `price`, `quantity`, `id_category`, DATE_FORMAT(add_date, '%d/%m/%Y à %Hh%imin%ss') AS add_date, `pic`, `description` FROM `item` WHERE id_category=?"
    );
    $statement->execute([$idcategory]);

    $items = [];
    while (($row = $statement->fetch())) {
        $item = new Item();
        $item->id = $row['id'];
        $item->name = $row['name'];
        $item->price = $row['price'];
        $item->quantity = $row['quantity'];
        $item->idCategory = $row['id_category'];
        $item->addDate = $row['add_date'];
        $item->pic = $row['pic'];
        $item->description = $row['description'];

        $items[] = $item;
    }

    return $items;
}



public function getItem(string $identifier) : Item {
    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `name`, `price`, `quantity`, `id_category`, `add_date`, `pic`, `description` FROM `item` WHERE id = ?"
    );
    $statement->execute([$identifier]);

    $row = $statement->fetch();

    $item = new Item();


    $item->id = $identifier;
    $item->name = $row['name'];
    $item->price = $row['price'];
    $item->quantity = $row['quantity'];
    $item->idCategory = $row['id_category'];
    $item->addDate = $row['add_date'];
    $item->pic = $row['pic'];
    $item->description = $row['description'];

    return $item;
}

public function createItem(array $input)
{

    $name = $input['name'];
    $price = $input['price'];
    $quantity = $input['quantity'];
    $idCategory = $input['idCategory'];
    $pic = $input['pic'];
    $description = $input['description'];

    $statement = $this->connectiondb->getConnection()->prepare(
        "INSERT INTO `item`(`name`, `price`, `quantity`, `id_category`, `add_date`, `pic`, `description`) VALUES (?,?,?,?,NOW(),?,?)"
    );
    $affectedLines = $statement->execute([$name, $price, $quantity, $idCategory, $pic, $description]);


    

    return ($affectedLines > 0);
}



public function deleteItem(string $identifier)
{

    $statement = $this->connectiondb->getConnection()->prepare(
        "DELETE FROM `item` WHERE id = ?"
    );
    $affectedLines = $statement->execute([$identifier]);

    return ($affectedLines > 0);

}


public function modifyItemPic(string $identifier, array $input)
{
    $name = $input['name'];
    $price = $input['price'];
    $quantity = $input['quantity'];
    $idCategory = $input['idCategory'];
    $pic = $input['pic'];
    $description = $input['description'];
    

    $statement = $this->connectiondb->getConnection()->prepare(

        "UPDATE `item` SET `name`='$name',`price`='$price',`quantity`='$quantity',`id_category`='$idCategory',`pic`='$pic',`description`='$description' WHERE id= ?"
    );
    $affectedLines =  $statement->execute([$identifier]);

    return ($affectedLines > 0);
}



public function modifyItem(string $identifier, array $input)
{
    $name = $input['name'];
    $price = $input['price'];
    $quantity = $input['quantity'];
    $idCategory = $input['idCategory'];
    $description = $input['description'];
    

    $statement = $this->connectiondb->getConnection()->prepare(

        "UPDATE `item` SET `name`='$name',`price`='$price',`quantity`='$quantity',`id_category`='$idCategory',`description`='$description' WHERE id= ?"
    );
    $affectedLines =  $statement->execute([$identifier]);

    return ($affectedLines > 0);
}


}

