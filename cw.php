<?php
class Employee {
    protected $name;
    protected $address;

    public function __construct($name, $address) {
        $this->name = $name;
        $this->address = $address;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAddress() {
        return $this->address;
    }
}


class Permanent extends Employee {
    private $salary;
    private $post;

 
    public function __construct($name, $address, $salary, $post) {
        parent::__construct($name, $address); // Call parent constructor
        $this->salary = $salary;
        $this->post = $post;
    }

   
    public function setSalary($salary) {
        $this->salary = $salary;
    }

   
    public function setPost($post) {
        $this->post = $post;
    }

 
    public function displayAll() {
        echo "Name: " . $this->name . "\n";
        echo "Address: " . $this->address . "\n";
        echo "Salary: " . $this->salary . "\n";
        echo "Post: " . $this->post . "\n";
    }
}


$students = [];
for ($i = 1; $i <= 20; $i++) {
    $students[] = new Permanent("Student $i", "Address $i", 1000 + ($i * 10), "Post $i");
}

// Displaying details of all students
foreach ($students as $student) {
    $student->displayAll();
    echo "-----------------\n";
}
?>
