<?php

require_once('src/model/item.php');

require_once('src/lib/DatabaseConnection.php');




function modifyImage(array $picture){

    $new_img_name = "";


    if(isset($picture) && !empty($picture)){

        $picname=$picture['name'];
        $pictmpname=$picture['tmp_name'];



        if($picture['size']>100000000){
            $em = "sorry your file is too large";
            header("Location: add.php?error=$em");
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
                header("Location: add.php?error=$em");
            }
        }
    }

    return $new_img_name;

}






function modifyItem(string $identifier, array $input, array $pic)
{
    $connectiondb = new DatabaseConnection();

    $itemRepo = new ItemRepository();
    $itemRepo->connectiondb = $connectiondb;


    if (empty($input['name']) || empty($input['price']) || empty($input['quantity']) || empty($input['idCategory'])) {
        
        throw new Exception('Les données du formulaire sont invalides.');
    } 

    if(modifyImage($pic)!=""){
        $input['pic'] = modifyImage($pic);
        $success = $itemRepo->modifyItemPic($identifier, $input);
    }else{
        $success = $itemRepo->modifyItem($identifier, $input);
    }
    
    if (!$success) {
        throw new Exception("Impossible de modifier l'article !");
    } else {
        header('Location: index.php?action=items&user=admin');
    }
}
