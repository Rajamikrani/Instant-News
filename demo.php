<?php
try{
    $connection = mysqli_connect('localhost','root','');
    $insertsql = "insert into tbl_users(name,gender,dob,country,address,mobile,password) 
    values ('$Title','$Code','$Author','$Price','$Pages','$Stock')";
    mysqli_query($connection,$insertsql);
    if($connection->affected_rows== 1 && $connection->insert_id > 0){
        echo 'Record insert success';
    } else {
        echo "Record Insert Failed";
    }
}catch(Exception $ex){
    echo "Database Error: " . $ex->getMessage();
}
?>