
<?php session_start();
?>
<?php
  require_once("connection.php");
?>
<?php
//check for the submition
  if(isset($_POST['submit'])){
    $error = array( );
  
    // check if the username and [password has been enterd]
    if(!isset($_POST['email'])|| strlen(trim($_POST['email']))<1){
      $error[]="email is missing/ invalid";

    }
    //check if there are any error in the form
    if(!isset($_POST['password'])|| strlen(trim ($_POST['password']))<1){
      $error[]="password is missing/ invalid";

    }
    
    //chek it ha s any odbc_errorms
    if(true){
      //save username and Password
      $email=mysqli_real_escape_string($connection,$_POST['email']);
      $password=mysqli_real_escape_string($connection,$_POST['password']);
      //$hashed_pass=sha1($password);

      //select Query
      $query="SELECT * FROM register2 WHERE email='{$email}'AND password='{$password}'";

      $query_result=mysqli_query($connection,$query);
    //  $row=mysqli_fetch_array($query_result);

      if($query_result){//query succusefull

         while($user = mysqli_fetch_array($query_result)){

          $_SESSION["user_id"]=$user['id'];
          $_SESSION["f_name"]=$user['f_name'];
          //updating last loggedin
          $query="UPDATE register2 SET last_login = NOW()";
          $query .="WHERE id='{$_SESSION["user_id "]}' LIMIT 1";

          $result_set=mysqli_query($connection,$query);
          if(!$result_set){
            die("Database query failed");
          }
          else{
          header("Location:user1.php");
          }
        }
            }
            else{
              $error[]='error';
            }
        }
  }
  

 ?>

<!DOCTYPE html>
<html>
<head>login part
  <title>log in user management System</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="login">

<form action="index.php" method="post">
<fieldset>
<legend><h1 style="color:red;font-size:40px;">log in</h1></legend>
  <?php if(isset($error)&&!empty($error)){
  echo '<p class="error" style="background-color:red;color:white">invalid username /Password</p>';
}

 ?>
 <?php
 if (isset($_GET['logout'])) {
   echo'<p class="info">You have successfuly logout</p>';
 } ?>
<p>
<label for=""style="color:white;">Username:</label>
<input type="text" name="email" id="" placeholder="emai address">
</p>
<p>
<label for=""style="color:white">Password:</label>
<input type="password" name="password" id="" placeholder="password">
</p>
<p>
  <button type="submit" name="submit" style="background-color:rgb(145, 215, 243)">submit</button>
</p>



</fieldset>
</form>

  </div>


</body>
</html>
<?php mysqli_close($connection); ?>
