<?php

include 'database.php';
include 'models/Items.php';
header('Content-Type: application/json');

$items = list_items();


$action = htmlspecialchars((filter_input(INPUT_POST, "action")));
$id = (filter_input(INPUT_POST, "id", FILTER_VALIDATE_FLOAT));
$store_id = (filter_input(INPUT_POST, "store_id", FILTER_VALIDATE_FLOAT));
$name = htmlspecialchars((filter_input(INPUT_POST, "name")));
$quantity = (filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_FLOAT));
$checked = (filter_input(INPUT_POST, "checked", FILTER_VALIDATE_BOOLEAN));

if ($action == "insert_or_update" && $store_id != "" && $name != "" && $quantity != ""&& $checked != "") {
    $insert_or_update = filter_input(INPUT_POST, "insert_or_update");

    $item = new Item($id, $store_id, $name, $quantity, $checked);


if ($insert_or_update == "insert") {
        insert_item($item);
    } else if ($insert_or_update == "update") {
        update_item($item);
    }
} else if ($action == "delete" && $id == "") {
    $item = new Item($id, 0, "", 0, true);

    delete_item($item);
} else  if ($action != "") {
    // Show Error
    echo "Error";
} else if ($action == "get" && $id != "") {
    get_item($id);
}

echo json_encode($items);

?>