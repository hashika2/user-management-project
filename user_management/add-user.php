<?php session_start(); ?>
<?php
  include_once("connection.php");
 ?>
 <?php
$error[]=array();
$first_name='';
$last_name='';
$email=''; 
//$password='';
$user_list='';

   /*if(!is_email($_POST['email'])){
     $error='invalid password';

   }*/
   //checking email is exit;
  
    if(isset($_POST['submit']) ){
      $email=mysqli_real_escape_string($connection,$_POST['email']);
      $query="SELECT * FROM register2 WHERE email='{$email}' LIMIT 1";
      $result=mysqli_query($connection,$query);
  if($result){
    if(mysqli_num_rows($result)==1){
      $error='';
 
    }

      //no errors found
     if(true){
      $first_name=mysqli_real_escape_string($connection,$_POST['first_name']);
      $last_name=mysqli_real_escape_string($connection,$_POST['last_name']);
      $passwordd=mysqli_real_escape_string($connection,$_POST['password']);
       
      
      $query1="INSERT INTO register2(f_name,l_name,email,password,last_login,is_deleted) VALUES('$first_name','$last_name','$email','$passwordd',NOW(),0)";

      $result=mysqli_query($connection,$query1);

      if($result){
        //query successful
        header('Location:user1.php?user_added=true');
      }
      else{
        echo 'unsuccsesful';
      }
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
<header style="background-color:black; margin-top:20px;opacity:.9;height:65px">
      <div class "appname" style="font-size: 40px;color:rgb(219, 15, 15);  font-family: Times New Roman;margin-top:5px;">User management system</div>
      <div class="loggedin"style="font-size: 20px;color:rgb(214, 78, 78);margin-top:10px;">Welcome <?php echo $_SESSION['f_name'];  ?>!<a href="logout.php">Logout</a>



    </header>
    <main>
    <h1 style="color:red">Users<span style="font-family: Times New Roman;background-color:white;text-decoration:none" ><a href="user1.php">Back to UserList</a></span></h1>
    <form action="add-user.php" method="post" class="userform">
    <fieldset>
      <p>
        <label for="" style="color:white">first name:</label>
        <input type="text" name="first_name"  required>
      </p>
      <p>
        <label for=""style="color:white">Last name:</label>
        <input type="text" name="last_name"  required>
      </p>
      <p>
        <label for=""style="color:white">Email adress</label>
        <input type="email" name="email"  required>
        
      </p>
      <p>
        <label for=""style="color:white">New password:</label>
        <input type="password" name="password" required>
      </p>
      <p>
        <label for=""style="color:white">Confrim password:</label>
        <input type="password" name="password" required>
      </p>
      <p>

        <button type="submit" name="submit"style="color:white;background-color:rgb(145, 215, 243)">Save</button>
      </p>
      </fieldset>
    </form>

  </main>

</body>
</html>
