<?php
if ($page == "products") {
    include_once('view/pages/products/products-manage.php');
} elseif ($page == "products-create") {
    include_once('view/pages/products/products-create.php');
} elseif ($page == "products-edit") {
    include_once('view/pages/products/products-edit.php');
} elseif ($page == "products-details") {
    include_once('view/pages/products/products-details.php');
}
?>