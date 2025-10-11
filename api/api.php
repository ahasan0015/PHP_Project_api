<?php
// header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// echo "API Working <br>";
require_once('../config/db.php');

// require_once('../models/products.class.php');
// require_once('../models/orders.class.php');
// OR
include_once('../helper/img-upload-helper.php');
include_once('../helper/jwt.php');

foreach (glob("../models/*.class.php") as $filename) {
    include_once($filename);
}

// include_once('product-api.php');
// include_once('order-api.php');
// OR
foreach(glob("*-api.php") as $filename) {
    include_once($filename);
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$request = $_SERVER['REQUEST_METHOD'];
$endpoint = $_GET['endpoint'] ?? null;

if(!$endpoint) {
    echo json_encode(["error" => "No endpoint specified"]);
    exit;
}

if($endpoint == 'login' && $request == 'POST') {
    $data = json_decode(file_get_contents("php://input"),true);
    // echo json_encode($data);
    login($data);
}else if($endpoint == 'token') {
    $data = [
            "name" => "Asia",
            "email" => "asia@example.com",
            "role" => "Admin"
        ];
        echo json_encode(generateJWT($data,60*60*24*7));
}else{
    $headers = getallheaders();
    $auth_header = $headers['Authorization'] ?? '';
    if (!$auth_header) {
        http_response_code(401);
        echo json_encode(["error" => "No token provided"]);
        exit;
    }
    $bearer_token = explode(' ', $auth_header);
    $token = $bearer_token[1];
    try {
        $decoded = validateJWT($token); // from jwt.php
        // $decoded now contains user info
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid or expired token"]);
        exit;
    }
    
    if($endpoint == 'roles' && $request == 'GET') {
        getRoles();
    } else if($endpoint == 'create-role' && $request == 'POST') {
        $data = json_decode(file_get_contents("php://input"),true);
        // echo json_encode(gettype($data));
        createRoles($data);
    } else if($endpoint == 'role' && $request == 'GET') {
        getRoles($_GET['id']); 
    // } else if($endpoint == 'edit-role' && $request == 'PUT') {
    //     $data = json_decode(file_get_contents("php://input"),true);
    //     // echo json_encode($data);
    //     updateRole($data);
    // } else if($endpoint == 'delete-role' && $request == 'DELETE') {
    //     // echo json_encode($_GET['id']);
    //     deleteRole($_GET['id']);
    }    
    else if($endpoint == 'users' && $request == 'GET') {
        getUsers();
    }
    else if($endpoint == 'create-user' && $request == 'POST') {
        // echo json_encode($_POST);
        // echo json_encode($_FILES);
        createUsers($_POST, $_FILES);
    }
    else if($endpoint == 'delete-user' && $request == 'DELETE') {
        // echo json_encode($_GET['id']);
        deleteUser($_GET['id']);
    }
    else if($endpoint == 'token-check') {
        $headers = getallheaders();
        $auth_header = $headers['Authorization'] ?? '';
        $jwt = explode(' ', $auth_header);

        echo json_encode(validateJWT($jwt[1]));

        $authHeader = $headers['Authorization'] ?? '';
        if (!$authHeader) {
            http_response_code(401);
            echo json_encode(["error" => "No token provided"]);
            exit;
        }
        $tokenParts = explode(' ', $authHeader);
        $jwt = $tokenParts[1];
        try {
            $decoded = validateJWT($jwt); // from jwt.php
            // $decoded now contains user info
            echo json_encode($decoded);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid or expired token"]);
            exit;
        }
    }
    else{
        foreach(glob("routes/*-route.php") as $filename) {
            include_once($filename);
        }
        // echo "This url '$endpoint' not found!";
    }
}

// if($endpoint) {
//     if($endpoint == 'roles' && $request == 'GET') {
//         getRoles();
//     } else if($endpoint == 'create-role' && $request == 'POST') {
//         $data = json_decode(file_get_contents("php://input"),true);
//         // echo json_encode(gettype($data));
//         createRole($data);
//     } else if($endpoint == 'role' && $request == 'GET') {
//         getRole($_GET['id']); 
//     } else if($endpoint == 'edit-role' && $request == 'PUT') {
//         $data = json_decode(file_get_contents("php://input"),true);
//         // echo json_encode($data);
//         updateRole($data);
//     } else if($endpoint == 'delete-role' && $request == 'DELETE') {
//         // echo json_encode($_GET['id']);
//         deleteRole($_GET['id']);
//     }    
//     else if($endpoint == 'users' && $request == 'GET') {
//         getUsers();
//     }
//     else if($endpoint == 'create-user' && $request == 'POST') {
//         // echo json_encode($_POST);
//         // echo json_encode($_FILES);
//         createUser($_POST, $_FILES);
//     }
//     else if($endpoint == 'delete-user' && $request == 'DELETE') {
//         // echo json_encode($_GET['id']);
//         deleteUser($_GET['id']);
//     }
//     else if($endpoint == 'token' && $request == 'POST') {
//         $data = [
//             "name" => "Asia",
//             "email" => "asia@example.com",
//             "role" => "Admin"
//         ];
//         echo json_encode(generateJWT($data,60));
//     }
//     else if($endpoint == 'token-check') {
//         $headers = getallheaders();
//         $auth_header = $headers['Authorization'] ?? '';
//         $jwt = explode(' ', $auth_header);

//         echo json_encode(validateJWT($jwt[1]));

//         // $authHeader = $headers['Authorization'] ?? '';
//         // if (!$authHeader) {
//         //     http_response_code(401);
//         //     echo json_encode(["error" => "No token provided"]);
//         //     exit;
//         // }
//         // $tokenParts = explode(' ', $authHeader);
//         // $jwt = $tokenParts[1];
//         // try {
//         //     $decoded = validateJWT($jwt); // from jwt.php
//         //     // $decoded now contains user info
//         //     echo json_encode($decoded);
//         // } catch (Exception $e) {
//         //     http_response_code(401);
//         //     echo json_encode(["error" => "Invalid or expired token"]);
//         //     exit;
//         // }
//     }
//     else{
//         foreach(glob("routes/*-route.php") as $filename) {
//             include_once($filename);
//         }
//         // echo "This url '$endpoint' not found!";
//     }    
    
// }

?>