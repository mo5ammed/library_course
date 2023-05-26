
<?php
     include 'admin/connect.php';

     session_start();

     if($_SERVER ['REQUEST_METHOD'] == 'POST'){

        if($_POST['Quantity'] >0 &&  $_POST['Price']>0 ){
        
        $_SESSION['bookName'] = $_POST['bookname'];
        $_SESSION['price']= $_POST['Price']; 
        $_SESSION['quantity'] = $_POST['Quantity'];
        $_SESSION['copies'] = $_POST['qun'];
        $_SESSION['Book_id'] = $_POST['book_id'];



        header('Location: buy.php');
        exit();
        }
        else{
            echo "خطاء";
        }

     }
   


?>


