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
                <!--method is post because no PUT and DELETE in PHP-->
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
//        import FrontEndCalls and instantiate as api_call
        require_once 'FrontEndCalls.php';
        $api_call = new FrontEndCalls();

        //        Store the first variable that is not null as method

        $method = $_POST['_method'] ?? 
                $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] ?? 
                $_SERVER['REQUEST_METHOD'];
                
        if ($method === "PUT") {
//          If method is put update the number of staff
//          Retrieve number from POST SuperGlobal
            $number = $_POST['number'] ?? null;
//          perform setStaff method passing number obtained from form as parameter
            $api_call ->setStaff($number);
//          Rerender Staff on Duty and Items before closing with exit;
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
            
        }

        if ($method === "DELETE") {
//          If method is delete delete the passed item from the api
//          Retrieve number from POST SuperGlobal            
            $item = $_POST['item'] ?? null;
//          perform deleteItem with parameter obtained from SuperGlobal
            $api_call ->deleteItem($item);
//          Rerender Staff on Duty and Items before closing with exit;            
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        
        if ($method === "POST"){
//          If method is delete delete the passed item from the api
            $item = $_POST['item'] ?? null;  
//          Retrieve item from POST SuperGlobal              
//          Perform addItem method with the item variable as a parameter    
            $api_call ->addItem($item);
            echo "<h1>Staff on Duty</h1>";
//          Rerender Staff on Duty and Items before closing with exit;                        
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        
        if ($method === "GET"){
//          Render Staff on Duty and Items before closing with exit;                        
            echo "<h1>Staff on Duty</h1>";
            $api_call ->displayStaff();
            echo "<h1>Available Items</h1>";
            $api_call ->displayItems();
            exit();
        }
        

        
        ?>

    </body>
</html>
