<?php
if ($page == "categories") {
    include_once('view/pages/categories/categories-manage.php');
} elseif ($page == "categories-create") {
    include_once('view/pages/categories/categories-create.php');
} elseif ($page == "categories-edit") {
    include_once('view/pages/categories/categories-edit.php');
} elseif ($page == "categories-details") {
    include_once('view/pages/categories/categories-details.php');
}
?>