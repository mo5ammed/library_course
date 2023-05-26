<style>
.x{

    position: relative;
    right: 37%;
    top: -41px;
    width: 236%;
}
</style>

<?php
session_start();
 if(isset($_SESSION['Username'])){
    include 'connect.php';
    include 'include/header.php';
      $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){
        
        
        
        
        $stmt = $con->prepare("SELECT * FROM admins ");
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
                            <a  href="admins.php?do=Add" class="btn btn-primary" id="bu" style="color: #0695a3;font-size: 20px;font-weight: 800;"> + إضافة عضو جديد </a>
                                <h4 class="card-title" style="text-align: center; color: #0695a3;font-size: 30px;font-weight: 800;"> جدول المشرفين</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="t" class= "table table-bordered table text-center" style=" font-weight: 700; border-collapse: collapse;  border-collapse: separate; border-color: #b6b6b6;">
                                     
                                    <tr>
                                    <td>الصورة</td>
                                    <td>رقم المستخدم</td>
                                    <td>اسم المستخدم</td>
                                    <td>الأسم كاملاً</td>
                                    <td>عمليات</td>
                                    
                                </tr>
                                           
                                            <?php
                                        foreach($rows as $row){
        
                                             ?>
                                            <tr>
                                                <td>
                                               
                                             <img width=100 height=100 src ="upload/avater/<?php echo $row['image'];?>"> 
                                            </td>
                                                <td>
                                                <?php echo $row['id'];?>
                                                </td>
                                                <td>
                                                <?php echo $row['username'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['fullname'];?> 
                                                </td>
                                           
                                           
                                          
                                        <?php 
                                     echo "<td>
                                     <a href='admins.php?do=Edit&userid=" . $row['id'] . "'class='fa fa-pencil-square-o' style='font-size: 35px;margin-left: 18px;'></a>
                                     <a href='admins.php?do=Delete&userid=" . $row['id'] . "' class='fa fa-trash' style='font-size: 35px;'> </a></td> ";
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
     
    elseif($do =='Add'){
        
        ?>

  
<body >
        <br><br><br>
        <br><br><br>
        <h1 id="h1" align = "center"> إضافة مشرف جديد </h1>
        <br><br>
        <div class="container">
  
            <form method="POST" action="?do=Insert"  enctype="multipart/form-data">


        <div class="form-group row ">
            <label for="Username"  id="cc"  class="col-sm-2 col-form-label"><b>  اسم المستخدم </b></label>
            <div class="col-sm-10">
              <input   id="bb" type="text" class="form-control" name="username" required="required" id="inputEmail3" >
            </div>
          </div>



          <div class="form-group row">
            <label for="inputEmail3"  id="cc"  class="col-sm-2 col-form-label">الاسم الكامل</label>
            <div class="col-sm-10">
              <input    id="bb" type="text" required="required" name="fullname"  class="form-control" id="inputEmail3" >
            </div>
          </div>


          <div class="form-group row">
            <label for="inputPassword3"  id="cc"  class="col-sm-2 col-form-label">كلمة المرور</label>
            <div class="col-sm-10">
              <input type="password" required="required" name="pass"  id="bb"  class="form-control" id="inputPassword3">
            </div>
          </div>

      
    
      <div class="custom-file">
      <label for="BirthDate"  id="cc"  class="col-sm-2 col-form-label">الصورة</label>
     
             <input type="file"  id="bb" class="form-control x"  name="avatar"  >
             </div>
                
        

          <br><br>          <br><br>


          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" name="update" class="btn btn-primary btn-lg">اضافة</button>
            </div>
          </div>
        </form>

        </div>
     

<?php



    }elseif($do =='Insert'){

        if($_SERVER ['REQUEST_METHOD'] == 'POST'){

            echo '<div class="container"';
      
      
          
            // uplode files
            $avName = $_FILES['avatar']['name'];
            $avSize = $_FILES['avatar']['size'];
            $avTmp = $_FILES['avatar']['tmp_name'];
            $avType = $_FILES['avatar']['type'];
            
      
            $avType=array("jpeg" , "jpg" , "png" , "gif");
      
           $avEx = strtolower(end(explode('.' , $avName)));
      
           // end uplode files
      
      
            $user = $_POST['username'];
            $pass = ($_POST['pass']);
            $fullname = $_POST['fullname'];

             $hashpass=sha1($_POST['pass']);
             
             
             $formEroor =array();
      
             if(strlen($user) < 3){
               $formEroor[]=" <strong>اسم المستخدم لايقل عن 4 حروف </strong>";
             }
             if(strlen($user) >20){
              $formEroor[]=" <strong> اسم المتخدم لايزيد عن 20 حرف </strong>";
            }
         
          if(empty($user)){
            $formEroor[]="   <strong> اسم المستخدم فارغ </strong>";
          }
            if(empty($pass)){
              $formEroor[]=" <strong> يجب ادخال كلمة المرور </strong>";
            }
            if(strlen($pass)<4){
              $formEroor[]="  <strong> كلمة المرور اقل من 4 رموز </strong>";
            }
            if(empty($fullname)){
              $formEroor[]=" fullname Cant be  <strong> Empty </strong>";
            }
           
         
            if(! empty($avName) && ! in_array($avEx , $avType)){
              $formEroor[]=" Extention  <strong> Not Alowad </strong>";
            }
            if(empty($avName)){
              $formEroor[]="  <strong>  يجب اختيار صورة </strong>";
            }
             if($avSize>2000000){
              $formEroor[]="<strong> الصورة يجب ان تكون اقل من 2 ميجابايت </strong>";
             }
      
        
            foreach($formEroor as $error){
              echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-warning'>" . $error  ."</div>";
              include 'head.php';

            }
        
          
           if(empty($formEroor)){
            $avatar = rand(0,100000000) . '_' . $avName;
           move_uploaded_file($avTmp,"upload/avater/" . $avatar);
          
            $stmt = $con->prepare("INSERT INTO admins (username ,fullName, password  ,image ,GroupID,date) VALUES (:euser ,:ename, :epass  , :eavater,0 ,now())");
      
           $stmt->execute(array(
            'euser' => $user,
            'ename' => $fullname,
            'epass' => $hashpass,
            'eavater' => $avatar
      
      
           ));
          
           echo "<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-success'>". $stmt->rowCount() . ' تم الاضافة' .'</div>';
           include 'head.php';
        }
            
          }
          
          else{
           
            echo 'Sory You Cant Browse this page';
            
            //redirc($thMsg);
            header('Location: home.php');
          } 
    }
    


    elseif($do == 'Edit'){  
        
        $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
          $stmt = $con->prepare("SELECT * FROM admins WHERE id = ?   LIMIT 1");
          $stmt->execute(array($userid));

          $row = $stmt->fetch();
          $count = $stmt->rowCount();
      
          if($stmt->rowCount()>0){ ;
            ?>
        
          
           <body style="background:#c9c9ca">
        <br><br><br>    <br><br>  
        <h1 id="h1" align = "center">تعديل المستخدم </h1>
        <br>
       
        <div class="container">
        <img style="position: relative; right: 46%; height: 90px;margin-bottom: 3%; width: 90px;" src="upload/avater/<?php echo $row['image']?>" id="output">
        <style>
               #bb {background-color: #9f9f9f; border-radius: 7px; margin-right: -8%;font-size: 17px;  color: #0f0243;font-family: cursive; font-weight: 800;}


               #cc{ font-size: 20px; font-weight: 700;}

           </style>
        <form method="POST" action="?do=Update"  enctype="multipart/form-data">

        <input name="userid" type="hidden"  id="bb" value="<?php echo $userid?>">
        <input name="img" type="hidden"  id="bb" value="<?php echo $row['image']?>">


        <div class="form-group row ">
            <label for="Username"  id="cc"  class="col-sm-2 col-form-label"><b>  اسم المستخدم </b></label>
            <div class="col-sm-10">
              <input   id="bb" type="text" required="required" class="form-control" value="<?php echo $row['username']?>" name="username" required="required" id="inputEmail3" >
            </div>
          </div>



          <div class="form-group row">
            <label for="inputEmail3"  id="cc"  class="col-sm-2 col-form-label">الاسم الكامل</label>
            <div class="col-sm-10">
              <input   id="bb" type="text" required="required" required="required" name="fullname" value="<?php echo $row['fullname']?>" class="form-control" id="inputEmail3" >
            </div>
          </div>


          <div class="form-group row">
            <label for="inputPassword3"  id="cc"  class="col-sm-2 col-form-label">كلمة المرور</label>
            <div class="col-sm-10">
              <input type="hidden" name="oldpass" value="<?php echo $row['password']?>" >
              <input type="password" name="newpass"  id="bb"  class="form-control" id="inputPassword3">
            </div>
          </div>

      
    
      <div class="custom-file">
      <label for="BirthDate"  id="cc"  class="col-sm-2 col-form-label">الصورة</label>
     
             <input type="file" onchange="loadFile(event)"  id="bb" class="form-control x"  name="avater"  >
             </div>
                
        

          <br><br>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" name="update" class="btn btn-primary btn-lg">حفظ</button>
            </div>
          </div>
        </form>



        </div>

        <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    };
                
             </script>

    <?php }

            else{
                echo "<script> alert('خطاء') </script>";
            }

 
         

        }  elseif($do =='Update'){


            
    echo '<div class="container">';
    echo '<h1 align = "center">تحديث المستخدم</h1>';

    if($_SERVER ['REQUEST_METHOD'] == 'POST'){


  

      $id = $_POST['userid'];
      $user = $_POST['username'];
      $name = $_POST['fullname'];
     
    
      $image= $_FILES['avater']['name'];
      $image_tmp = $_FILES['avater']['tmp_name'];
      $img=$image;
    
      move_uploaded_file($image_tmp,"upload/avater/".$img);


      if(empty($img)){
         $img =$_POST['img'];
      }
      if($id == $_SESSION['ID']){
        $_SESSION['image']= $img;
      }
      
      $pass= empty($_POST['newpass'])? $_POST['oldpass'] : sha1($_POST['newpass']);

  

      if( $_POST['username'] == ""){
        echo "اسم المستخدم فارغ";

      }
      if(empty($name)){
      echo "الأسم الكامل  فارغ";
        
    }

    
  
      $stmt = $con->prepare("UPDATE admins SET username=?, fullname=?,password=?,image=?   where id=? ");
      $stmt->execute(array($user,$name,$pass,$img,$id));
      
      if($id==1){
      //$_SESSION['image']=$img;
      $_SESSION['Username']=$user;
      }
      require_once 'head.php';
      echo "<br><br>";
      echo "<div  style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'   class='alert alert-success'>". $stmt->rowCount() . ' تم التحديث' .'</div>';
    
    }else{
      require_once 'head.php';
      echo  'Sory You Cant Browse this page';
    }
    echo "</div>";



        }
        elseif ($do = 'Delete'){
    
            echo '<h1 align = "center">حذف المستخدم</h1>';
           echo ' <div class="container"> ';
              $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
              $stmt = $con->prepare("SELECT * FROM admins WHERE id = ?   LIMIT 1");
              $stmt->execute(array($userid));
            
              $count = $stmt->rowCount();
              if($stmt->rowCount()>0){
                $stmt = $con->prepare("DELETE FROM admins WHERE id = :euser")   ;
                $stmt->bindParam(":euser" , $userid);
                $stmt->execute();
        
        
                require_once 'head.php';
        
                echo"<div style='text-align: center; margin-left: 10%;margin-top: 7%;margin-right: 13%;font-size: 31px;'  class='alert alert-success'>". $stmt->rowCount() . ' تم الحذف بنجاح' .'</div>';
        
                //redirc($thMsg,'back');
              }
              
        echo "</div>";
            
        } 

    }
  else {
      header('Location: index.php');
      exit();
      } 
  


    ?>
 
   


















          
            
            <?php
            include 'include/footer.php';
            ?>