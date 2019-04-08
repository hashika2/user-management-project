<?php session_start(); ?>
<?php
  include_once("connection.php");
 ?>
 <?php
   if(!isset($_SESSION['user_id'])){
       header('Location:index.php');
   }


if(isset($_GET['user_id'])){
    //getting the user information
    $user_id=mysqli_real_escape_string($connection,$_GET['user_id']);
   
if($user_id==$_SESSION['user_id']){
    //shouid not delete current user
    header('Location:user1.php? err=cannot_delete_current_user');
}else{
    //deleting the user
    $query="UPDATE register2 SET is_deleted=1 WHERE id ={$user_id} LIMIT 1";
    $result=mysqli_query($connection,$query);

    if($result){
        //user deleted
        header('Location:user1.php?msg=user_deleted');
    }
    else{
        header('Location:user1.php?msg=user_not_deleted ');
    }
}

}
else{
    header('Location:user1.php');
}
?>
