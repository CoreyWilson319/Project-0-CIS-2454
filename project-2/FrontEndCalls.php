<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of FrontEndCalls
 *
 * @author corey
 */
class FrontEndCalls {
    //put your code here
    private $url = "http://localhost:8080";
    
    function getStaff(){
            $staff_response = json_decode(file_get_contents(self.url."/staffing"), true);
            return $staff_response; 
        }
        
        function setStaff($number_of_staff) {
            $put_url = self.url."/staffing/".$number_of_staff;
            $ch = curl_init($put_url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
            
        }
        
        function getItems(){
            
            $items_response = json_decode(file_get_contents(self.url."/items"), true);
            
            $item_components = array_map(function($item){
                return("<div> $item </div><br>");
            }, $items_response);
            
            return $item_components; 
        }
        
        function addItem($item) {
            $post_url = self.url."/items/".$item;
            $ch = curl_init($post_url);
            curl_setopt($ch, CURLOPT_POST, true);
//            Set option to not retrieve the response body from the backend
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
        }
        
        function deleteItem($item) {
//            item obtained from form
            $delete_url = self.url."/items/".$item;
            $ch = curl_init($delete_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
//            On click do this function?
            
        }
}
