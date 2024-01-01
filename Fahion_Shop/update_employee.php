<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_employee'])){
   
   $employee_name = $_POST['employee_name'];
   $employee_email = $_POST['employee_email'];
   $employee_image = $_FILES['employee_image']['name'];
   $employee_image_tmp_name = $_FILES['employee_image']['tmp_name'];
   $employee_image_folder = 'uploaded_img/'.$employee_image;

   if(empty($employee_name) || empty($employee_email) || empty($employee_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE employee SET name='$employee_name', email='$employee_email', image='$employee_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($employee_image_tmp_name, $employee_image_folder);
         header('location:add_employee.php');
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


<div class="admin-employee-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM employee WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update</h3>
      <input type="text" class="box" name="employee_name" value="<?php echo $row['name']; ?>" placeholder="enter the employee name">
      <input type="email" class="box" name="employee_email" value="<?php echo $row['email']; ?>" placeholder="enter the employee email">
      <input type="file" class="box" name="employee_image"  accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update" name="update_employee" class="btn">
      <a href="add_employee.php" class="btn">Back</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>