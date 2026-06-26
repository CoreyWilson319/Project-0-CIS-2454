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
        $url = "http://localhost:8080";
        
        function getStaff($url){
            $staff_response = json_decode(file_get_contents($url."/staffing"), true);
            return $staff_response; 
        }
        
        function getItems($url){
            
            $items_response = json_decode(file_get_contents($url."/items"), true);
            
            $item_components = array_map(function($item){
                return("<div> $item </div><br>");
            }, $items_response);
            
            return $item_components; 
        }
        
        function addItem($url, $item) {
            $post_url = $url."/items/".$item;
            $ch = curl_init($post_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_exec($ch);
        }
        
        addItem($url, "hotdogs");
        
        
//      When I want to get items do this
        echo "<div id=item-container>";
        foreach (getItems($url) as $item) {
            echo $item;
        }
        echo "</div>";
//      END

        echo getStaff($url);

        ?>
    </body>
</html>
