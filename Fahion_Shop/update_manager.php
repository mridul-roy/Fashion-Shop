<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_manager'])){
   
   $manager_name = $_POST['manager_name'];
   $manager_email = $_POST['manager_email'];
   $manager_image = $_FILES['manager_image']['name'];
   $manager_image_tmp_name = $_FILES['manager_image']['tmp_name'];
   $manager_image_folder = 'uploaded_img/'.$manager_image;

   if(empty($manager_name) || empty($manager_email) || empty($manager_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE manager SET name='$manager_name', email='$manager_email', image='$manager_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($manager_image_tmp_name, $manager_image_folder);
         header('location:add_manager.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-manageer-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM manager WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update</h3>
      <input type="text" class="box" name="manager_name" value="<?php echo $row['name']; ?>" placeholder="enter the manager name">
      <input type="email" class="box" name="manager_email" value="<?php echo $row['email']; ?>" placeholder="enter the manager email">
      <input type="file" class="box" name="manager_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update" name="update_manager" class="btn">
      <a href="add_manager.php" class="btn">Back</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>