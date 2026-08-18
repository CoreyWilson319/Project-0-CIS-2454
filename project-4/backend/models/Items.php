<?php

include 'database.php';


class Item {
    public $id, $store_id, $name, $quantity, $checked;

    public function __construct($id, $store_id, $name, $quantity, $checked) {
        $this->id = $id;
        $this->store_id = $store_id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->checked = $checked;
    }

    public function set_store_id($store_id) {
        return $this->store_id = $store_id;
        }

    public function get_store_id() {
        return $this->store_id;
    }

    public function set_name($name) {
        return $this->name = $name;
        }

    public function get_name() {
        return $this->name;
    }

    public function set_quantity($quantity) {
        return $this->quantity = $quantity;
        }

    public function get_quantity() {
        return $this->quantity;
    }

    public function set_checked($checked) {
        return $this->checked = $checked;
        }

    public function get_checked() {
        return $this->checked;
    }
   
}

function list_items() {
    global $database;

    $query = "SELECT id, store_id, name, quantity, checked FROM items";

    $statement = $database->prepare($query);

    $statement->execute();

    $items = $statement->fetchAll();

    $statement->closeCursor();

    $items_array = array();

    foreach ($items as $item) {
        $items_array[] = new Item($item["id"], $item['store_id'], $item['name'], $item['quantity'],
        $item['checked']);
        }

    return $items_array;
    
}

function get_items_by_store($id) {
    global $database;

    $query = "SELECT id, store_id, name, quantity, checked
            FROM items
            WHERE store_id = $id";

    $statement = $database->prepare($query);

    $statement->execute();

    $items = $statement->fetchAll();

    $statement->closeCursor();

    $items_array = array();

    foreach ($items as $item) {
        $items_array[] = new Item($item["id"], $item['store_id'], $item['name'], $item['quantity'],
        $item['checked']);
        }

    return $items_array;
    
}

function get_item($id) {
    global $database;
    $query = "SELECT id, store_id, name, quantity, checked FROM items WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id, PDO::PARAM_INT);

    $statement->execute();

    $item = $statement->fetchObject();

    $statement->closeCursor();


    return $item;
    
}

function insert_item($item) {
    global $database;

    $query = "INSERT INTO items
        (store_id, name, quantity, checked)
        VALUES (:store_id, :name, :quantity, :checked)";

    $statement = $database->prepare($query);
    $statement->bindValue(":store_id", $item->get_store_id());
    $statement->bindValue(":name", $item->get_name());
    $statement->bindValue(":quantity", $item->get_quantity());
    $statement->bindValue(":checked", $item->get_checked());

    $statement->execute();
    $id = $database->lastInsertId();
    $statement->closeCursor();

    return [
        "id" => $id,
        "store_id" => $item-> get_store_id(),
        "name" => $item-> get_name(),
        "quantity" => $item-> get_quantity(),
        "get_checked" => $item-> get_checked(),
    ];
}


function update_item($item) {
    global $database;

    $query = "UPDATE items
            SET store_id = :store_id,
                name = :name,
                quantity = :quantity,
                checked = :checked
            WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":store_id", $item->get_store_id());
    $statement->bindValue(":name", $item->get_name());
    $statement->bindValue(":quantity", $item->get_quantity());
    $statement->bindValue(":checked", $item->get_checked());
    $statement->bindValue(":id", $item->id);

    $statement->execute();

    $statement->closeCursor();
    return [
    "id" => $item->id,
    "store_id" => $item-> get_store_id(),
    "name" => $item-> get_name(),
    "quantity" => $item-> get_quantity(),
    "get_checked" => $item-> get_checked(),
    ];
}

function delete_item($item) {
    global $database;

    $query = "DELETE FROM items WHERE id = :id";

    $statement = $database->prepare($query);

    $statement->bindValue(":id", $item->id);


    $statement->execute();

    $statement->closeCursor();
}