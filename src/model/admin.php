<?php


require_once ('src/lib/DatabaseConnection.php');





class AdminRepository
{

    public DatabaseConnection $connectiondb;




   public function checkAdmin(array $input)
   {
    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id` FROM `admin` WHERE `username` = ? AND `passwrd` = ?"
    );
    $statement->execute([$input['username'],$input['password']]);

    $auth = $statement->fetch();



    return $auth;

   }


}
