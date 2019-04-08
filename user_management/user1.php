<?php session_start(); ?>
<?php
  include_once("connection.php");
 ?>
 <?php
//checking if a user logged include ;
/*if(!isset($_SESSION['user_id'])){
header('Location:index.php');
}*/
$user_list='';
//getting the list of user;
$query="SELECT * FROM register2 WHERE is_deleted=0 order by f_name";
$users=mysqli_query($connection,$query);

  while($user=mysqli_fetch_assoc($users)){
    $user_list .="<tr>";
    $user_list .="<td style='color:white'>".$user['f_name']."</td>";
    $user_list .="<td style='color:white'>".$user['l_name']."</td>";
    $user_list .="<td style='color:white'>".$user['last_login']."</td>";
    $user_list .="<td style='color:white'><a style='color:white'href=\"modify.php?user_id=".$user['id']."\">Edit</a></td>";
    $user_list .="<td style='color:white'><a  style='color:white' href=\"delete_user.php?user_id=".$user['id']."\">Delete</a></td>";
    $user_list .="<tr>";
  }



  ?>
<!DOCTYPE html>
  <html lang="en">
<head>
  <title>User</title>
  <link href="main.css" rel="stylesheet">
</head>
<body>
<header style="background-color:black; margin-top:20px;opacity:.9;height:65px">
      <div class "appname" style="font-size: 40px;color:rgb(219, 15, 15);  font-family: Times New Roman;margin-top:5px;">User management system</div>
      <div class="loggedin"style="font-size: 20px;color:rgb(214, 78, 78);margin-top:10px;">Welcome <?php echo $_SESSION['f_name'];  ?>!<a href="logout.php">Logout</a>


    </header>
    <main>
    <h1 style="color:red">Users<span style="color: rgb(79, 188, 231);font-family: Times New Roman;color:;text-decoration:none;background-color:white"><a href="add-user.php">Add New</a></span></h1>
    <fieldset>
    <table class="masterlist">
      <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>last_login</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php echo  $user_list; ?>
        </table>

</fieldset>

  </main>

</body>
</html>
