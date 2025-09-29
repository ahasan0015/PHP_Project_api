<?php
function getRoles(){
    echo json_encode(EcomRoles::readAll());
}
?>