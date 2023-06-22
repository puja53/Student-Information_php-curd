<?php
  require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP CRUD Application</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="style.css">
</head>

<body style="background-color:#E0FFFF;">
  <div class="container">
  <div>
  <h1 class="text-center"><b>
    <p class="text-primary">Student Information Table</p> </b></h1>
    </div>
    <div class="card-header">
      <a href="home.php" class="btn btn-primary my-4"> &laquo;Home
    </a>
     <a href="index.php" class="btn btn-info my-4"> 
    <i class="bi bi-info-circle"></i>Info
    </a>
    <a href="create.php" class="btn btn-success my-4">
      <i class="bi bi-plus-circle"></i> Add Student
    </a>
   
    <div>
    <form method="post">
            <input type="text" placeholder="Search" name="search">
            <button class="btn btn-primary btn-sm" name="submit">
              <i class="bi bi-search"></i>Search</button>
        </form>
    </div>
   </div>

    
    <table style="background-color:#F0FFFF" class="table table-bordered table-striped align-middle">
      <thead>
        <tr>
          <th>Serial No</th>
          <th>Student Id</th>
          <th>Student Name</th>
          <th> Email Address</th>
          <th>Blood Group</th>
          <th>Mobile No</th>
          <th>Session</th>
          <th>Home Town</th>
           <th>Actions</th>
        </tr>
      </thead>

      <tbody>
        <?php

if(isset($_POST['submit'])){
        
  $search=$_POST['search'];
  $sql = "SELECT * FROM students where id = '$search'
  or student_id = '$search' or student_name = '$search' or email = '$search'
  or blood_group = '$search' or mobile_no = '$search' or session = '$search' or home_town = '$search'";
  if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      // Fetch the records
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      $count = 1;
      foreach ($rows as $row) { ?>
          <tr>
              <td><?= $count++; ?>.</td>
              <td><?= ucfirst($row["student_id"]); ?></td>
              <td><?= ucfirst($row["student_name"]); ?></td>
              <td><?= $row["email"]; ?></td>
              <td><?= strtoupper($row["blood_group"]); ?></td>
              <td><?= $row["mobile_no"]; ?></td>
              <td><?= ucfirst($row["session"]); ?></td>
              <td><?= ucwords($row["home_town"]); ?></td>
              <td>
                  <a href="read.php?id=<?= $row["id"]; ?>" class="btn btn-info btn-sm">
                      <i class="bi bi-eye-fill"></i>
                  </a>&nbsp;
                  <a href="update.php?id=<?= $row["id"]; ?>" class="btn btn-primary btn-sm">
                      <i class="bi bi-pencil-square"></i>
                  </a>&nbsp;
                  <a href="delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm">
                      <i class="bi bi-trash"></i>
                  </a>
              </td>
          </tr>
          <?php
      }
    } else { ?>
          <tr>
              <td class="text-center text-danger fw-bold" colspan="9">* No Record Found *</td>
          </tr>
          <?php
    }
  } else {
    echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
  }
  // Close conection 
  mysqli_close($link);
}else{
   // Include config fil

   $sql = "SELECT * FROM students";

   if ($result = mysqli_query($link, $sql)) {
     if (mysqli_num_rows($result) > 0) {
       // Fetch the records
       $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
       $count = 1;
       foreach ($rows as $row) { ?>
         <tr>
           <td><?= $count++; ?>.</td>
           <td><?= ucfirst($row["student_id"]); ?></td>
           <td><?= ucfirst($row["student_name"]); ?></td>
           <td><?= ($row["email"]); ?></td>
           <td><?= strtoupper($row["blood_group"]); ?></td>
           <td><?= $row["mobile_no"]; ?></td>
           <td><?= $row["session"]; ?></td>
           <td><?= ucwords($row["home_town"]); ?></td>
           <td>
             <a href="read.php?id=<?= $row["id"]; ?>" class="btn btn-info btn-sm">
               <i class="bi bi-eye-fill"></i>
             </a>&nbsp;
             <a href="update.php?id=<?= $row["id"]; ?>" class="btn btn-primary btn-sm">
               <i class="bi bi-pencil-square"></i>
             </a>&nbsp;
             <a href="delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm">
               <i class="bi bi-trash"></i>
             </a>
           </td>
         </tr>
       <?php
       }
     } else { ?>
       <tr>
         <td class="text-center text-danger fw-bold" colspan="9">* No Record Found *</td>
       </tr>
   <?php
     }
   } else {
     echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
   }
   // Close conection 
   mysqli_close($link);
}
?>
 </tbody>
</table>
</div>

<!-- custom js -->
<script>
const delBtnEl = document.querySelectorAll(".btn-danger");
delBtnEl.forEach(function(delBtn) {
 delBtn.addEventListener("click", function(event) {
   const message = confirm("Are you sure you want to delete this record?");
   if (message == false) {
     event.preventDefault();
   }
 });
});
</script>
       
</body>

</html>