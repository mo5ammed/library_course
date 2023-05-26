
<?php
      include 'connect.php';

session_start();
ini_set("display_errors",0);
 if(isset($_SESSION['Username'])){
   header('Location: home.php');

 } 

     
    

      
          // if coming from http

         if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashpass = sha1($password);
        $formEroor=array();









        $stmt = $con->prepare("SELECT id, username , password , image FROM admins WHERE username = ? AND password = ?   LIMIT 1");
        $stmt->execute(array($username , $hashpass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
       



         if($count > 0 ){
        
             $_SESSION['Username'] = $username;
             $_SESSION['ID']=$row['id']; 
             $_SESSION['image'] = $row['image'];
            header('Location: home.php');
              exit();
        
           }
    
  
   }
 


    ?>
 
<style >
body{
    background-color:#f4f4f4 ;
}
.login{
    width: 300px;
    margin: 100px auto;
}

.login input{
    margin-bottom: 10px;
}
.login .form-control {

    background-color:#EAEAEA;
}
.login .btn {
       background-color:#008dde;
}
h1{
 
  background-color: #21252;
    color: white;
    padding: 14px 25px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}

</style>
<body  style="width:300px; height:100px;  margin-left: 38%; background: #4b4b4b;" >
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<br><br>
<br>

<h1 class="text-center" ><a  href="../index.php" >Home Page</a></h1>




<div class="container">

<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
     <h4 class="text-center" >Admin Login</h4>
     <div class="form-group"><input class ="form-control btn-lg" required="required" type="text" name="user" placeholder="username" autocomplete="off" /></div>
     
     <div class="form-group"> <input class ="form-control" required="required" type="password" name="pass" placeholder="password" autocomplete="new-password" /></div>
     <div class="form-group"> <input class ="btn btn-primary btn-block" required="required" type="submit" value="login" /></div>
</form>

 
</div>



</body>

</div>




