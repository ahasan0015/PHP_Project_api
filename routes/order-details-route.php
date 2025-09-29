<?php
if ($page == "order-details") {
    include_once('view/pages/order-details/order-details-manage.php');
} elseif ($page == "order-details-create") {
    include_once('view/pages/order-details/order-details-create.php');
} elseif ($page == "order-details-edit") {
    include_once('view/pages/order-details/order-details-edit.php');
} elseif ($page == "order-details-details") {
    include_once('view/pages/order-details/order-details-details.php');
}
?>