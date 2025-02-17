<?php
    $error = [];
    $monthly_salary = $yearly_salary = $clear = $calculate  = $operation = $annual_income = $tax = $extra_tax = $overflow_income = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['monthly_salary'])  && !empty($_POST['monthly_salary']) && is_numeric($_POST['monthly_salary'])) {
           $monthly_salary = $_POST['monthly_salary'];
        }
        else {
            $error['monthly_salary'] = "Enter Monthly Salary";
        }
        if (isset($_POST['yearly_salary'])  && !empty($_POST['yearly_salary']) && is_numeric($_POST['yearly_salary'])) {
            $yearly_salary = $_POST['yearly_salary'];
         }
         else {
             $error['yearly_salary'] = "Enter Yearly Salary";
         }
         if(isset($_POST['clear'])) {
           $monthly_salary = null;
           $yearly_salary = null;
         }
         if(isset($_POST['operation'])) {
            $operation = $_POST['operation'];
          }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Tax Calculator</title>
    <style>
        .error {
            color : red;
        }
        * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
        }
        .output {
            margin-left : 70px;
        }
        .title {
             width: 100%;  
             height: fit-content;
             padding : 10px;
             background-color: rgb(217, 217, 244);
        }
        .assessment_info {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;  
            margin-top : 10px;
             height: fit-content;
             padding : 10px;
             background-color: rgb(217, 217, 244);
        }
        #gender{
            width : 40%;
            padding : 10px;
        }
        #relationship{
            width : 40%;
            padding : 10px;
        }
       p {
        font-size: 20px;
       }
 
       .input_field input {
        padding : 10px;
       }
       .monthly_salary {
        padding-left : 20px;
        margin : 10px;
        width: 40%;
        display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
       }
       .yearly_salary {
        padding-left : 20px;
        margin : 10px;
        width: 40%;
        display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
       }
       .button {
        padding-left : 20px;
        padding-right : 20px;
        margin : 30px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
       }
       .clear {
        background-color: red;
        color : white;
        padding : 10px;
       }
       .calculate {
        background-color: blue;
        color : white;
        padding : 10px;
       }
    </style>
</head>

<body>
    <div class = "income_tax_div">
         <div class = "title">
            <h1>Nepalese Income Tax Calculator</h1>
         </div>
      
         <div class = "salary_form">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method ="POST">
             <div class = "assessment_info">
           <p>Assessment Info</p>
           <select name="gender" id="gender">
                <option name ="male" value="male">Male</option>
                <option name ="female" value="female">Female</option>
            </select>
            <select name="relationship" id="relationship">
                <option name = "married" value="married">Married</option>
                <option name = "unmarried" value="unmarried">UnMarried</option>
            </select>
         </div>
         <div class = "input_field">
            <div class = "monthly_salary">
                <label for="monthly_salary">Monthly Salary</label>
                <input type="number" name = "monthly_salary" value = "<?php echo htmlspecialchars($monthly_salary);?>">
                <span class = "error"><?php echo isset($error['monthly_salary']) ? $error["monthly_salary"] : "";?></span>
                </div>
                <br>
                <div class = "yearly_salary">
                <label for="yearly_salary">Annual Gross Salary</label>
                <input type="number" name = "yearly_salary" value = "<?php echo htmlspecialchars($yearly_salary);?>">
                <span class = "error"><?php echo isset($error['yearly_salary']) ? $error["yearly_salary"] : "";?></span>
            </div>
         </div>
           <div class = "output">
            <h2>        
        <?php
         if (empty($error)) {
           if (isset($_POST['gender']) == "male") {
             if (isset($_POST["relationship"]) == "married") {
                if ($yearly_salary <= 450000) {
                    $tax = (1/100)*$yearly_salary;
                    echo "Annual Income Tax : $tax";
                }
                else if ($yearly_salary > 450000 && $yearly_salary <= 550000) {
                    $tax = (1/100)*450000;
                    $overflow_income = $yearly_salary - 450000;
                    $extra_tax = $tax + (10/100)*$overflow_income;
                    echo "Annual Income Tax : $extra_tax";
                } 
                else if ($yearly_salary > 550000 && $yearly_salary <= 750000) {
                    $tax = (1/100)*450000;
                    $overflow_income = $yearly_salary - 550000;
                    $extra_tax = $tax + (10/100)*100000;
                    $extra_tax = $extra_tax + (20/100)*$overflow_income;
                    echo "Annual Income Tax : $extra_tax";
                }
                else if ($yearly_salary > 750000 && $yearly_salary <= 1300000) {
                    $tax = (1/100)*450000;
                    $overflow_income = $yearly_salary - 750000;
                    $extra_tax = $tax + (10/100)*100000;
                    $extra_tax = $extra_tax + (20/100)*200000;
                    $extra_tax = $extra_tax + (30/100)*$overflow_income;
                    echo "Annual Income Tax : $extra_tax";
                }
                else {
                    $tax = (1/100)*450000;
                    $overflow_income = $yearly_salary - 130000;
                    $extra_tax = $tax + (10/100)*100000;
                    $extra_tax = $extra_tax + (20/100)*200000;
                    $extra_tax = $extra_tax + (30/100)*550000;
                    $extra_tax = $extra_tax + (30/100)*550000;
                    $extra_tax = $extra_tax + (35/100)*$yearly_salary;
                    echo "Annual Income Tax : $extra_tax";
                } 
             }
           }
         }
         ?></h2>
           </div>
           <div class = "button">
            <input  class = "clear" type="submit" name = "clear" value= "Clear Inputs">
            <input  class = "calculate" type="submit" name = "calculate" value= "Calculate">
           </div>
             </form>
         </div>
    </div>
</body>
</html> 