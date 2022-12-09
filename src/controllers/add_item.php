<?php

require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');




function addImage(array $picture){

    $new_img_name = "default.png";

    if(isset($picture) && !empty($picture)){

        $picname=$picture['name'];
        $pictmpname=$picture['tmp_name'];



        if($picture['size']>1000000){
            $em = "sorry your file is too large";
            header("Location: index.php?action=addPage&error=$em");
        }else{
            $img_ex = pathinfo($picname, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
    
            $allowed_exs=array("jpg","jpeg","png");
    
            if(in_array($img_ex_lc,$allowed_exs)){
    
                $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
                $img_upload_path='uploads/'.$new_img_name;
                move_uploaded_file($pictmpname,$img_upload_path);
            }else{
    
                $em="only jpg,jpeg,png extensions are allowed";
                header("Location: index.php?action=addPage&error=$em");
            }
        }
    }

    return $new_img_name;

}

















function addItem(array $input, array $pic)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;

    // $name = null;
    // $price = null;
    // $quantity = null;
    // $idCatgory = null;
    // $pic = null;
    // $description = null;

    if (!empty($input['name']) && !empty($input['price']) && !empty($input['quantity']) && !empty($input['idCategory'])) {
        



        $input['pic'] = addImage($pic);
        // $name = $input['name'];
        // $price = $input['price'];
        // $quantity = $input['quantity'];
        // $idCatgory = $input['idCategory'];
        // $description = $input['description'];

        // if (!empty($input['pic'])) {

        //     $pic = $input['pic'];
        // }

        // $input =[];

        // print_r($input);

        
    } else {
        throw new Exception('Les données du formulaire sont invalides.');
    }

    $success = $itemRepo->createItem($input);
    if (!$success) {
        throw new Exception("Impossible d\'ajouter l'article !");
    } else {
        header('Location: index.php?action=items&user=admin');
    }
}
