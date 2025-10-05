<?php
// echo "API Working <br>";
require_once('../config/db.php');

// require_once('../models/products.class.php');
// require_once('../models/orders.class.php');
// OR
foreach (glob("../models/*.class.php") as $filename) {
    include_once($filename);
}
include_once("../helper/img-upload-helper.php");

header("Access-Control-Allow-Origin: *");

// header("Access-Control-Allow-Origin: http://localhost:5174");
// header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers:*");
// include_once('product-api.php');
// include_once('order-api.php');
// OR
foreach(glob("*-api.php") as $filename) {
    include_once($filename);
}
$request = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['method'] ?? null;

if($endpoint) {
    $method = $_GET['method'];
    // echo $method;
    if($method == 'roles') {
        // echo "API is working - Roles List";
        getRoles();
        // getProducts();
    }elseif($method == 'create-roles' && $request == 'POST'){
        echo "Create role API Working";
         // echo "APi Working- users List";
        $data =json_decode(file_get_contents("php://input"),true);
        echo json_encode($_POST);
    }elseif($method == 'users' && $request == 'GET'){
       getUsers();
    }elseif($method == 'create-user' && $request == 'POST'){
    //    echo json_encode($_POST);
    //    echo json_encode($_FILES);
            createUsers($_POST, $_FILES);
    }else{
        echo "This user '$method' not found!";
    }
    
}

?>