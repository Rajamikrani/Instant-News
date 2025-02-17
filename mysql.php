<?php
error_reporting(0);
try {
    $connection = mysqli_connection('localhost'  'root' ,'' , "db_pmc_2079_web");
    $insertSql = "insert into tbl_users(name , gender , dob , country , address , mobile , password)
    value("Raja Mikrani" , "Male" ,"2050-12-12","Nepal" , 9866126928  , mm-yy-mm)";
    m
} catch (\Throwable $th) {
    //throw $th;
}
?>