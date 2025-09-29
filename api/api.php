<?php
// echo "API Working <br>";
require_once('../config/db.php');

// require_once('../models/products.class.php');
// require_once('../models/orders.class.php');
// OR
foreach (glob("../models/*.class.php") as $filename) {
    include_once($filename);
}

header("Access-Control-Allow-Origin: http://localhost:5173");
// include_once('product-api.php');
// include_once('order-api.php');
// OR
foreach(glob("*-api.php") as $filename) {
    include_once($filename);
}

if(isset($_GET['method'])) {
    $method = $_GET['method'];
    // echo $method;
    if($method == 'roles') {
        echo "API is working - Roles List";
        getRoles();
        // getProducts();
    }elseif($method == 'users'){
        echo "APi Working- users List";
    }else{
        echo "This user '$method' not found!";
    }
    // }elseif($method == 'product' && isset($_GET['id'])) {
    //     $id = $_GET['id'];
    //     getProductById($id);
    // }elseif($method == 'product-category' && isset($_GET['id'])) {
    //     $id = $_GET['id'];
    //     getProductByCategory($id);
    // }elseif($method == 'orders') {
    //     if(isset($_GET['pg'])) {
    //         $page = $_GET['pg'];
    //         getOrdersByPage($page);
    //     }else {
    //         getOrdersByPage(1);
    //     }
        // getOrdersByPage();
    // }
}

?>