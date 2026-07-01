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
    
    function __construct() {
        
    }
    
        private function getStaff(){
            $staff_response = json_decode(file_get_contents($this->url."/staffing"), true);
            return $staff_response; 
        }
        
        public function setStaff($number_of_staff) {
            $put_url = $this->url."/staffing/".$number_of_staff;
            $ch = curl_init($put_url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
            
        }
        
        private function getItems(){
            
            $items_response = json_decode(file_get_contents($this->url."/items"), true);
            
            $item_components = array_map(function($item){
                return("<div class='item'> $item </div>");
            }, $items_response);
            
            return $item_components; 
        }
        
        public function addItem($item) {
            $post_url = $this->url."/items/".$item;
            $ch = curl_init($post_url);
            curl_setopt($ch, CURLOPT_POST, true);
//            Set option to not retrieve the response body from the backend
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
        }
        
        public function deleteItem($item) {
//            item obtained from form
            $delete_url = $this->url."/items/".$item;
            $ch = curl_init($delete_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
//            On click do this function?
            
        }
        
        public function displayItems() {
            //      When I want to get items do this
            echo "<div id=item-container>";
            foreach ($this->getItems() as $item) {
                echo $item;
            }
            echo "</div>";
            //      END
        }
        
        public function displayStaff() {
            echo $this->getStaff();
        }
}
