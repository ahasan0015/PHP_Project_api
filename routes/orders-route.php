<?php
if ($page == "orders") {
    include_once('view/pages/orders/orders-manage.php');
} elseif ($page == "orders-create") {
    include_once('view/pages/orders/orders-create.php');
} elseif ($page == "orders-edit") {
    include_once('view/pages/orders/orders-edit.php');
} elseif ($page == "orders-details") {
    include_once('view/pages/orders/orders-details.php');
}elseif ($page == "orders-invoice") {
    include_once('view/pages/orders/orders-invoice.php');
}
?>