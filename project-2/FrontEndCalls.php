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
//  create to private variables the url where our api can be reached
    private static $url = "http://localhost:8080";
    private $last_status;
    
    
        private function getStaff(){
//          retrive json from string url built
            $staff_response = json_decode(
                    file_get_contents($this->url."/staffing"), true);
//          return html containining the number from the request
            return "<div id='number_of_staff'>$staff_response</div>"; 
        }
        
        public function setStaff($number_of_staff) {
//          Build a URL to reach backend to set the number of staff
            $put_url = $this->url."/staffing/".$number_of_staff;
//          create a new Client URL session to communicate with backend
            $ch = curl_init($put_url);
            
//          set options to make a PUT request 
//          and return api response as a string
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
//          execute api call with options and return the response
            curl_exec($ch);
//          retrieve status code
            $status = $this->checkHTTPSTatus($ch);
//          if status isn't a 200 display an error
            if ($status !== 200) {
                echo "<h2>Error: Invalid Number</h2>";
            }
//          terminate call
            curl_close($ch);           

            
        }
        
        private function getItems(){
//          return json from api as a string which is an array
            $items_response = json_decode(file_get_contents($this->url."/items")
                    , true);
//          iterate over that array 
            $item_components = array_map(function($item){
//          create individual items to display to user                
                return("<div class='item'> $item </div>");
            }, $items_response);
//          return the new array of html items            
            return $item_components; 
        }
        
        public function addItem($item) {
//          build url to add an item            
//          same logic as setStaff, instantiate curl, 
//          set options, execute, check for errors
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
//          build url to delete an item            
//          same logic as setStaff, instantiate curl, 
//          set options, execute, check for errors            
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
//          echo the array mapped earlier to 
//          create the items inside of another div
            echo "<div id=item-container>";
            foreach ($this->getItems() as $item) {
                echo $item;
            }
            echo "</div>";
        }
        
        public function displayStaff() {
//          render staff from api
            echo $this->getStaff();
        }
        
        private function checkHTTPSTatus($ch) {
//          take a curl session and retrieve the http code and return that code
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            return $status_code;
        }

        
}
