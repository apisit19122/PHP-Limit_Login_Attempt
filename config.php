<?php 

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'limit login';

$conn = mysqli_connect($host, $user, $password ,$dbname);

if(mysqli_connect_errno()){
    echo "failed connect Mysql". mysqli_connect_error();

}

?>