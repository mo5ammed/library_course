


           
    <style>
    #h1 {
    color: #fff;
}
#h1:hover {
    color: #605ca8;
    cursor: pointer
}
 #t tr:first-child td{
   background:#3c3c3c;
   color:#fff;
 }

a{
  margin : 2px;
}
.im{
  width :50px;
  height : 50px
}
#table{
  width: 84%;
    margin: auto;
    color:#FFF;
    margin-left: 17%;
}
#t tr:hover{
background:#726b6ba8;
}
#bu{
  margin-left: 17%;
  background: #393939;
}


.ordering{
  margin: auto;
    margin-top: -2%;
    margin-right: 3%;
}
#ss{
  color:#fff;
  font-size: initial;
}
.ordering{
  margin: auto;
    margin-top: -2%;
    margin-right: 3%;
}
#ss{
  color:#fff;
  font-size: initial;
}



form{
  margin-left: 17%;
  color: #fff;
}

.col-sm-2 {
color:#FFF;
}
#form-control-m{
    color: #ffffff;
    font-family: cursive;
    background: #494949ba;
    border-radius: 5px;
    width:60%;

}

#av{
    color: #f3f3f3;
    font-family: cursive;
    background: #3a3763;
}
strong{
   background:red
}

}

</style>

<?php

session_start();

