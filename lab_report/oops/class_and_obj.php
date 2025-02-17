<?php
// Static version
// class Student {
//     function hello($name){
//         echo "Hello $name";
//     }
// }
// $raja = new Student();
// $raja->hello("Raja");

//  Make Dynamic but it is not the good practice.
// class Student {
//     var $name;
//     function greeting(){
//         echo "Oh Hello $this->name";
//     }
// }
// $raja = new Student();
// $raja->name = "Raja";
// $raja->greeting();
// echo "<br>";
// $pankaj = new Student();
// $pankaj->name = "Pankaj";
// $pankaj->greeting();

// Instead of we use it.
// class Student {
//     var $name;
//     function greeting(){
//         echo "Oh Hello $this->name";
//     }
//     function set($variable , $value){
//         $this->$variable = $value;
//     }
// }
// $raja = new Student();
// $raja->set("name","Raja");
// $raja->greeting();

// echo "<br>";

// $pankaj = new Student();
// $pankaj->set("name","Pankaj");
// $pankaj->greeting();

// If We set Multiple value we use constructor.
class Student{
    var $id , $name , $phone , $address;
    function __construct($id , $name , $phone , $address) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
    }
}
$raja = new Student('4' , 'Raja' , '9866124321' , "KTM");
print_r($raja);
echo "<br>"; 
$pankaj = new Student('4' , 'Pankaj' , '986614341' , "BKT");
print_r($pankaj);
?>