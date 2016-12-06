<?php
session_start();
if (isset($_SESSION['userSession'])!="") {
 header("Location: home.php");
}
require_once 'dbconnect.php';

if(isset($_POST['btn-signup'])) {
 
 $uname = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 
 $uname = $DBcon->real_escape_string($uname);
 $email = $DBcon->real_escape_string($email);
 $upass = $DBcon->real_escape_string($upass);
 
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // działa tylko w PHP 5.5 i nowszych wersjach
 
 $check_login = $DBcon->query("SELECT username FROM z7_users WHERE username='$uname'");
 $count=$check_login->num_rows;
 
 if(strlen($_POST['password']) < 8){
	 $msg = "<div class='alert alert-success'>Password is too short !</div>";
 }else{
 if ($count==0) {
  mkdir($uname, 0777); //tworzenie folderu dla użytkownika
  $query = "INSERT INTO z7_users(username,email,password) VALUES('$uname','$email','$hashed_password')";
   
  if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>Successfully registered !</div>";
    
  }else {
   $msg = "<div class='alert alert-danger'>Error while registering !</div>";
  }
  
 } else {
  $msg = "<div class='alert alert-danger'>Login already taken ! Please try again with diffrent Username</div>";
   
 }
 }
 
 $DBcon->close();
}
?>

<head>
</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Register</h2><hr />
        
        <?php
  if (isset($msg)) {
   echo $msg;
  }
  ?>
          
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="email" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required  />
        </div>
        
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">Create Account</button> 
            <a href="index.php" class="btn btn-default" style="float:right;">LogIn HERE</a>
        </div> 
      
      </form>

    </div>
    
</div>

</body>
</html>