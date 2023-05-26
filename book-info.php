
<?php

session_start();

include 'admin/connect.php' ;

$itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
$stmt = $con->prepare("SELECT * FROM book WHERE id_book = ?");
$stmt->execute(array($itemid));

$item = $stmt->fetch();
$count = $stmt->rowCount();
if($stmt->rowCount()>0){

  // for count views

$stmtNiews = $con->prepare("UPDATE book set views = views +1 where id_book = ?");
$stmtNiews->execute(array($itemid));

?>

<!DOCTYPE html>

<html>

<?php
include 'include/header.php' ;
?>
<style>
 #b {    float: right;
    text-align: center;}
    p {font-size:35px}

</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
        
        <div id="b">
        <img style="width:490px; height:570px" src="admin/upload/book/<?php echo $item['image_book'];?>">
    <h1><?php echo $item['book_name'];?></h1>
   
<hr>
<h2 style="float:right">:وصف</h2>
<br><br>
<p style="font-size: 20px;float:right"><?php echo $item['desc_book'];?></p>

</div>
<form align="center" method="POST" action="buy_setting.php"  enctype="multipart/form-data">

   <div id="infom" dir="rtl"  <?php if($item['lang_book']=="en"){echo 'style="float : right;  margin-right:30px;    float: left;"';}else{echo  'style="float : left "';}?>>
   <div style="font-size: 35px;font-weight: 700;">
   <label id="price"  style="color: #e77a0a;"> <?php echo $item['book_price'];?> </label></span>$</span>
   </div>
<br>
<p id="s">رقم الكتاب  : <b><?php echo $item['id_book'];?></b> </p>
<br>
<input name="book_id"  type="hidden"  value="<?php echo $item['id_book'];?>">
<input name="bookname" required="required" type="hidden"  value="<?php echo $item['book_name'];?>">
<input name="Price" required="required" id="pric" type="hidden"  value="<?php echo $item['book_price'];?>">
<input name="qun"  id="pric" type="hidden"  value="<?php echo $item['no_copies'];?>">



<p id="s">إسم المؤلف  : <b ><?php echo $item['book_aouther'];?></b> </p>
<br>

<p id="s">تاريخ النشر  :<b><?php echo $item['date'];?></b> </p>
<br>

<p id="s">دار النشر  :  <b><?php echo $item['pub_house'];?></b> </p>
<br>

<p id="s">العمر   :     <b><?php echo $item['age_book']."سنة";?></b> </p>
<br>
<div class="form-group row">
  <label style="font-size: 21px;font-weight: 700;">الكمية</label>
  <div class="col-10">
    <input class="form-control" required="required" name="Quantity" type="number" max="<?php echo $item['no_copies']?>" min="1" value="1" id="in_p">
  </div>
  <div class="btn-group btn-group-lg" style="margin-top: 22px; margin-right: 34%;">
               
        <button type="submit"  class="btn btn-success" style="width:170px">شراء </button>
                    
                </div>

</div>
</form>
  </main>
</div>

<script>
     var pr = document.getElementById("price");
     var prr = document.getElementById("pric");

   var   i = document.getElementById("in_p");
   var x = pr.innerHTML;
      i.onclick = function (){
 pr.innerHTML = x * i.value ;
 prr.value = x * i.value ;

   }

   
        
        // function redirct(s){               
        //     return window.location.href=s;
        // }
    
   

</script>
<?php
include "include/footer.php";
?>


</body>
</html>

<?php
}

else{
echo "لا يوجد كتاب ";
}

?>