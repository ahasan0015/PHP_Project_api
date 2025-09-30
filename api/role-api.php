<?php
function getRoles(){
    echo json_encode(EcomRoles::readAll());
}
function createRoles($data){
    $role = new EcomRoles(null,$data["name"] );
    echo json_encode( "role id: " .$role->create());
}
?>