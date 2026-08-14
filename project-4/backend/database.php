<?php
$data_source_name = "mysql:host=localhost;dbname=final_project";
$username = 'manager';
$password = 'password';

$database = new PDO($data_source_name, $username, $password);

?>