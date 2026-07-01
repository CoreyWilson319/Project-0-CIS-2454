<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'FrontEndCalls.php';
        
//      When I want to get items do this
        echo "<div id=item-container>";
        foreach (getItems() as $item) {
            echo $item;
        }
        echo "</div>";
//      END
        
        setStaff(20);

        echo getStaff();
        deleteItem("sick");

        echo '<form><label>Item:</label><input id="item"> </form> <button type="submit">Delete</button>';
        echo '<form><label>Staff:</label><input id="item"> </form> <button type="submit">Submit</button>';
        ?>
    </body>
</html>
