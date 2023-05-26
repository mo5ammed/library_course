
<?php

function countItems($item , $table){

    global $con;
    $stmt2=$con->prepare("SELECT COUNT($item) FROM $table");
    $stmt2->execute();
    return $stmt2->fetchColumn();

}
session_start();
if(isset($_SESSION['Username'])){
    include 'connect.php';

    include 'include/header.php';

 

}else{
    echo "you can`t view this page";
    header('Location: index.php');

}


?>

<style>
.card-chart:hover{ cursor:pointer}

</style>
    
<div class="panel-header panel-header-lg">
            </div>
            <div class="content">
                <div class="row" style="    position: relative;bottom: 214px;">
                    <div class="col-lg-4">
                        <div class="card card-chart" onclick="redirct('admins.php')" id="book" style=" height: 70%; background: #03A9F4;color: aliceblue;">
                            <div class="card-header">

                                <h4 class="card-title"> المشرفين</h4>
                                <div class="dropdown">
                                  
                                </div>
                            </div>
                            <div class="card-body" style="text-align: center;">
                           <h2 > <?php  echo countItems("id" , "admins" )?></h2>
                           
                           <i class="fa fa-users" style="font-size: 100px;"></i>

                                <div class="chart-area">
                                    <canvas id="lineChartExample"> </canvas>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart"  onclick="redirct('book.php')" style=" height: 70%; background: #ff5722;color: aliceblue;">
                            <div class="card-header">
                                <h4 class="card-title">جميع الكتب</h4>
                                <div class="dropdown">
                                   
                                    
                                </div>
                            </div>
                            <div class="card-body" style="text-align: center;">
                            <h2 > <?php  echo countItems("id_book" , "book" )?></h2>
                           
                           <i class="fa fa-book" style="font-size: 100px;"></i>

                                <div class="chart-area">
                                    <canvas id="lineChartExampleWithNumbersAndGrid"></canvas>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-chart" onclick="redirct('buy.php')" style=" height: 70%; background: #8bc34a;color: aliceblue;">
                            <div class="card-header">
                                <h4 class="card-title">عمليات الشراء </h4>
                            </div>
                            <div class="card-body" style="text-align: center;">
                            <h2 > <?php  echo countItems("buy_id" , "buy_transaction" )?></h2>
                           
                           <i class="fa fa-shopping-cart" style="font-size: 100px;"></i>
                                <div class="chart-area">
                                    <canvas id="barChartSimpleGradientsNumbers"></canvas>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
             
            </div>
            <script>
            
            
      
                            function redirct(s){
                    

                    return window.location.href=s;
                }


                            
                       
                        
                        
           

            
            </script>
       
           <?php
           include 'include/footer.php'
           ?>