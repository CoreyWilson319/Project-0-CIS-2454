<?php

include 'database.php';
include 'models/Stores.php';
header('Content-Type: application/json');

$stores = list_stores();


$action = htmlspecialchars((filter_input(INPUT_POST, "action")));
$id = (filter_input(INPUT_POST, "id", FILTER_VALIDATE_FLOAT));
$name = htmlspecialchars((filter_input(INPUT_POST, "name")));


if ($action == "insert_or_update" && $name != "") {
    $insert_or_update = filter_input(INPUT_POST, "insert_or_update");

    $store = new Store($id, $name);


if ($insert_or_update == "insert") {
        insert_store($store);
    } else if ($insert_or_update == "update") {
        update_store($store);
    }
} else if ($action == "delete" && $id == "") {
    $item = new Store($id, "");

    delete_item();
} else  if ($action != "") {
    // Show Error
    echo "Error";
} else if ($action == "get" && $id != "") {
    get_store($id);
}

echo json_encode($stores);

?>