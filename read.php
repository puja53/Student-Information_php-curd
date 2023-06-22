<?php
require_once "config.php";

// Check if url contains id parameter
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
  // Get the id from url
  $id = trim($_GET["id"]);

  // Prepare a select home_townment
  $sql = "SELECT * FROM students WHERE id = ?";

  if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variable to a home_townment as parameter
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the home_townment
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) == 1) {
        // Fetch the record
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        // Retrieve the individual field value
        $student_id = $row["student_id"];
        $student_name = $row["student_name"];
        $session = $row["session"];
        $email = $row["email"];
        $blood_group = $row["blood_group"];
        $mobile_no = $row["mobile_no"];
        $home_town = $row["home_town"];
        $creation_date = $row["creation_date"];
      } else {
        // Redirect if url doesn't contain valid id parameter
        echo "<script>window.location.href='http://localhost/php_crud/';</script>";
        exit;
      }
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }
  }
  // Close home_townment
  mysqli_stmt_close($stmt);

  // Close connection
  mysqli_close($link);
} else {
  // Redirect if url doesn't contain id parameter
  echo "<script>window.location.href='http://localhost/php_crud/';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Read Data - PHP CRUD</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="style.css">
</head>

<body style="background-color:#E0FFFF;">
  <div class="container">
    <table class="table table-bordered mt-5">
      <thead>
        <tr>
          <th>Student Id</th>
          <th>Student Name</th>
          <th> Email Address</th>
          <th>Blood Group</th>
          <th>Mobile No</th>
          <th>Session</th>
          <th>Home Town</th>
          <th>Creation Date</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?= ucfirst($student_id); ?></td>
          <td><?= ucfirst($student_name); ?></td>
          <td><?= $email; ?></td>
          <td><?= strtoupper($blood_group); ?></td>
          <td><?= $mobile_no; ?></td>
          <td><?= ucfirst($session); ?></td>
          <td><?= ucfirst($home_town); ?></td>
          <td><?= $creation_date; ?></td>
        </tr>
      </tbody>
    </table>
    <p class="text-end">
      <a href="./" class="btn btn-danger float-end">&laquo; Back</a>
    </p>
  </div>
</body>

</html>