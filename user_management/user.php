<?php session_start(); ?>
<?php require_once("connection.php"); ?>
<?php
 if (!isset($_SESSION['user_id'])){//check for the submition button
  // header('Location:index.php');
 }
 $user_list='';
 //getting the list of user;
 $query="SELECT * FROM User WHERE is_deleted=0 order by first name";
 $users=mysqli_query($connection,$query);
 if(!$users){
   while($user=mysqli_fetch_assoc($users)){
     $user_list .="<tr>";
     $user_list .="<td>{$user['first_name']}</td>";
     $user_list .="<td>{$user['last_name']}</td>";
     $user_list .="<td>{$user['last_login']}</td>";
     $user_list .="<td><a href=\"modify-user.php?user_id={$user['id']}\">Edit</a></td>";
     $user_list .="<td><a href=\"delete-user.php?user_id={$user['id']}\">Delete</a></td>";
     $user_list .="<tr>";
   }

 }
 else{
   echo "connection failes";
 }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>User</title>
  </head>
  <body>
    <header>
      <div class="appname">User Mangement System</div>
      <div class="loggedin">Welcome<?php echo $_SESSION['first_name']; ?><a href="logout.php">Log out</a></div>
    </header>
    <main>
    <h1>Users<span><a href="add-user.php">Add New</a></span></h1>
    <table class="masterlist">
      <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>last login</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php echo $user_list; ?>
        </table>



  </main>

  </body>
</html>
