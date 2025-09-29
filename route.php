<?php
//  echo $_SERVER['REQUEST_URI']."<br>";
//  echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//  echo $_GET['page'];

if(isset($_GET['page'])) {
   $page = $_GET['page'];
   // echo "<h1>$page</h1>";
   foreach (glob("routes/*-route.php") as $filename) {
     include $filename;
   }
   if($page == "dashboard") {
      include_once('view/pages/dashboard.php');
   }elseif($page == "pos") {
      include_once('view/pages/pos.php');
   }elseif($page == "pos-page") {
      include_once('view/pages/pos-page.php');
   }elseif($page == "logout") {
      include_once('view/pages/logout.php');
   }elseif($page == "categories") {
      include_once('view/pages/categories/categories-manage.php');
   }elseif ($page == "categories-create") {
    include_once('view/pages/categories/categories-create.php');
} elseif ($page == "categories-edit") {
    include_once('view/pages/categories/categories-edit.php');
} elseif ($page == "categories-details") {
    include_once('view/pages/categories/categories-details.php');
}
   elseif($page == "users") {
      include_once('view/pages/users.php');
   }elseif($page == "users-manage") {
      include_once('view/pages/users/users-manage.php');
   }elseif($page == "users-create") {
      include_once('view/pages/users/users-create.php');
   }elseif($page == "users-edit") {
      include_once('view/pages/users/users-edit.php');
   }elseif($page == "roles") {
      include_once('view/pages/ecom-roles/ecom-roles-manage.php');
   }elseif($page == "role-create") {
      include_once('view/pages/ecom-roles/ecom-roles-create.php');
   }elseif($page == "role-edit") {
      include_once('view/pages/ecom-roles/ecom-roles-edit.php');
   }elseif($page == "role-details") {
      include_once('view/pages/ecom-roles/ecom-roles-details.php');
   }else{
      //include_once('view/pages/404.php');
   }
}else{
   // include_once('view/pages/dashboard.php');
}
?>