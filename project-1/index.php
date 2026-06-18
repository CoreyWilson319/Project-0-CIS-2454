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
        <h1>Federal Income Tax Helper</h1>
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
            $tax_brackets = [[12400, .10], [50400, .12], [105700, .22], 
                [201775, .24], [256225, .32], [640600, .35], [640601, .37]];
            foreach ($tax_brackets as $bracket) {
                $cutoff = $bracket[0];
                $percentage = number_format($bracket[1] * 100). '%';
                $amount = $taxable_income * $bracket[1];
                if ($taxable_income > $cutoff) {
                    echo "Taxes Owed at {$percentage} bracket:<br> {$amount}";
                }
            }
        }
        
       
        ?>
    </body>
</html>
