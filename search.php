<?php

session_start();
ini_set("display_errors",0);

include 'include/header.php' ;
include 'admin/connect.php' ;

?>

<!DOCTYPE html>

<html>


<form method="post">
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <h2 style="text-align: center;">صفحة البحث</h2>
      <div class="form-group row ">
     
     
          
           <button class='btn btn-primary' type="submit" name="submit" style="float: right; width: 100px;height: 34px;margin-right: 5px;">بحث</button>
<br><br>
                    
      <input style="text-align: right; width: 69%;" type="text" class="form-control"  name="search"  placeholder="اكتب للبحث">
      
      <div class="col-sm-2" style="display: flex;">
    

                   <select class="form-control"  name="age">
                    <option value="0" >اختياري</option>
                    <option value = "[3-5]">من 3 الى 5 سنوات</option>
                    <option value = "[5-8]">من 5 الى 8 سنوات</option>
                    <option value = "[8-12]">من 8 الى 12 سنوات</option>
                    <option value = "[+13]">13+</option>
           </select>
      <h4 style="    margin-left: 3px;"> العمر </h4>

           </div>

                    <div class="col-sm-10">
                  
                    </div>
                </div>

    
    <div class="clear"></div>
  </main>
</div>

</form>



<ul class="nospace group" id="aa" dir="rtl" >
    <?php



          if (isset($_POST["submit"])) {
     
            $search = $_POST["search"];
            $age = ($_POST['age']);
            $query = "SELECT book.*, categories.Cat_name AS cat_name FROM book
            INNER JOIN categories ON categories.Cat_id =book.cat_ID
             where age_book = '$age' and book_name like '%".$search."%' and statuss=1 and no_copies>0 limt 1 ";

            
            if(empty($search)){
            $query="SELECT book.*, categories.Cat_name AS cat_name FROM book
            INNER JOIN categories ON categories.Cat_id =book.cat_ID
             where age_book = '$age'  and statuss=1 and no_copies>0  ";

             }
             elseif(empty($age)){
                $query ="SELECT book.*, categories.Cat_name AS cat_name FROM book
                INNER JOIN categories ON categories.Cat_id =book.cat_ID
                 where book_name like '%".$search."%'  and statuss=1 and no_copies>0 ";

             }
             else{
               $query = $query;
             }

          $stmt = $con->prepare($query);      

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
          <figure><img src="admin/upload/book/<?php echo $rows['image_book']?>" alt="" style="height: 300px; width: 250px;">
            <figcaption><a href="book-info.php?itemid=<?php echo $rows["id_book"];?>"><i class="fa fa-eye"></i></a></figcaption>
          </figure>
        
          <div class="excerpt">
            <h1  style="text-align:center;font-size: 1.5rem;">  <?php echo $rows['book_name'];?> </h1><br> <h2 style="text-align: center; color: black;"><?php echo $rows['book_price']."$";?></h2 ><br>
            
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
    } 
  }
  else{
    echo "<div style='margin-top: 3%; text-align: center;font-size:30px;color:black;' class='alert alert-success'>". '   لايوجد كتاب مطابق' .'</div>';
  }
  }
    ?>
    <script>
        
        function redirct(s){               
            return window.location.href=s;
        }
    </script>
    </ul>

<?php
include "include/footer.php";
?>

</body>
</html>