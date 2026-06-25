<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <h1 id="header">Federal Income Tax Helper</h1>
            <form method="post" id="form-container">
                <div>
                    <label>Name:</label><input class="form_input" value="" name="name" id="name"/>
                </div>
                <div>
                    <label>Gross Income:</label><input class="form_input" value="" name="income" id="income"/>                
                </div>
                <div>
                    <label>Total Deductions:</label><input class="form_input" value="" name="deductions" id="deductions"/>                
                </div>
                <button id="submit" type="Submit">Submit</button>
            </form>

        <?php
        
//        Default variables declared
        $form_name = 0;
        $form_gross_income = 0;
        $form_deductions = 0;
        
        function validateForm($name, $gross_income, $deductions) {
//            Declare validated as true
            $validated = true;
            if (strlen($name) < 1) {
//                if length of name less than 1 validated is false
                echo "<h1>'Invalid Name Entered.'</h1>";
                $validated = false;
            } else if (is_numeric($gross_income) === false ||
                    is_numeric($deductions) === false) {
//                if gross income or deductions are not numeric validated false
                echo "<h1>Invalid Gross Income or Total Deduction.</h1>";
                $validated = false;
            } else if ($gross_income < 0 || $deductions < 0) {
                echo "<h1>Income or Deductions cannot be less than 0.</h1>";
                $validated = false;
//                if gross income or deduction less than 0 validated false
            } else if ($deductions > $gross_income) {
                echo "<h1>Deductions cannot be more than Gross Income.</h1>";
//                if deductions is greater than gross income validated is false
                $validated = false;
            }
//            return validated
            return $validated;
        }

        
        function calculateTaxes($taxable_income, $gross_income, $name) {
            echo "<h1>Welcome {$name},</h1>";
//            Create another variable for taxable income as one will be manipulated
            $initial_taxable_income = $taxable_income;
//            format taxable income to appeal to user
            $output_agi = "$" . number_format($taxable_income, 2, '.', ',');
//            create a 2D array with bracket minimums and maximums and the percentages
            $tax_brackets = [
                [0, 12400, .10],
                [12400, 50400, .12],
                [50400, 105700, .22],
                [105700, 201775, .24],
                [201775, 256225, .32],
                [256225, 640600, .35],
                [640600, 999999999, .37]];
//            initialze user tax bracket and taxable amounts for each bracket
            $user_bracket_index = null;
            $taxable_amounts = [];
//            for each bracket
            foreach ($tax_brackets as $index => $bracket) {
//                get the minimum, the maximum and the rate from the bracket
                [$min, $max, $rate] = $bracket;
//                format the percentage
                $percentage = number_format($rate * 100) . '%';
//                determine how much can be taxed by taking the difference
//                between the two and getting multiplying it by the rate for that
//                bracket                
                $taxable_amount = ($max - $min) * $bracket[2];
//              if users taxable income is greater than the maximum for that bracket
                if ($taxable_income > $max) {
//                    format the output and show that taxable amount to user
                    $output = "$" . number_format(($taxable_amount), 2, '.', ',');
                    echo "<h2 class=owed>Taxes Owed at {$percentage} bracket: {$output}<br></h2>";
//                    take the difference of the maximum and minimum amounts from the bracket
                    $income_in_bracket = $max - $min;
//                    and find the amount by multiplying it by the rate from the bracket
                    $taxable_amount = $income_in_bracket * $rate;
//                    add that amount to the array of taxable amounts per bracket
                    $taxable_amounts[] = $taxable_amount;
                } else {
//                    otherwise this is our users last bracket
                    $user_bracket_index = $index;
//                    store the index to be used outside of the scope of this loop
                    $final_output = ($taxable_income - $min) * $rate;
//                    add the final amount to the taxable amounts array and show to user
                    $taxable_amounts[] = $final_output;
                    $final_output = "$" . number_format(($final_output), 2, '.', ',');
                    echo "<h2 class=owed>Taxes Owed at {$percentage} bracket: {$final_output}<br></h2>";
//                    break loop we can stop here
                    break;
                }
            }

//            start a second for loop for the remainder of the amounts
//            using the index the previous loop was stopped
//            I think this might be unnecessary?
            for ($i = $user_bracket_index + 1; $i < count($tax_brackets); $i++) {
                $min = $tax_brackets[$i][0];
                $max = $tax_brackets[$i][1];
//                show the remaining brackets and the rates default the amount
//                for that bracket to 0
                $percentage = number_format($tax_brackets[$i][2] * 100) . '%';
                echo "<h2>Taxes Owed at {$percentage} bracket: $0.00<br></h2>";
            }

//            show user formated adjusted gross income, and total taxes owed
//            by taking the sum of the taxable_amounts array
            echo "<h2 class=income>Adjusted Gross Income: {$output_agi} <br></h2>";
            $total_tax = "$" . number_format(array_sum($taxable_amounts), 2, '.', ',');
            echo "<h2 class=owed>Total Owed Taxes: {$total_tax} <br></h2>";

//            also show the percentage of taxes using the initial taxable income variable
//            and the gross taxable income
            $tax_percent = round(100 * (array_sum($taxable_amounts) /
                            $initial_taxable_income), 2) . "%";

            $gross_tax_percent = round(100 * (array_sum($taxable_amounts) /
                            $gross_income), 2) . "%";
            echo "<h2>Taxes Owed as percentage of adjusted gross income: $tax_percent</h2>";
            echo "<h2>Taxes Owed as percentage of gross income: {$gross_tax_percent}</h2>";
        }

        
//        If form POST retrieve variables from form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $form_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $form_gross_income = (float) $_POST['income'];
            $form_deductions = (float) $_POST['deductions'];
//            Calculate adjusted gross income
            $adjusted_gross_income = (float) $form_gross_income - $form_deductions;

//            Validate form name, gross income and deductions
            if (validateForm($form_name, $form_gross_income, $form_deductions) === true) {
//                If Validation True Calculate Taxes
                calculateTaxes($adjusted_gross_income, $form_gross_income, $form_name);
            } else {
//                If Validation returns False Alert User
                echo ("<h1>Error Invalid Form Entry</h1>");
            }
        }


        ?>
    </body>
</html>
