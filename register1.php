<?php
//$host = 'localhost';  // Host name
//$dbname = 'car';   // Database name
$username = 'root';   // Database username
$password = '';       // Database password
$dbname = 'co_project2';
//اسم قاعدة البيانات وربطها
$database = new PDO("mysql:host=localhost; dbname=co_project2;charset=utf8;",$username,$password);

//نتاكد من اتصال القاعدة
if($database){
echo "done"; 
}
?>
