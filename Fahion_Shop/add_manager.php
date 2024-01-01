<?php

@include 'config.php';

if(isset($_POST['add_manager'])){

   $manager_name = $_POST['manager_name'];
   $manager_email = $_POST['manager_email'];
   $manager_image = $_FILES['manager_image']['name'];
   $manager_image_tmp_name = $_FILES['manager_image']['tmp_name'];
   $manager_image_folder = 'uploaded_img/'.$manager_image;

   if(empty($manager_name) || empty($manager_email) || empty($manager_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO manager(name, email, image) VALUES('$manager_name', '$manager_email', '$manager_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($manager_image_tmp_name, $manager_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM manager WHERE id = $id");
   header('location:add_manager.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin page</title>


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

   <div class="admin-manager-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <button onclick="location.href='admin.php'" type="button">Back</button><br>
         <h3>Add manager</h3>
         <input type="text" placeholder="enter manager name" name="manager_name" class="box">
         <input type="email" placeholder="enter manager email" name="manager_email" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="manager_image" class="box">
         <input type="submit" class="btn" name="add_manager" value="Add">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM manager");
   
   ?>
   <div class="manager-display">
      <table class="manager-display-table">
         <thead>
            <h3>Manager Info</h3>
         <tr>
            <th>Manager_name</th>
            <th>Manager_email</th>
            <th>Manager_image</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td>
               <a href="update_manager.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
               <a href="add_manager.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>