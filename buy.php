<?php

session_start();
ini_set("display_errors",0);// خطا

if(isset($_SESSION['quantity'])){

include 'admin/connect.php';
include 'include/header.php';

$bName = $_SESSION['bookName'];
$bprice = $_SESSION['price'];
$bquantity = $_SESSION['quantity'];
$qu = $_SESSION['copies'];
$id = $_SESSION['Book_id'];

$do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){

?>

<!DOCTYPE html>

<html dir="rtl">


<style>
    
.hidden{ visibility: hidden; }

</style>


<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <h2 style="text-align: center;">معلومات الدفع</h2>
     <br>
     <div style="position: relative;left: 19%;font-size: 14px;font-weight: 700;">
     <label class="col-sm-2 col-form-label">  اسم الكتاب : <span><?php echo $bName?></span></label>
     <label class="col-sm-2 col-form-label">   الكمية : <span><?php echo $bquantity?></span></label>
     <label class="col-sm-2 col-form-label">   اجمالي السعر : <span><?php echo $bprice."$"?></span></label>
</div>
<br>
     <form method="POST" action="?do=Insert"  enctype="multipart/form-data">
      <div class="form-group row">
  <label for="example-text-input" class="col-2 col-form-label">الأسم</label>
  <div class="col-10">
    <input class="form-control" name="username" required="required" type="text" value="" id="example-text-input">
  </div>
</div>
<div class="form-group row">
  <label for="example-search-input" class="col-2 col-form-label">العنوان</label>
  <div class="col-10">
    <input class="form-control" type="text" required="required" name="adress" value="" id="example-search-input">
  </div>
</div>


<div class="form-group row">
  <label for="example-tel-input" class="col-2 col-form-label">هاتف</label>
  <div class="col-10">
    <input class="form-control" required="required" type="tel" name="phone" value="" id="example-tel-input">
  </div>
</div>
<label for="example-tel-input" class="col-2 col-form-label" style="float: right;">طريقة الدفع</label>
<br><br>
<div id="rad" style="    text-align: right;    margin-right: 17%
">

<label> <input value="عند الأستلام" id="rd2" type="radio" name="buy"  >  عند الأستلام</label>

<label style="padding-right: 20px;"> <input id="rd" value="visa" type="radio" name="buy"  >فيزا</label>

<input  type="text" id="inp" class="hidden show" name="buy_visa" placeholder="ادخل رقم البطاقة" >
</div>
<br>
<div class="form-group" style="float: right;    margin-right: 7%;">

                    <div class="col-sm-10">
                    <button type="submit"  class="btn btn-primary btn-lg">ارسال</button>
                    </div>
                </div>


      </form>
    
  </main>
</div>


<?php
include "include/footer.php";
?>
<script>
    var rd = document.getElementById("rd");
    var rd2 = document.getElementById("rd2");

    var inp = document.getElementById("inp");


    rd2.onclick=function(){

inp.classList.add('hidden');
    }
    rd.onclick=function(){

inp.classList.remove('hidden');
    }
</script>

</body>
</html>


  <?php
  }
  elseif ($do == 'Insert'){

    if($_SERVER ['REQUEST_METHOD'] == 'POST'){

      echo '<div class="container"';


      $user = $_POST['username'];
      $adress = $_POST['adress'];
      $phone = $_POST['phone'];
      $Buy = $_POST['buy_visa'];




       
       
       $formEroor =array();

       if(strlen($user) < 8){
         $formEroor[]="<strong> الاسم لايقل عن 8 احرف </strong>";
       }
       if(strlen($user) >40 ){
        $formEroor[]="<strong> الاسم لايزيد عن 40 حرف </strong>";
      }
   
    if(empty($user)){
      $formEroor[]="   <strong>اسم المستخدم فارغ  </strong>";
    }
      if(empty($adress)){
        $formEroor[]="   <strong> حقل العنوان فارغ </strong>";
      }
      if(strlen($adress)<4){
        $formEroor[]="   <strong> العنوات لايقل عن 4 حروف </strong>";
      }
      if(empty($phone)){
        $formEroor[]="  <strong> رقم الهاتف فارغ </strong>";
      }
     
  

      if(empty($Buy)){
        $Buy=$_POST['buy'];
      }
      foreach($formEroor as $error){
        echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-danger'>" . $error  ."</div>";
        include 'head.php';
      }
  
    
     if(empty($formEroor)){

    

      $stmtvalid = $con->prepare("SELECT no_copies from book  where id_book =? And no_copies>0" );
      $stmtvalid->execute(array($id));
      $row = $stmtvalid->fetch();
      $countt = $stmtvalid->rowCount();
     



       if($countt > 0 ){

     $stmt = $con->prepare("INSERT INTO buy_transaction (name ,adress, phone ,quantity ,total_price, book_id ,buy_type,date) VALUES (:euser, :eadress , :ephone , :equantity ,:etotal , :ebook , :ebuy ,now())");
     $stmt->execute(array(
      'euser' => $user,
      'eadress' => $adress,
      'ephone' => $phone,
      'equantity' => $bquantity,
      'etotal' => $bprice,
      'ebook' => $id,
      'ebuy' => $Buy

      

     ));
    
     $stmt2 = $con->prepare("UPDATE book SET no_copies=? where id_book=? ");
     $stmt2->execute(array($qu-$bquantity,$id));
     echo "<div style='margin-top: 3%; text-align: center;font-size:30px;color:green;' class='alert alert-success'>". $stmt->rowCount() . 'تمت عملية الشراء بنجاح' .'</div>';


  include 'head.php';
}
else{
  echo "<div style='margin-top: 3%; text-align: center;font-size:30px;color:red;' class='alert alert-danger'>".'  لايوجد نسخ كافيه' .'</div>';
  include 'head.php';
}
    }
  }
    else{
     
      echo 'Sory You Cant Browse this page';
      
      //redirc($thMsg);
      header('Location: index.php');
    } 

  }
  
}
  else 
    echo "خطاء";
  
?>