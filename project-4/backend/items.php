<?php

include 'database.php';
include 'models/Items.php';

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($path, '/'));

$id = $data["id"] ?? null;

$action = $data["action"] ?? null;
// $id = $data["id"] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);
$store_id = $data["store_id"] ?? null;
$name = $data["name"] ?? null;
$quantity = $data["quantity"] ?? null;
$checked = $data["checked"] ?? null;

header('Content-Type: application/json');

// $action = htmlspecialchars((filter_input(INPUT_POST, "action")));
// $id = (filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT));
// $store_id = (filter_input(INPUT_POST, "store_id", FILTER_VALIDATE_INT));
// $name = htmlspecialchars((filter_input(INPUT_POST, "name")));
// $quantity = (filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT));
// $checked = (filter_input(INPUT_POST, "checked", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE));

    $store_id !== null &&
    $name !== null &&
    $quantity !== null &&
    is_bool($checked) == true;
    $insert_or_update = $data["insert_or_update"] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if ($id !== false && $id !== null) {
            echo json_encode(get_item($id));
            } else {
                echo json_encode(list_items());
        } 
    }

    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = new Item(null, $store_id, $name, $quantity, $checked);
            echo(json_encode(insert_item($item)));

    } else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
//        add logic to ensure id exists
            $item = new Item($id, $store_id, $name, $quantity, $checked);
            echo(json_encode(update_item($item)));

    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

        $item = new Item($id, 0, "", 0, true);
        $removed_item = get_item($id);
        delete_item($item);
        echo(json_encode($removed_item));

    }
?>