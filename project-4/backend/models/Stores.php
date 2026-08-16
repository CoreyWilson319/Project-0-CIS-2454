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

function get_by_name($store) {
    global $database;

    $query = "SELECT id, name FROM stores WHERE name = :name";

    $statement = $database->prepare($query);
    $statement->bindValue(":name", $store->get_name());

    $statement->execute();

    $store = $statement->fetchObject();

    $statement->closeCursor();


    return $store;
}
function insert_store($store) {
    global $database;

    $query = "INSERT INTO stores (name) VALUES (:name)";

    $statement = $database->prepare($query);
    $statement->bindValue(":name", $store->get_name());

    $statement->execute();
    $id = $database->lastInsertId();

    $statement->closeCursor();

//    return get_by_name($store);
    return [
        "id" => $id,
        "name" => $store-> get_name()
    ];


}


function update_store($store) {
    global $database;

    $query = "UPDATE stores
            SET name = :name
            WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":name", $store->get_name());
    $statement->bindValue(":id", $store->id);
    
    $statement->execute();
    
    $statement->closeCursor();
    
    return get_store($store->id);
    }

function delete_store($store) {
    global $database;
    
    $query = "DELETE FROM stores WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $store->id);

    $statement->execute();

    $statement->closeCursor();
}