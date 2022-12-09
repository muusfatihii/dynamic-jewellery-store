<?php


require_once ('src/lib/DatabaseConnection.php');






class Category{
    public string $id;
    public string $name;
}


class CategoryRepository
{

    public DatabaseConnection $connectiondb;

    public function getCategories():array
   {
    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`, `name` FROM `category` WHERE 1"
    );
    $statement->execute();

    $categories = [];
    while (($row = $statement->fetch())) {

        $category = new Category();

        $category->id = $row['id'];
        $category->name = $row['name'];
        

        $categories[] = $category;
    }

    return $categories;
   }



   public function getCategoryName(string $identifier):Category
   {
    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`, `name` FROM `category` WHERE id = ?"
    );
    $statement->execute([$identifier]);

    $row = $statement->fetch();

    $category = new Category();

    $category->id = $row['id'];
    $category->name = $row['name'];


    return $category;
}



public function getCategoriesNames($identifier):array
   {
    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id`,`name` FROM `category` WHERE id!=?"
    );
    $statement->execute([$identifier]);

    $categories = [];
    while (($row = $statement->fetch())) {

        $category = new Category();

        $category->id = $row['id'];
        $category->name = $row['name'];
        

        $categories[] = $category;
    }

    return $categories;
   }





}
