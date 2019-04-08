<?php session_start(); ?>
<?php
  include_once("connection.php");
 ?>
 <?php
$error[]=array();
$user_id='';
$first_name='';
$last_name='';
$email='';


if(isset($_GET['user_id'])){
    //getting the user information
    $user_id=mysqli_real_escape_string($connection,$_GET['user_id']);
    $query="SELECT * FROM register WHERE id={$user_id} LIMIT 1";

$result_set=mysqli_query($connection,$query);
if($result_set){
    if(mysqli_num_rows($result_set)==1){
        //user found
        $result=mysqli_fetch_assoc($result_set);
        $first_name=$result['f_name'];
        $last_name=$result['l_name'];
        $email=$result['email'];
        
        
    }
    else{
        //user not found
        header('Location:user1.php?err=query_not_found');
    }
}
else{
    header('Location:user1.php?err=query_failed');
}

}

if(isset($_POST['submit'])){
    $user_id=$_POST['user_id'];
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
}
   
   /*if(!is_email($_POST['email'])){
     $error='invalid password';

   }*/
   //checking email is exit;
  //$email=mysqli_real_escape_string($connection,$_POST['email']);
  $query="SELECT * FROM register WHERE email='{$email}' AND id !={$user_id} LIMIT 1";
  $result=mysqli_query($connection,$query);
  if($result){
    if(mysqli_num_rows($result)==1){
      $error[]='email already exist';
      
    }
    if(empty($error)){
      //no errors found
      $first_name=mysqli_real_escape_string($connection,$_POST['first_name']);
      $last_name=mysqli_real_escape_string($connection,$_POST['last_name']);
      //email adress is already sanitized

    $query="UPDATE register SET f_name='{$first_name}' AND l_name='{$last_name}' AND email='{$email}' WHERE  id='{$user_id}' LIMIT 1"; 
   
      
      
      $query="INSERT INTO register(f_name,l_name,email,passwordd,is_deleted) VALUES('$first_name','$last_name','$email','$hashed_password')";

      $result=mysqli_query($connection,$query);

      if($result){
        //query successful
        header('Location:user1.php?user_added=true');
      }
      else{
        echo 'unsuccsesful';
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
<header style="background-color:rgb(243, 200, 200);">
      <div class "appname" style="font-size: 40px;color:rgb(219, 15, 15);  font-family: Times New Roman">User management system</div>
      <div class="loggedin"style="font-size: 20px;color:rgb(214, 78, 78);margin-top:5px;">Welcome <?php echo $_SESSION['f_name'];  ?>!<a href="logout.php">Logout</a>


    </header>
    <main>
    <h1 style="color:red">Users<span style="font-family: Times New Roman;color:white;text-decoration:null"><a href="add-user.php">Back to UserList</a></span></h1>
    <form action="modify.php" method="post" class="userform">
    <fieldset>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <p>
        <label for="" style="color:white">first name:</label>
        <input type="text" name="first_name" <?php echo 'value="'.$first_name .'"';?> required>
      </p>
      <p>
        <label for=""style="color:white">Last name:</label>
        <input type="text" name="last_name"<?php echo 'value="'.$last_name .'"';?>  required>
      </p>
      <p>
        <label for=""style="color:white">Email adress</label>
        <input type="email" name="email" <?php echo 'value="'.$email.'"';?> required>
        
      </p>
      <p>
      <label for="" style="color:white">Password</label>
      <span style="color:white">******</span>| <a href="change_password.php?user_id=<?php echo $user_id;?>" style="color:white">Change Password</a>
      </p>
      <p>

        <button type="submit" name="submit"style="color:white;background-color:rgb(145, 215, 243)">Save</button>
      </p>
      </fieldset>
    </form>

  </main>

</body>
</html>
