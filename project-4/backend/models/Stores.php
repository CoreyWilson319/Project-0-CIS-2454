<?php

include 'database.php';


class Store {
    public $id, $name;

    public function __construct($id, $name,) {
        $this->id = $id;
        $this->name = $name;

    }


    public function set_name($name) {
        return $this->name = $name;
        }

    public function get_name() {
        return $this->name;
    }
}

function list_stores() {
    global $database;

    $query = "SELECT id, name FROM stores";

    $statement = $database->prepare($query);

    $statement->execute();

    $stores = $statement->fetchAll();

    $statement->closeCursor();

    $stores_array = array();

    foreach ($stores as $store) 
        {$stores_array[] = new Store($store["id"], $store['name']);}

    return $stores_array;
    
}

function get_store($id) {
    global $database;

    $query = "SELECT id, name FROM stores WHERE id = $id";

    $statement = $database->prepare($query);

    $statement->execute();

    $store = $statement->fetchObject();

    $statement->closeCursor();


    return $store;
    
}

function insert_store($store) {
global $database;

$query = "INSERT INTO items (name) VALUES (:name)";

$statement = $database->prepare($query);
$statement->bindValue(":name", $store->get_name());

$statement->execute();

$statement->closeCursor();
}


function update_store($store) {
    global $database;

    $query = "UPDATE stores
            SET name = :name,
            WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":name", $store->get_name());

    $statement->execute();

    $statement->closeCursor();
}

function delete_store() {
    global $database;

    $query = "DELETE FROM stores WHERE id = :id";

    $statement = $database->prepare($query);

    $statement->execute();

    $statement->closeCursor();
}