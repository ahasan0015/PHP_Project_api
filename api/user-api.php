<?php 

function getUsers(){
    // echo "Function is working";
    echo json_encode(Users::readAll());
}

function createUsers($data, $files){
    $image = imgUpload($files["photo"]);
    if(isset($image["success"])){
            $photo = $image["success"];
    }else{
        $photo = "";
        echo json_encode(["success" => false, "message" => $image['error']]);
        exit;
    }

    $user = new Users(null, $data["name"], $data["email"], "", $data["role_id"], $data["address"], $photo);
    echo json_encode($user->create());
}

?>