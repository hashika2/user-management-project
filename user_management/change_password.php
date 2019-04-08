<?php session_start(); ?>
<?php
  include_once("connection.php");
 ?>
 <?php
$error=false;
$first_name='';
$last_name='';
$email=''; 
$user_id=;

   /*if(!is_email($_POST['email'])){
     $error='invalid password';

   }*/
   if(isset($_POST['submit'])){
     $user_id=$_POST['user_id'];
     $passwordd=$_POST['password']; 

    if($error == false){
      //no errors found
     
      $passwordd=mysqli_real_escape_string($connection,$_POST['password']);
       
      
      $query="UPDATE register2 SET passwordd=$passwordd WHERE id=('$user_id) LIMIT 1";

      $result=mysqli_query($connection,$query);

      if($result){
        //query successful
        header('Location:user1.php?user_modify=true');
      }
      else{
        echo 'unsuccsesful to update';
      }
   }
  
  }

  ?>
<!DOCTYPE html>
  <html lang="en">
<head>
  <title>Add user </title>
  <link href="main.css" rel="stylesheet">
  <style>
  form.userform label{
    width: 30%;
    float: left;
  }
  form.userform input{
    width: 60%;
  }
  form.userform button{
    width: 100px;
  }
  </style>
</head>
<body>
    <header style="background-color:rgb(243, 200, 200); margin-top:20px">
      <div class "appname" style="font-size: 40px;color:rgb(219, 15, 15);  font-family: Times New Roman">User management system</div>
      <div class="loggedin"style="font-size: 20px;color:rgb(214, 78, 78);margin-top:5px;">Welcome <?php echo $_SESSION['f_name'];  ?>!<a href="logout.php">Logout</a>


    </header>
    <main>
    <h1 style="color:red">Users<span style="font-family: Times New Roman;background-color:white;text-decoration:none" ><a href="user1.php">Back to UserList</a></span></h1>
    <form action="change_password.php" method="post" class="userform">
    <fieldset>
      <p>
        <label for="" style="color:white">first name:</label>
        <input type="text" name="first_name" <?php echo 'value="'.$first_name .'"';?>disabled>
      </p>
      <p>
        <label for=""style="color:white">Last name:</label>
        <input type="text" name="last_name" <?php echo 'value="'.$last_name .'"';?> disabled>
      </p>
      <p>
        <label for=""style="color:white">Email adress</label>
        <input type="email" name="email" <?php echo 'value="'.$email .'"';?> disabled>
        
      </p>
      <p>
        <label for=""style="color:white">New password:</label>
        <input type="password" name="password" >
      </p>
      
      <p>

        <button type="submit" name="submit"style="color:white;background-color:rgb(145, 215, 243)">Update password</button>
      </p>
      </fieldset>
    </form>

  </main>

</body>
</html>