ini_set("display_errors",0);

    if(isset($_SESSION['Username'])){
        include 'connect.php';

        include 'include/header.php';
 
      $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';




if ($do == 'Manage'){
   

    $sort='DESC';
    $sort_array= array('ASC','DESC');
    if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
        $sort=$_GET['sort'];
    }
        
        $stmt = $con->prepare("SELECT book.*, categories.Cat_name AS cat_name FROM book
        INNER JOIN categories ON categories.Cat_id =book.cat_ID
        ORDER BY id_book $sort");
        $stmt->execute();
    
        $rows =$stmt->fetchAll();
      
      ?>
     
    

     <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="background:#d7d7d7">
                            <div class="card-header">   

                                <input type ="text" id="in" style="float: left;margin-top:10px; background: #cac8c8;; height: 36px; border-radius: 8px;font-size: 20px;  font-weight: 700;"  placeholder="بحث">
                            <a  href="book.php?do=Add" class="btn btn-primary" id="bu" style="color: #0695a3;font-size: 20px;font-weight: 800;"> + إضافة كتاب جديد </a>

                                <h4 class="card-title" style="text-align: center; color: #0695a3;font-size: 30px;font-weight: 800;"> جدول الكتب</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="t" class= "table table-bordered table text-center" style=" font-weight: 700; border-collapse: collapse;  border-collapse: separate; border-color: #b6b6b6;">
                                     
                                    <tr>
                                    <td>الصورة</td>
                                    <td>رقم الكتاب</td>
                                    <td>اسم الكتاب</td>
                                    <td> سعر الكتاب</td>
                                    <td>المؤلف</td>
                                    <td> دار النشر</td>
                                    <td>عدد النسخ </td>
                                    <td> اللغة</td>
                                    <td>العمر</td>
                                    <td>التصنيف </td>
                                    <td> الوصف</td>
                                    <td> التاريخ</td>
                                    <td>عمليات</td>
                                    
                                </tr>
                                           
                                            <?php
                                        foreach($rows as $row){
        
                                             ?>
                                            <tr>
                                                <td>
                                               
                                             <img width=100 height=100 src ="upload/book/<?php echo $row['image_book'];?>"> 
                                            </td>
                                                <td>
                                                <?php echo $row['id_book'];?>
                                                </td>
                                                <td>
                                                <?php echo $row['book_name'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['book_price'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['book_aouther'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['pub_house'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['no_copies'];?> 
                                                </td>
                                                <td >
                                                <?php if ($row['lang_book']=="en"){echo "English";} elseif($row['lang_book']=="ar"){echo "عربي";}?> 
                                                </td>
                                                <td >
                                                <?php echo $row['age_book']."   سنة"?> 
                                                </td>
                                                <td >
                                                <?php echo $row['cat_name'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['desc_book'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['date'];?> 
                                                </td>
                                           
                                           
                                          
                                        <?php 
                                     echo "<td>
                                     <a href='book.php?do=Edit&itemid=" . $row['id_book'] . "'class='fa fa-pencil-square-o' style='font-size: 35px;margin-left: 18px;'></a>
                                     <a href='book.php?do=Delete&itemid=" . $row['id_book'] . "' class='fa fa-trash' style='font-size: 35px;'> </a>";
                                            if($row['statuss'] == 1){
                                              echo " <a href='book.php?do=inActive&itemid=" . $row['id_book'] . "'class='fa fa-eye-slash' style='font-size: 35px;margin-left: 18px;'></a>";
                                            }
                                            if($row['statuss'] == 0){
                                                echo " <a href='book.php?do=Active&itemid=" . $row['id_book'] . "'class='fa fa-eye' style='font-size: 35px;margin-left: 18px;'></a>";
                                              }

                                     echo "</td>";
                                    } ?>
                                            </tr>
                                      
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div> 
         
    
           
            <?php
            }


elseif($do=='Add'){?>
   
   <style>
   .col-form-label{ position: relative;
    right: 4%;
    font-size: 24px;
    font-weight: 700;
   }
   </style>
    <br><br><br>    <br><br><br>

    <h1 id="h1" align = "center">إضافة كتاب جديد</h1>
    <br>
    <div class="container">

    <form method="POST" action="?do=Insert"  style="font-size: 23px;"enctype="multipart/form-data">
    <img src="a.jpg" width=400 height=573 id="output" style="position: absolute; left: 2%;border: 3px solid #E3E3E3;">


                <div class="form-group row ">
                    <label for="" class="col-sm-2 col-form-label">الأسم</label>
                    <div class="col-sm-10">
                    <input id="form-control-m" required="required" type="text" class="form-control"  name="name"  placeholder="اسم الكتاب">
                    </div>
                </div>

                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">السعر</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="required" type="text" class="form-control"  name="price"  placeholder="سعر الكتاب">
                    </div>
                </div>

                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">المؤلف</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="required" type="text" class="form-control"  name="aouther"  placeholder="اسم المؤلف">
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">دار النشر</label>
                    <div class="col-sm-10">
                    <input id="form-control-m" required="required" type="textarea" class="form-control"  name="house"  placeholder="دار النشر">
                    </div>
                </div>

               


                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">عدد النسخ</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="required" type="text" class="form-control"  name="copies"  placeholder="عدد نسخ الكتاب">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">اللغة</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;" class="form-control" name="lang">
                    
                    <option value = "ar">عربي</option>
                    <option value = "en">English</option>
   
                 </select>
                    </div>
                </div>

                
                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">العمر</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;" class="form-control" name="age">
                    <option value = "[3-5]">من 3 الى 5 سنوات</option>
                    <option value = "[5-8]">من 5 الى 8 سنوات</option>
                    <option value = "[8-12]">من 8 الى 12 سنوات</option>
                    <option value = "[+13]">13+</option>
   
                 </select>
                    </div>
                </div>



                

               

                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">التصنيف</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;"  class="form-control" name="categorie">
                    <option value = "0">......</option>
                    <?php
                     $stmt2 = $con->prepare("SELECT * FROM categories");
                     $stmt2->execute();
                     $cats=$stmt2->fetchAll();
                     foreach($cats as $cat){
                         echo "<option value='".$cat['Cat_id']."'>".$cat['Cat_name']."</option>";
                     }                    
                    ?>
             
           </select>
                    </div>
                </div>


                

              <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">الوصف</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="required" type="text" class="form-control"  name="desc"  placeholder="وصف الكتاب">
                    </div>
                </div>

                <div class="custom-file">
                <label class="col-sm-2 col-form-label"> صورة</label>
                <input accept="image/*" onchange="loadFile(event)"  style="position: relative; right: 10%; width: 79%;" type="file" id="form-control-m"   name="avatar"  >
   
                
              </div>
                <br><br>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit"  class="btn btn-primary btn-lg"> + اضافة  </button>
                    </div>
                </div>
                </form>

                </div>
                </body>

                <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    };
                
             </script>

<?php
}





  elseif($do=='Insert'){

            echo '<div class="container"';
            echo "<h1>"." Insert book"." </h1>";

            // uplode files
            $avName = $_FILES['avatar']['name'];
            $avSize = $_FILES['avatar']['size'];
            $avTmp = $_FILES['avatar']['tmp_name'];
            $avType = $_FILES['avatar']['type'];
            

            $avType=array("jpeg" , "jpg" , "png" , "gif");

        $avEx = strtolower(end(explode('.' , $avName)));

        // end uplode files


            $name = ($_POST['name']);
            $price = ($_POST['price']);
            $aouther = ($_POST['aouther']);
            $house = ($_POST['house']);
            $copies = ($_POST['copies']);
            $lang = ($_POST['lang']);
            $age = ($_POST['age']);
            $catt = ($_POST['categorie']);
            $description =($_POST['desc']);
           
           

            
           
            
             $formEroor =array();

                    if(empty($name)){
                    $formEroor[]="  <strong> الاسم فارغ </strong>";
                    }
                    if(strlen($name)>55){
                      $formEroor[]="  <strong> الاسم طويل </strong>";
                      }
                    if(empty($description)){
                    $formEroor[]="   <strong> الوصف الفارغ </strong>";
                    }
                    if(strlen($description)>95){
                      $formEroor[]="   <strong> الوصف طويل </strong>";
                      }
                    if(empty($price)){
                    $formEroor[]="  <strong> السعر فارغ </strong>";
                    }

                    
                          if($catt==0){
                            $formEroor[]="  <strong> يجب اختيار تصنيف </strong>";
                         }
                
                
                    if(! empty($avName) && ! in_array($avEx , $avType)){
                    $formEroor[]="   <strong> خطاء في الصورة </strong>";
                    }
                    if(empty($avName)){
                    $formEroor[]="   <strong> خطاء في الصورة </strong>";
                    }
                    if($avSize>4194304){
                    $formEroor[]=" <strong> 4MB حجم الصورة كبير</strong>";
                    }


            foreach($formEroor as $error){
            echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-danger'>" . $error  ."</div>";
            include 'head.php';

            }

        
            if(empty($formEroor)){
            // end valdite
            $avatar = rand(0,1000000) . '_' . $avName;
            move_uploaded_file($avTmp,"upload\book\\" . $avatar);
        
            $stmt = $con->prepare("INSERT INTO book (book_name , book_price ,book_aouther, pub_house,no_copies,desc_book,lang_book,age_book,image_book,cat_ID,statuss,date) VALUES (:bname , :bprice , :baouther , :bhouse , :bcopies ,  :bdesc , :blang , :bage , :bimage , :bcat , 1 , now() )");

        $stmt->execute(array(
            'bname' => $name,
            'bprice' => $price,
            'baouther' => $aouther,
            'bhouse' => $house,
            'bcopies' => $copies,
            'bdesc' => $description,
            'blang' => $lang,
            'bage' => $age,            
            'bimage' => $avatar,
            'bcat' => $catt



        ));
        include 'head.php';
        echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;' class='alert alert-success'>". $stmt->rowCount() . ' تم إضافة الكتاب' .'</div>';
        
        }
            
    
    
      
        

    

   
    }



    
    
elseif($do=='Edit'){
    $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
          $stmt = $con->prepare("SELECT * FROM book WHERE id_book = ?");
          $stmt->execute(array($itemid));

          $item = $stmt->fetch();
          $count = $stmt->rowCount();
          if($stmt->rowCount()>0){?>
            

            




            <style>
   .col-form-label{ position: relative;
    right: 4%;
    font-size: 24px;
    font-weight: 700;
   }
   </style>
    <br><br><br>    <br><br><br>

    <h1 id="h1" align = "center">تعديل الكتاب </h1>
    <br>
    <div class="container">

    <form method="POST" action="?do=Update" style="font-size: 22px;"  enctype="multipart/form-data">

    <input name="itemid" type="hidden" value="<?php echo $itemid?>">  
    <input name="img" type="hidden"  id="bb" value="<?php echo $item['image_book']?>">


    <img src="upload/book/<?php echo $item['image_book']?>" width=400 height=573 id="output" style="position: absolute; left: 2%;border: 3px solid #E3E3E3;">


                <div class="form-group row ">
                    <label for="" class="col-sm-2 col-form-label">الأسم</label>
                    <div class="col-sm-10">
                    <input id="form-control-m"  required="required" type="text" class="form-control"  name="name"  placeholder="اسم الكتاب" value="<?php echo $item['book_name']?>">
                    </div>
                </div>

                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">السعر</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" type="text" required="required" class="form-control"  name="price"  placeholder="سعر الكتاب" value="<?php echo $item['book_price']?>">
                    </div>
                </div>

                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">المؤلف</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="required" type="text" class="form-control"  name="aouther"  placeholder="اسم المؤلف" value="<?php echo $item['book_aouther']?>">
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">دار النشر</label>
                    <div class="col-sm-10">
                    <input id="form-control-m" required="required" type="textarea" class="form-control"  name="house"  placeholder="دار النشر" value="<?php echo $item['pub_house']?>">
                    </div>
                </div>

               


                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">عدد النسخ</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="مطلوب" type="text" class="form-control"  name="copies"  placeholder="عدد نسخ الكتاب" value="<?php echo $item['no_copies']?>">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">اللغة</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;" class="form-control" name="lang">
                    
                        <option value="ar" <?php if ($item['lang_book']=="ar") {echo 'selected' ;}?>>عربي</option>;
                        <option value="en" <?php if ($item['lang_book']=="en") {echo 'selected' ;}?>>English</option>;

                 </select>
                    </div>
                </div>

                
                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">العمر</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;" class="form-control" name="age">
                        
                         <option value="[3-5]" <?php if ($item['age_book']=="[3-5]") {echo 'selected' ;}?>> من 3 الى 5 سنوات</option>;
                         <option value="[5-8]" <?php if ($item['age_book']=="[5-8]") {echo 'selected' ;}?>> من 5 الى 8 سنوات</option>;
                         <option value="[8-12]" <?php if ($item['age_book']=="[8-12]") {echo 'selected' ;}?>> من 8 الى 12 سنوات</option>;
                         <option value="[+13]" <?php if ($item['age_book']=="[+13]") {echo 'selected' ;}?>>  +13 </option>;


   
                 </select>
                    </div>
                </div>



                

               

                <div class="form-group row ">
                    <label class="col-sm-2 col-form-label">التصنيف</label>
                    <div class="col-sm-10">
                    <select id="form-control-m" style="height: 48px;"  class="form-control" name="categorie">
                       <?php
                     $stmt2 = $con->prepare("SELECT * FROM categories");
                     $stmt2->execute();
                     $cats=$stmt2->fetchAll();
                     foreach($cats as $cat){
                         echo "<option value='".$cat['Cat_id']."'"; if ($item['cat_ID']==$cat['Cat_id']) {echo 'selected' ;} echo">".$cat['Cat_name']."</option>";
                     }                    
                    ?>
             
           </select>
                    </div>
                </div>


                

              <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">الوصف</label>
                    <div class="col-sm-10">
                    <input  id="form-control-m" required="مطلوب" type="text" class="form-control"  name="desc"  placeholder="وصف الكتاب" value="<?php echo $item['desc_book']?>">
                    </div>
                </div>

                <div class="custom-file">
                <label class="col-sm-2 col-form-label"> صورة</label>
                <input accept="image/*" onchange="loadFile(event)"  style="position: relative; right: 10%; width: 79%;" type="file" id="form-control-m"   name="avatar"  >
   
                
              </div>
                <br><br>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit"  class="btn btn-primary btn-lg"> حفظ </button>
                    </div>
                </div>
                </form>

                </div>
                </body>

                <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    };
                
             </script>




                <?php

             


  
          }
        else{
            echo "لايوجد ID";
        }

        }



elseif($do=='Update'){
    
  echo '<div class="container">';
    echo '<h1 align = "center">Update Item</h1>';

    if($_SERVER ['REQUEST_METHOD'] == 'POST'){

      $id = $_POST['itemid'];
      $name = ($_POST['name']);
      $price = ($_POST['price']);
      $aouther = ($_POST['aouther']);
      $house = ($_POST['house']);
      $copies = ($_POST['copies']);
      $lang = ($_POST['lang']);
      $age = ($_POST['age']);
      $catt = ($_POST['categorie']);
      $description =($_POST['desc']);
     

      $image= $_FILES['avatar']['name'];
      $image_tmp = $_FILES['avatar']['tmp_name'];
      $img=$image;
      move_uploaded_file($image_tmp,"upload/book/$img");

      if(empty($img)){
        $img =$_POST['img'];
     }
      $stmt = $con->prepare("UPDATE book SET book_name=? , book_price=? , book_aouther=? , pub_house=? , no_copies=? , desc_book=? , lang_book=? , age_book=? , image_book=? , cat_ID= ? where id_book=? ");
      $stmt->execute(array($name,$price,$aouther,$house,$copies,$description,$lang,$age,$img,$catt,$id));
      require_once 'head.php';
    echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-success'>". $stmt->rowCount() . ' تم تحديث الكتاب' .'</div>';
      
    
    }else{
        require_once 'head.php';
      echo 'Sory You Cant Browse this page';
      header('Location: index.php');

    }
    echo "</div>";
}





elseif($do=='Delete'){

    echo '<h1 align = "center">تم الحذف </h1>';
   echo ' <div class="container"> ';

      $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

      $stmt = $con->prepare("SELECT * FROM book WHERE id_book = ?   LIMIT 1");

      $stmt->execute(array($itemid));

      $count = $stmt->rowCount();

      if($stmt->rowCount()>0){
        $stmt = $con->prepare("DELETE FROM book WHERE id_book = :eid")   ;
        $stmt->bindParam(":eid" , $itemid);
        $stmt->execute();
        require_once 'head.php';
        echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-success'>". $stmt->rowCount() . ' تم الحذف' .'</div>';

      }else{
        require_once 'head.php';
          echo "No Such ID";
      }
      
echo "</div>";
}



elseif($do=='inActive'){
    echo '<h1 align = "center">Activate Item</h1>';
    echo ' <div class="container"> ';
       $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
       $stmt = $con->prepare("SELECT * FROM book WHERE id_book = ? ");
       $stmt->execute(array($itemid));
     
       $count = $stmt->rowCount();
       if($stmt->rowCount()>0){
         $stmt = $con->prepare("UPDATE  book SET statuss =0 WHERE id_book = ?") ;
        
         $stmt->execute(array($itemid));
         require_once 'head.php';
         echo "<div  style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;' class='alert alert-success'>". $stmt->rowCount() . ' تم الغاء التفعيل ' .'</div>';
  
       }
  echo "</div>";
  
}

elseif($do=='Active'){
    echo '<h1 align = "center">Activate Item</h1>';
    echo ' <div class="container"> ';
       $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
       $stmt = $con->prepare("SELECT * FROM book WHERE id_book = ? ");
       $stmt->execute(array($itemid));
     
       $count = $stmt->rowCount();
       if($stmt->rowCount()>0){
         $stmt = $con->prepare("UPDATE  book SET statuss=1 WHERE id_book = ?") ;
        
         $stmt->execute(array($itemid));
         require_once 'head.php';
         echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;' class='alert alert-success'>". $stmt->rowCount() . '  تم التفعيل' .'</div>';
  
       }
  echo "</div>";
  
}



}




else {
   echo "erooor";
}


include 'include/footer.php';