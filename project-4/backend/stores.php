<?php

include 'database.php';
include 'models/Stores.php';

$data = json_decode(file_get_contents("php://input"), true);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($path, '/'));

$id = $data["id"] ?? null;
$action = $data["action"] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);
$name = $data["name"] ?? null;

header('Content-Type: application/json');


    $name !== null &&
    $insert_or_update = $data["insert_or_update"] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if ($id !== false && $id !== null) {
            echo json_encode(get_store($id));
            } else {
                echo json_encode(list_stores());
        } 
    }

    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($name === null || $name === '') {
            $store = new Store(null, $name);
            insert_store($store);
            echo json_encode(get_by_name($store));
    } else {
        $store = new Store(null, $name);

        $new_store = insert_store($store);

        echo json_encode($new_store);
    }
            } 
    else if ($_SERVER['REQUEST_METHOD'] === "PUT") {
            $store = new Store($id, $name);
            update_store($store);
            echo json_encode(get_store($store->id));


    } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

        $store = new Store($id, null);
        $deleted_store = get_store($id);
        delete_store($store);
        echo "Deleted: ".json_encode($deleted_store);

    }
?>