<?php

session_start();
 if(isset($_SESSION['Username'])){
    include 'connect.php';
    include 'include/header.php';

    $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

  
if ($do == 'Manage'){

    $sort='ASC';
    $sort_array= array('ASC','DESC');
    if (isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
        $sort=$_GET['sort'];
    }
    $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort ");
    $stmt2->execute();


    $cats =$stmt2->fetchAll();

?>
     <body>
     <br><br><br><br><br><br>
    <h1 class= "text-center">إدارة الاقسام</h1>
    <div class="container cati">
    <link rel="stylesheet" href="style.css">
   
            <div class="panal panal-default " style = "margin-left: 15%;background: #211e1e7a;color: white;position: relative;right: 7%; margin-top:5%;margin-left:15%; background: #211e1e7a; color: white;">
            <div class="panal-heading" style='background: ;'>
            <div style="color: #868686;font-size: 29px;font-weight: 600;">
            <a  href="categories.php?do=Add" class="btn btn-primary">+ إضافة قسم جديد </a>
            <div style="float: left;position: absolute;left: 1%;top: 1%;">
             الترتيب
            <a style="font-weight: 800;color: #07d08f; font-size: 25px;" class="<?php if($sort='ASC '){echo 'active';}?>" href="?sort=ASC">تنازلي</a> |
            <a style="font-weight: 800;color: #07d08f; font-size: 25px;" class="<?php if($sort='DESC'){echo 'active';}?>"  href="?sort=DESC">تصاعدي</a>
           </div>
            </div>
            </div>
            <br>
            <div  class="panal-body" style= 'background: #434343; font-size: 16px;font-weight: 800;'>
            <?php
            
            foreach($cats as $cat){
                echo "<div id='q' class = 'cat' >" ;
                echo "<div id='zzz' class='hidden-buttons'>";
                     echo "<a href='categories.php?do=Edit&catid=" .$cat['Cat_id']." 'class='btn btn-xs btn-primary' style='background: #1a538d; > <i class='fa fa-edit'></i>   تعديل  </a>";
                     echo "<a href='categories.php?do=Delete&catid=" .$cat['Cat_id']." 'class='confirm btn btn-xs btn-danger' style='background: #dc3545; '> <i class='fa fa-close'></i> حذف </a>";

               
        
                     
                    
                echo "</div>";
                echo '<h3>' . $cat['Cat_name'].'</h3>';
                echo "<p>"; if($cat['Cat_desc']=='') {echo 'No Description';} else{echo $cat['Cat_desc'];}    echo "</p>";
                echo '<span>'. $cat['ordering'].'</span>';
        
                
               echo "</div>";
                echo "<hr>";
                
               
            }
         
            ?>
            
            </div>
            
            </div>
            
            </div>
           
    
   </body>
  
  <?php  
}
 
elseif($do=='Add'){ ?>
   
    <body style="background:#c9c9ca">
             <br><br><br><br><br<br>
             <br><br<br> <br><br<br>

             <h1 align = "center">اضافة تصنيف جديد</h1>
             <br><br<br> <br><br<br>
             <div class="container">
 
 
             <form method="POST" action="?do=Insert"  enctype="multipart/form-data" style="display: inline-block;color:black;position: relative;right: 9%; font-size: 25px; font-weight: 800;">
 
 
             <div class="form-group row ">
                 <label for="Username" class="col-sm-2 col-form-label">الأسم</label>
                 <div class="col-sm-10">
                   <input style=" font-family: cursive;" type="text" class="form-control"  name="name" required="required" placeholder="اسم الصنف">
                 </div>
               </div>
 
 
 
               <div class="form-group row">
                 <label for="inputEmail3" class="col-sm-2 col-form-label">الوصف</label>
                 <div class="col-sm-10">
                   <input style=" font-family: cursive;" type="textarea" name="description"  class="form-control"  placeholder="وصف التصنيف">
                 </div>
               </div>
 
 
 
             <div class="form-group row">
                 <label for="FullName" class="col-sm-2 col-form-label">الترتيب</label>
                 <div class="col-sm-10">
                   <input  style=" font-family: cursive;"  type="text" class="form-control"  name="order" placeholder=" ترتيب التصنيف">
                 </div>
               </div>
 
<br><br>
 
               <div class="form-group row">
                 <div class="col-sm-10">
                   <button type="submit" name="register" class="btn btn-primary btn-lg"> + إضافة   </button>
                 </div>
               </div>
             </form>
 
 
 
             </div>
 
 
             </body>
 
 
 
 <?php
 }
 
 elseif($do=='Insert'){
 
     if($_SERVER ['REQUEST_METHOD'] == 'POST'){
 
   
         $name = $_POST['name'];
         $desc = $_POST['description'];
         $visible = $_POST['visiblity'];
         $order = ($_POST['order']);
         
        
          
       
         $stmt = $con->prepare("INSERT INTO categories (Cat_name , Cat_desc , ordering ,Date) VALUES (:ename , :edesc , :eorder, now())");
   
        $stmt->execute(array(
         'ename' => $name,
         'edesc' => $desc,
         'eorder' => $order
      
           ));
           require_once 'head.php';
           echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;   class='alert alert-success'>". $stmt->rowCount() . 'تم اضافة التصنيف' .'</div>';
          }
         
       
       
       else{
         
         echo 'Sory You Cant Browse this page';
       } 
     }
   
 
 
 elseif($do=='Edit'){

     $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
     $stmt = $con->prepare("SELECT * FROM categories WHERE Cat_id = ? ");
     $stmt->execute(array($catid));
 
     $cat = $stmt->fetch();
     $count = $stmt->rowCount();
 
     if($stmt->rowCount()>0){?>


                            <body style="background:#c9c9ca">
             <br><br><br><br><br<br>
             <br><br<br> <br><br<br>

             <h1 align = "center"> تعديل التصنيف </h1>
             <br><br<br> <br><br<br>
             <div class="container">
 
 
             <form method="POST" action="?do=Update"   enctype="multipart/form-data" style="display: inline-block;color:black;position: relative;right: 9%; font-size: 25px; font-weight: 800;">
             <input name="catid" type="hidden" value="<?php echo $catid?>">

 
             <div class="form-group row ">
                 <label for="Username" class="col-sm-2 col-form-label">الأسم</label>
                 <div class="col-sm-10">
                   <input style=" font-family: cursive;" type="text" class="form-control" value="<?php echo $cat['Cat_name']?>" name="name" required="required" placeholder="اسم الصنف">
                 </div>
               </div>
 
 
 
               <div class="form-group row">
                 <label for="inputEmail3" class="col-sm-2 col-form-label">الوصف</label>
                 <div class="col-sm-10">
                   <input style=" font-family: cursive;" type="textarea" name="description"  class="form-control"  placeholder="وصف التصنيف" value="<?php echo $cat['Cat_desc']?>">
                 </div>
               </div>
 
 
 
             <div class="form-group row">
                 <label for="FullName" class="col-sm-2 col-form-label">الترتيب</label>
                 <div class="col-sm-10">
                   <input  style=" font-family: cursive;"  type="text" class="form-control"  name="order" placeholder=" ترتيب التصنيف" value="<?php echo $cat['ordering']?>"> 
                 </div>
               </div>
               <br><br>

 
               <div class="form-group row">
                 <div class="col-sm-10">
                   <button style="background: #ffa516;" type="submit"  class="btn btn-primary btn-lg">حفظ</button>

                 </div>
               </div>
             </form>
 
 
 
             </div>
 
 
             </body>
 
 
 
 
 <?php
 
 }else{
 echo "no sush Id";
 }
 }
 
 
 
 
 elseif($do=='Update'){
     echo '<h1 id="h1" align = "center">Updated Categorie</h1>';
     
         if($_SERVER ['REQUEST_METHOD'] == 'POST'){
 
           $id = $_POST['catid'];
           $name = $_POST['name'];
           $desc = $_POST['description'];
           $order = $_POST['order'];

          
 
           $stmt = $con->prepare("UPDATE categories SET Cat_name=?, Cat_desc=?, ordering=? where Cat_id= ? ");
           $stmt->execute(array($name,$desc,$order,$id));
           require_once 'head.php';
           echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px; class='alert alert-success'>". $stmt->rowCount() . ' تم تعديل التصنيف' .'</div>';
           
         
         }else{
           echo 'Sory You Cant Browse this page';
         }
         
 
 
 
       }
 
 elseif($do=='Delete'){
    
     echo '<h1 align = "center">Delete Categorie</h1>';
     echo ' <div class="container"> ';
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;
        
        $stmt = $con->prepare("SELECT * FROM categories WHERE Cat_id = ?   LIMIT 1");
        $stmt->execute(array($catid));
      
        $count = $stmt->rowCount();
        if($stmt->rowCount()>0){
          $stmt = $con->prepare("DELETE FROM categories WHERE Cat_id = :zid");
          $stmt->bindParam(":zid" , $catid);
          $stmt->execute();
          require_once 'head.php';
          echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px; class='alert alert-success'>". $stmt->rowCount() . ' تم حذف التصنيف' .'</div>';
  
        }
        
  echo "</div>";
 
 
 }
 
 

 
 
 
}
 
 
 else {
     header('Location : index.php');
    exit();
 }
 
 require_once 'include/footer.php' ; 
 echo '<script src="layout/js/backend.js"></script>';