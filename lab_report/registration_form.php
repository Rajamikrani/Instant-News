<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registation Form</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: rgb(217, 217, 244);
    }
        body {
        
        }
        #header {
            margin : 20px;
            padding : 10px;
            border : 1px;
        }
    </style>
</head>
<body>
    <div id = "header">Student Registation Form</div>
    <div class = "form_div">
        <form action="">
            <div id = "name">
            <label for="name">Name</label>
            <input type="text" placeholder = "Enter Full Name">
            </div>
            <div id = "father_name">
            <label for="father_name">Father Name</label>
            <input type="text">
            </div>
            <div id = "mother_name">
            <label for="mother_name">Mother Name</label>
            <input type="text">
            </div>
            <div id = "phone'>
                <label for="phone">Phone Number</label>
                <input type="phone" placeholder = "98xxxxxxxx">
            </div>
            <div id = "email">
                <label for="email">Email</label>
                <input type="email" placeholder = "sample@example.com">
            </div>
            <div id = "gender">
                <label for="gender">Gender</label>
                <div id = "gender_item">
                <input type="radio" id="gender" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="gender" name="gender" value="female">
                <label for="male">Female</label>
                <input type="radio" id="gender" name="gender" value="Other">
                <label for="male">Other</label>
                </div>
            </div>
            <div id = "date_of_birth">
                <label for="date_of_birth">Date of Birth</label>
                <input type="date">
            </div>
            <div id = "address">
                <label for="address">Address</label>
                <input type="text" placeholder = "Street - House - Road">
            </div>
            <div>
                <label for="blood_group">Blood Group</label>
                <select name="blood" id="blood">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div id = "department">
                <label for="department">Department</label>
                <div id = "department_item">
                <input type="radio" id="department" name="department" value="BCA">
                <label for="male">BCA</label>
                <input type="radio" id="department" name="department" value="BBS">
                <label for="male">BBA</label>
                <input type="radio" id="department" name="department" value="BIT">
                <label for="male">BIT</label>
                </div>
            </div>
            <div id = "course">
                <label for="course">Courses</label>
                <label for="c">C</label>
                <input type="checkbox" name="c" id="c">
                <label for="c++">C++</label>
                <input type="checkbox" name="c++" id="c++">
                <label for="java">Java</label>
                <input type="checkbox" name="java" id="java">
                <label for="machine_learning">Machine Learning</label>
                <input type="checkbox" name="machine_learning" id="machine_learning">
                <label for="ai">AI</label>
                <input type="checkbox" name="ai" id="ai">
            </div>
            <div id = "photo">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
            </div>
            <div id = "submit">
                <button id = "submit">Submit</button>
                <button id = "reset">Reset</button>
            </div>
        </form>    
    </div>
</body>
</html>