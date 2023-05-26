<?php
session_start();
 if(isset($_SESSION['Username'])){
    include 'connect.php';
    include 'include/header.php';
    $do= isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){
        
        
        $stmt = $con->prepare("SELECT buy_transaction.*, book.book_name AS b_name FROM buy_transaction
        INNER JOIN book ON book.id_book = buy_transaction.book_id order by buy_id DESC
        ");


        
      //  $stmt = $con->prepare("SELECT * FROM buy_transaction ");
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

                                <h4 class="card-title" style="text-align: right; color: #0695a3;font-size: 30px;font-weight: 800;"> جدول المشتريات</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="t" class= "table table-bordered table text-center" style=" font-weight: 700; border-collapse: collapse;  border-collapse: separate; border-color: #b6b6b6;">
                                     
                                    <tr>
                                    <td>رقم العملية</td>
                                    <td> الأسم</td>
                                    <td>العنوان </td>
                                    <td> رقم العميل</td>
                                    <td> الكمية</td>
                                    <td> اسم الكتاب</td>
                                    <td>  اجمالي المبلغ</td>
                                    <td> طريقة البيع</td>

                                    <td>  التاريخ</td>

                                    <td>عمليات</td>
                                    
                                </tr>
                                           
                                            <?php
                                        foreach($rows as $row){
        
                                             ?>
                                            <tr>
                                                
                                               
                                            </td>
                                                <td>
                                                <?php echo $row['buy_id'];?>
                                                </td>
                                                <td>
                                                <?php echo $row['name'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['adress'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['phone'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['quantity'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['b_name'];?> 
                                                </td>
                                                <td >
                                                <?php echo "$".$row['total_price'];?> 
                                                </td>
                                                <td >
                                                <?php  if(is_numeric($row['buy_type'])){ echo  "فيزا : " . $row['buy_type'];}else echo $row['buy_type'];?> 
                                                </td>
                                                <td >
                                                <?php echo $row['date'];?> 
                                                </td>
                                           
                                           
                                          
                                        <?php 
                                     echo "<td>
                                     <a href='buy.php?do=Delete&buyid=" . $row['buy_id'] . "' class='fa fa-trash' style='font-size: 35px;'> </a></td> ";
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
     
        elseif ($do = 'Delete'){
    
            echo '<h1 align = "center">حذف المستخدم</h1>';
           echo ' <div class="container"> ';
              $buyid=isset($_GET['buyid']) && is_numeric($_GET['buyid']) ? intval($_GET['buyid']) : 0;
              $stmt = $con->prepare("SELECT * FROM buy_transaction WHERE buy_id = ?   LIMIT 1");
              $stmt->execute(array($buyid));
            
              $count = $stmt->rowCount();
              if($stmt->rowCount()>0){
                $stmt = $con->prepare("DELETE FROM buy_transaction WHERE buy_id = :ebuy")   ;
                $stmt->bindParam(":ebuy" , $buyid);
                $stmt->execute();
        
        
                require_once 'head.php';
        
                echo"<div align='center' style='margin-left: 13%;margin-top: 7%' class='alert alert-success'>". $stmt->rowCount() . ' تم الحذف بنجاح' .'</div>';
        
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