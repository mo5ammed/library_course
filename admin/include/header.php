
<?php


//include 'connect.php'; ?>
<!DOCTYPE html>
<style>

</style>
<html lang="ar" >

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>لوحة التحكم</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <link href="assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />
    
    <style>
               #bb {background-color: #e8f0fe  !important; border-radius: 7px; margin-right: -8%;font-size: 17px;  color: #0f0243;font-family: cursive; font-weight: 800;}


               #cc{ font-size: 20px; font-weight: 700;}
               .main-panel {
                   background:#687378
               }

           </style>
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="black">
            <!--
        ||||
    -->
            <div class="logo" >
                    <img src="../a.png"  style="    height: 100px; margin-right: 24%;">
                </a>
                <a href="#" >
                    <h4 align="center" style="color:white">لوحة التحكم</h4>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="home.php">
                            <i class="fa fa-home"></i>
                            <p>الرئيسية </p>
                        </a>
                    </li>
                    <li>
                        <a href="admins.php">
                            <i class="fa fa-users"></i>
                            <p>المشرفين</p>
                        </a>
                    </li>
                    <li>
                        <a href="book.php">
                            <i class="fa fa-book"></i>
                            <p>الكتب</p>
                        </a>
                    </li>
                    <li>
                        <a href="categories.php">
                            <i class="fa fa-list-alt"></i>
                            <p>الفئات</p>
                        </a>
                    </li>
                    <li>
                        <a href="buy.php">
                            <i class="fa fa-shopping-cart"></i>
                            <p>عمليات الشراء</p>
                        </a>
                    </li>

                    <li>
                        <a  href="admins.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">
                            <i class="fa fa-user"></i>
                            <p>الملف الشخصي</p>
                        </a>
                    </li>
                    
                   
                  
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top" style="background-color:#434343 !important">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <h4 style="font-weight: 700;"> <?php echo $_SESSION['Username'];?> </h4>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                  

                        <ul class="navbar-nav">
                        
                            <li class="nav-item">
                            <a class="nav-link" href="admins.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">   <img width="70px" height="70px" style="border-radius: 50%" src="upload/avater/<?php echo $_SESSION['image']; ?>" alt="" /> </a>

                               
                               
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">
                                    <i style="font-size: 29px; margin-top: 19px;" class="fa fa-sign-out"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">تسجيل خروج</span>
                                    </p>
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </nav>

            
            <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script>
$(document).ready(function(){
  $("#in").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#t tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    $("#t tr:first").show();
  });
});
</script>
            <!-- End Navbar -->