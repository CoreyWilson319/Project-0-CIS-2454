<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fresh Market</title>
        <link rel="stylesheet" href="./style.css"/>
    </head>
    <body>
        <h1>Fresh Market</h1>
        <div id="form-container">
            <form method="POST">
                <label>Delete Item:</label>
                <input type="hidden" name="_method" value="DELETE"/>
                <input id="item" name="item">  
                <button type="submit">Delete</button>
            </form>
            <form method="POST">
                <label>Staff:</label>
                <input type="hidden" name="_method" value="PUT"/>
                <input id="number" name="number">
                <button type="submit">Update</button>
            </form> 
            <form method="POST">
                <label>Add Item:</label>
                <input id="item" name="item">
                <button type="submit">Add</button>
            </form> 
            <form method="GET">
                <button type="submit">Show Items</button>
            </form> 
        </div>
        
        <?php
        require_once 'FrontEndCalls.php';
        $api_call = new FrontEndCalls();

        $method = $_POST['_method'] ?? 
                $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? 
                $_SERVER['REQUEST_METHOD'];
                
        if ($method === "PUT") {
            
            $number = $_POST['number'] ?? null;
            $api_call ->setStaff($number);
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
            
        }

        if ($method === "DELETE") {
            
            $item = $_POST['item'] ?? null;
            $api_call ->deleteItem($item);
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        
        if ($method === "POST"){
            
            $item = $_POST['item'] ?? null;            
            $api_call ->addItem($item);
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        
        if ($method === "GET"){
            
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        

        
        ?>

    </body>
</html>
