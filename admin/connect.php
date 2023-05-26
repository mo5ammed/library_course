<?php



$db = 'mysql:host=localhost;dbname=e-book';
$user = 'root';
$pass='';
$option = array(
          PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);


try{
    $con = new PDO($db , $user , $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch (PDOException $e){
    echo "Failed Connect" . $e->getMessage();
}


?>