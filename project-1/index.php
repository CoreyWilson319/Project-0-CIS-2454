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
            $initial_taxable_income = $taxable_income;
            $output_agi = "$".number_format($taxable_income, 2, '.', ',');
            $tax_brackets = [
                [0, 12400, .10], 
                [12400, 50400, .12], 
                [50400, 105700, .22], 
                [105700, 201775, .24], 
                [201775, 256225, .32], 
                [256225, 640600, .35], 
                [640600, 999999999, .37]];
            $user_bracket_index = null;
            $taxable_amounts = [];
            foreach ($tax_brackets as $index => $bracket) {
                [$min, $max, $rate] = $bracket;
                $percentage = number_format($rate * 100). '%';
                $taxable_amount = ($max - $min) * $bracket[2];

                if ($taxable_income > $max) {
                    $output = "$".number_format(($taxable_amount), 2, '.', ',');
                    echo "<h2>Taxes Owed at {$percentage} bracket: {$output}<br></h2>";
                    $income_in_bracket = $max - $min;
                    $taxable_amount = $income_in_bracket * $rate;
                    $taxable_amounts[] = $taxable_amount;
                } else {
                    $user_bracket_index = $index;
                    $final_output = ($taxable_income - $min) * $rate;
                    $final_output = "$".number_format(($final_output), 2, '.', ',');
                    echo "<h2>Taxes Owed at {$percentage} bracket: {$final_output}<br></h2>";
                    $taxable_amounts[] = $final_output;
                    break;
                }               
            }
            
            for ($i = $user_bracket_index + 1; $i < count($tax_brackets); $i++) {
                $min = $tax_brackets[$i][0];
                $max = $tax_brackets[$i][1];
                $percentage = number_format($tax_brackets[$i][2] * 100). '%';
                echo "<h2>Taxes Owed at {$percentage} bracket: $0.00<br></h2>";
            }
            
            echo "<h2>Adjusted Gross Income: {$output_agi} <br></h2>";
            $total_tax = "$".number_format(array_sum($taxable_amounts), 2, '.', ',');
            echo "<h2>Total Owed Taxes: {$total_tax} <br></h2>";
            
            $tax_percent = round(100 * (array_sum($taxable_amounts) /
                    $initial_taxable_income), 2)."%";
            echo "<h2>Taxes Owed as percentage of adjusted gross income: $tax_percent</h2>";
        }
        
       
        ?>
    </body>
</html>
