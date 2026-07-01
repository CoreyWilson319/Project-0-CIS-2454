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
        <?php
        require_once 'FrontEndCalls.php';
        $api_call = new FrontEndCalls();
        echo "<h1>Available Items</h1>";
        $api_call ->displayItems();
        echo "<h1>Staff on Duty</h1>";
        $api_call ->displayStaff();
        
        $method = $_POST['_method'] ?? $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? $_SERVER['REQUEST_METHOD'];
                
        if ($method === "PUT") {
            parse_str(file_get_contents("php://input"), $req_vars);
            
            $number = $req_vars['number'] ?? null;
            $api_call ->setStaff($number);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        if ($method === "DELETE") {
            parse_str(file_get_contents("php://input"), $req_vars);
            
            $item = $req_vars['item'] ?? null;
            $api_call ->deleteItem($item);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
        
        if ($method === "POST"){
            parse_str(file_get_contents("php://input"), $req_vars);
            
            $item = $req_vars['item'] ?? null;
            $api_call ->addItem($item);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
        

        ?>
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
    </body>
</html>
