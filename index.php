<!DOCTYPE html>

<html dir="rtl">
<?php

session_start();
ini_set("display_errors",0);

include 'include/header.php' ;
include 'admin/connect.php' ;

?>

<div class="wrapper bgded" style="background-image:url('images/demo/backgrounds/01.png');">
  <div id="pageintro" class="hoc clear"> 
    <article>
      <div class="overlay inspace-30 btmspace-30">
        <h2 class="heading">موقع مكتبتي</h2>
        <p>نقوم بتوفير كل الكتب وبجميع انواعها لدينا مكتبة ضخمة من الكتب التاريخية والأسلامية والقصص والشعر والرويات.. </p>
      </div>
      <footer>
        
      </footer>
    </article>
   
  </div>
</div>




<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="center btmspace-50">
      <h1 class="heading">تصفح كتبنا</h1>
     
    </div>
    
    
    <ul class="nospace group" id="aa" dir="rtl" >
    <?php


            


          $stmt = $con->prepare("SELECT book.*, categories.Cat_name AS cat_name FROM book
          INNER JOIN categories ON categories.Cat_id =book.cat_ID where statuss=1 and no_copies>0  ORDER BY id_book DESC ");      

            $stmt->execute(array( ));
          $row = $stmt->fetchAll();
          $count =$stmt->rowCount();
          if($count >0  )
          {
            
          foreach($row as  $rows)	
          {
    
  
    ?>
 
      <li class="one_third first" style="float:right; text-align: right;padding-top: 10px;">
        <article class="element">
          <figure><img src="admin/upload/book/<?php echo $rows['image_book']?>" alt="" style="height: 300px !important; width: 250px; !important">
            <figcaption><span> <?php echo $rows["views"];?> </span><a href="book-info.php?itemid=<?php echo $rows["id_book"];?>"><i class="fa fa-eye"></i></a></figcaption>
            
          </figure>
        
          <div class="excerpt">
            <h1  style="text-align:center;font-size: 1.5rem;">  <?php echo $rows['book_name'];?> </h1><br> <h2 style="text-align: center; color: black;"><?php echo "$".$rows['book_price'];?></h2 ><br>
            
            <div class="btn-group btn-group-sm">
          <button class='btn btn-primary'>  <a href="#" >  </a> <?php echo $rows['cat_name'];?></button>
        
          </div>
          <div class="btn-group btn-group-sm" style="float:left">
          <button class='btn btn-warning'  >  <a href="#" >  </a> <?php if ($rows['age_book']=="[3-5]"){echo "من 3 الى 5 سنوات";} elseif ($rows['age_book']=="[5-8]"){echo "من 5 الى 8 سنوات";} elseif ($rows['age_book']=="[12-8]"){echo "من 8 الى 12 سنوات";}else echo "+13";?></button>
          </div>
         <br><br>
          <div class="btn-group btn-group-lg" style=" display: grid;">
          <button class='btn btn-success' onclick='redirct("book-info.php?itemid=<?php echo $rows["id_book"];?>")'>شراء</button>
          </div>
            
          
          </div>
        </article>
      </li>
    

  







    
    <?php 
    } }?>
    
    </ul>
    <script>
        
        function redirct(s){               
            return window.location.href=s;
        }
    </script>

  
  
  </section>
</div>



<?php
include "include/footer.php";
?>


</body>
</html>