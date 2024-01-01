<?php

@include 'config.php';

if(isset($_POST['add_employee'])){

   $employee_name = $_POST['employee_name'];
   $employee_email = $_POST['employee_email'];
   $employee_image = $_FILES['employee_image']['name'];
   $employee_image_tmp_name = $_FILES['employee_image']['tmp_name'];
   $employee_image_folder = 'uploaded_img/'.$employee_image;

   if(empty($employee_name) || empty($employee_email) || empty($employee_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO employee(name, email, image) VALUES('$employee_name', '$employee_email', '$employee_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($employee_image_tmp_name, $employee_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }
};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM employee WHERE id = $id");
   header('location:add_employee.php');
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

   <div class="admin-employee-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <button onclick="location.href='admin.php'" type="button">Back</button><br>
         <h3>Add employee</h3>
         <input type="text" placeholder="enter employee name" name="employee_name" class="box">
         <input type="email" placeholder="enter employee email" name="employee_email" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="employee_image" class="box">
         <input type="submit" class="btn" name="add_employee" value="Add">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM employee");
   
   ?>
   <div class="manager-display">
      <table class="manager-display-table">
         <thead>
            <h3>Employee list</h3>
         <tr>
            <th>Employee_name</th>
            <th>Employee_email</th>
            <th>Employee_image</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td>
               <a href="update_employee.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
               <a href="add_employee.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>