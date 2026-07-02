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
    private $last_status;
    
    
        private function getStaff(){
            $staff_response = json_decode(file_get_contents($this->url."/staffing"), true);
            return "<div id='number_of_staff'>$staff_response</div>"; 
        }
        
        public function setStaff($number_of_staff) {
            $put_url = $this->url."/staffing/".$number_of_staff;
            $ch = curl_init($put_url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
            $status = $this->checkHTTPSTatus($ch);
            if ($status !== 200) {
                echo "<h2>Error: Invalid Number</h2>";
            }
            curl_close($ch);           

            
        }
        
        private function getItems(){
            
            $items_response = json_decode(file_get_contents($this->url."/items")
                    , true);
            
            $item_components = array_map(function($item){
                return("<div class='item'> $item </div>");
            }, $items_response);
            
            return $item_components; 
        }
        
        public function addItem($item) {
            $post_url = $this->url."/items/".$item;
            $ch = curl_init($post_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            $status = $this->checkHTTPSTatus($ch);
            if ($status !== 200) {
                echo "<h2>Error: Item already exists</h2>";
            }
            curl_close($ch);
        }
        
        public function deleteItem($item) {
            $delete_url = $this->url."/items/".$item;
            $ch = curl_init($delete_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_exec($ch);
            $status = $this->checkHTTPSTatus($ch);
            if ($status !== 200) {
                echo "<h2>Error: Does not Exists</h2>";
            }
            curl_close($ch);
            
        }
        
        public function displayItems() {
            echo "<div id=item-container>";
            foreach ($this->getItems() as $item) {
                echo $item;
            }
            echo "</div>";
        }
        
        public function displayStaff() {
            echo $this->getStaff();
        }
        
        private function checkHTTPSTatus($ch) {
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this-> last_status = $status_code;

            return $status_code;
        }

        
}
