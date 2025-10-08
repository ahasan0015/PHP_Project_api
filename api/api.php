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
header("Access-Control-Allow-Methods:*");
header("Access-Control-Allow-Headers:*");
// include_once('product-api.php');
// include_once('order-api.php');

include_once('../helper/jwt.php');
// OR

foreach (glob("*-api.php") as $filename) {
    include_once($filename);
}
$request = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['method'] ?? null;

if (!$endpoint) {
    echo json_encode(["error" => "No endpoint specifired"]);
    exit;
}

if (!($endpoint == 'login' && $request == 'POST')) {
    $headers = getallheaders();
    $auth_header = $headers["Authorization"] ?? '';
    if (!$auth_header) {
        http_response_code(401);
        echo json_encode(["error" => "No token provider"]);
        exit;
    }
    $bearer_token = explode(' ', $auth_header);
    $token = $bearer_token[1];
    try {
        $decoded = validateJWT($token); //from jwt.php 
        //decoded now contains user info
    } catch (Exception $e) {
        http_response_code(404);
        echo json_encode(["error" => "Invalid or expored token"]);
        exit;
    }
    echo "Other API Request";
} else {
    echo "Login API request";
}

// if ($endpoint) {
//     $method = $_GET['method'];
//     // echo $method;
//     if ($method == 'roles') {
//         // echo "API is working - Roles List";
//         getRoles();
//         // getProducts();
//     } elseif ($method == 'create-roles' && $request == 'POST') {
//         echo "Create role API Working";
//         // echo "APi Working- users List";
//         $data = json_decode(file_get_contents("php://input"), true);
//         echo json_encode($_POST);
//     } elseif ($method == 'users' && $request == 'GET') {

//         getUsers();
//     } elseif ($method == 'create-user' && $request == 'POST') {
//         //    echo json_encode($_POST);
//         //    echo json_encode($_FILES);
//         createUsers($_POST, $_FILES);
//     } elseif ($method == 'token' && $request == 'POST') {
//         // echo json_encode($_GET['id']);
//         // deleteUser($_GET['id']);

//         $data = [
//             "name" => "Ahasan Habib Roxy",
//             "email" => "ahasanstu@gmail.com",
//             "role" => "SuperAdmin"
//         ];
//         echo json_encode("Bearer token:" . generateJWT($data, 60));


//     } elseif ($method == 'token-check') {
//         $headers = getallheaders();
//         $auth_header = $headers["Authorization" ?? ''];
//         $jwt = explode(' ', $auth_header);

//         echo json_encode(validateJWT($jwt[1]));
//         // echo json_encode($headers["Authorization"]);
//     } else {
//         echo "This user '$method' not found!";
//     }

// }

?>