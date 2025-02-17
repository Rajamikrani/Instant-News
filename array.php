<?php
// $age = array("Ayan" => 12 , "Raja" => 20 , "Alam" => 45);
// echo $age["Ayan"].'<br>';
// echo $age["Raja"].'<br>';
// echo $age["Alam"].'<br>';
// print_r($age);
// for ($i=0; $i < 3; $i++) { 
//     echo $age[$i].'<br>';
// }
// echo $age[1];
// echo $age[2];
// Using forEach loop in Array
// $age = array("Ayan" => 12 , "Raja" => 20 , "Alam" => 45);
// foreach($age as $key => $value) {
//     echo "$key = $value";
// }
// Using Multi-Dimensional Array
// $emp = [
//     [1 , "Raja" , "CEO" , "4000"] ,
//     [2 , "Pankaj" , "Computer Operator" , "4000"] ,
//     [3 , "Danish" , "Pilot" , "1000"] ,
//     [4 , "Arsalan" , "President" , "4000"] 
// ];

// for ($row=0; $row < 4; $row++) { 
//     for ($col=0; $col < 4; $col++) { 
//         echo $emp[$row][$col]." ";
//     }
//     echo '<br>';
// }
// echo "<pre>";
// print_r($emp);
// echo "</pre>";
//Using foreach in multi dimensional array
// echo "<table border = 1>";
// foreach ($emp as $v1) {
//     echo "<tr>";
//     foreach ($v1 as $v2) {
//         echo "<td> $v2 </td>";
//     }
//     echo "</tr>";
// }
// echo "</table>";

// Using Multi Dimensional Array with Assosiative Array
// $marks = [
//     "krishna" => ["Physics" => 78 , "Math" => 87 , "Economics" => 98] ,
//     "Aman" => ["Physics" => 78 , "Math" => 87 , "Economics" => 98] ,
//     "Ayan" => ["Physics" => 78 , "Math" => 87 , "Economics" => 98] 
// ];
// foreach ($marks as $key => $v1) {
//     echo $key;
//     foreach ($v1 as $v2) {
//         echo $v2." ";
//     }
// }
// echo "<pre>";
// print_r($marks);
// echo "</pre>";
// Using list in the Array
// foreach ($marks as list("id" => $id ,"name" => $name ,"Deg" => $deg , "salary" => $salary)) {
// }
// $food = [
//     "fruits" => ["Orange" , "Mango" , "Apple" , "Papaya"] ,
//     "vegie" => ["potato", "Carrot" , "Peas" , "Birnjal"] 
// ];
// echo count($food);
// ?>

<?php
echo 'Current PHP version: ' . phpversion();
?>
