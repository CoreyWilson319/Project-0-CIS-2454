<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1 id="header">Federal Income Tax Helper</h1>
        <form method="post">
            <label>Name:</label><input class="form_input" value="" name="name" id="name"/>
            <label>Gross Income:</label><input class="form_input" value="" name="income" id="income"/>
            <label>Total Deductions:</label><input class="form_input" value="" name="deductions" id="deductions"/>
            <button id="submit" type="Submit">Submit</button>
        </form>
        <?php
        $form_name = "";
        $form_gross_income = "";
        $form_deductions = "";

        
        
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $form_name = $_POST['name'];
            $form_gross_income = $_POST['income'];
            $form_deductions = $_POST['deductions'];
            $adjusted_gross_income = $form_gross_income - $form_deductions;
            
        if (validateForm($form_name, $form_gross_income, $form_deductions) === true) {
                calculateTaxes($adjusted_gross_income);
            } else {
                echo ("<h1>Error Invalid Form Entry</h1>");
            }
        
        }
        
        function validateForm($name, $gross_income, $deductions) {
            $validated = true;
            if (strlen($name) < 1) {
                echo "<h1>'Invalid Name Entered.'</h1>";
                $validated = false;
            } else if (is_numeric($gross_income) === false || 
                    is_numeric($deductions) === false) {
                echo "<h1>Invalid Gross Income or Total Deduction.</h1>";
                $validated = false;
            } 
            return $validated;
        }
        
        function calculateTaxes($taxable_income) {
            $output_agi = $taxable_income;
            
            $tax_brackets = [
                [0, 12400, .10], 
                [12400, 50400, .12], 
                [50400, 105700, .22], 
                [105700, 201775, .24], 
                [201775, 256225, .32], 
                [256225, 640600, .35], 
                [640600, 999999999, .37]];
            foreach ($tax_brackets as $bracket) {
                $min = $bracket[0];
                $max = $bracket[1];
                $percentage = number_format($bracket[2] * 100). '%';

                if ($min < $taxable_income) {
                    $output = "$".number_format($max * $bracket[2], 2, '.', ',');
//                    $output = "$".number_format(($taxable_income) * $bracket[2], 2, '.', ',');
                    echo "<h2>Taxes Owed at {$percentage} bracket: {$output}<br></h2>";
                    $taxable_income = $taxable_income - $max;
                } 
                else {
                    echo "<h2>Taxes Owed at {$percentage} bracket: $0.00 <br></h2>";
                }
                
            }
            
            echo "<h2>Adjusted Gross Income: {$output_agi} <br></h2>";
        }
        
       
        ?>
    </body>
</html>
