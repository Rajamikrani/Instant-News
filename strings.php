<?php
// we can define string by single or double quotes
$name = "Raja";
echo "Hello $name";

echo '<br>';

// Single quoted strings does not perform such actions,
// it returns the string like it was written, with the variable name
// for ex : echo 'hello $name' it return the same not the variable value.

$newName = 'Hello '.$name;
echo $newName;
echo '<br>';
echo strlen($name);
echo '<br>';
// We can find length of String using strlen() function
echo strlen($newName);
echo '<br>';
// We can find total Word of String using str_word_count() function
$name1 = "This is a car";
echo str_word_count($name1);
echo '<br>';
$sentence = 'I am a best in all senario'.$name;
echo str_word_count($sentence);
echo '<br>';
$upper = strtoupper($sentence);
echo $upper;
echo '<br>';
$lower = strtolower($upper);
echo $lower;
echo '<br>';
echo strrev($name);
echo '<br>';
echo str_repeat($name , 2);
echo '<br>';
echo trim($name1);
echo '<br>';
$x = "Hello World";
$y = explode(" " , $x);
print_r($y);
echo '<br>';
$z = explode(" " , $sentence);
print_r($z);
echo substr($x , 3);
?>