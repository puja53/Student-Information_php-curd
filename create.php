<?php
require_once "config.php";

// Define variables and initialize with empty values
$student_id_err = $s_name_err = $email_err = $blood_group_err = $mobile_no_err = $session_err = $home_town_err = "";
$student_id = $student_name = $email = $blood_group = $mobile_no = $session = $home_town = "";

// Processing input data when form is submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["student_id"])) {
    $student_id_err = "This field is required*";
  } else {
    $student_id = trim($_POST["student_id"]);
    // if (!ctype_alpha($student_id)) {
    //   $student_id_err = "Only letters are allowed";
    // }
  }

  if (empty($_POST["s_name"])) {
    $s_name_err = "This field is required*";
  } else {
    $student_name = trim($_POST["s_name"]);
    if (!ctype_alnum($student_name)) {
      $s_name_err = "Only letters are allowed";
    }
  }
  if (empty($_POST["session"])) {
    $session_err = "This field is required*";
  } else {
    $session = trim($_POST["session"]);
  }


  if (empty($_POST["blood_group"])) {
    $blood_group_err = "This field is required*";
  } else {
    $blood_group = trim($_POST["blood_group"]);
  }

  if (empty($_POST["mobile_no"])) {
    $mobile_no_err = "This field is required*";
  } else {
    $mobile_no = trim($_POST["mobile_no"]);
  }

  if (empty($_POST["email"])) {
    $email_err = "This field is required*";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email_err = "Please enter a valid email address";
    }
  }
 

  if (empty($_POST["home_town"])) {
    $home_town_err = "This field is required*";
  } else {
    $home_town = trim($_POST["home_town"]);
  }

  // Check input errors before inserting data into database
  if (empty($student_id_err) && empty($s_name_err) && empty($email_err) && empty($blood_group_err) && empty($session_err) && empty($home_town_err)) {

    // Prepare an insert home_townment
    $sql = "INSERT INTO students (student_id, student_name, email, blood_group, mobile_no, session, home_town) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to a prepared home_townment as parameters
      mysqli_stmt_bind_param($stmt, "ssssiss", $student_id, $student_name, $email, $blood_group, $mobile_no, $session, $home_town);

      // Execute the home_townment
      if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('New record created successfully')</script>";
        echo "<script>window.location.href='http://localhost/php_crud/';</script>";
        exit;
      } else {
        echo "Oops! Something went wrong. Please try again later";
      }
    }
    // Close home_townment
    mysqli_stmt_close($stmt);
  }
  // Close connection
  mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Data - PHP CRUD Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center pt-5">
      <div class="col-lg-6">
        <div class="card-header">
          <h4 align="center" class="text-success">Student Add
            <a href="index.php"class="btn btn-danger float-end">&laquo;BACK</a>
          </h4>
        </div>
        <!-- form start -->
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="bg-light p-4 shadow-sm" novalidate>
          <div class="row">
            <div class="col-lg-6 mb-3">
              <label for="student_id" class="form-label">Student Id</label>
              <input type="text" name="student_id" class="form-control" id="student_id" value="<?= $student_id; ?>">
              <small class="text-danger"><?= $student_id_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="s_name" class="form-label">Student Name</label>
              <input type="text" name="s_name" class="form-control" id="s_name" value="<?= $student_name; ?>">
              <small class="text-danger"><?= $s_name_err; ?></small>
            </div>

            <div class="col-lg-12 mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" id="email" value="<?= $email; ?>">
              <small class="text-danger"><?= $email_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="blood_group" class="form-label">Blood Group</label>
              <input type="text" name="blood_group" class="form-control" id="blood_group" value="<?= $blood_group; ?>">
              <small class="text-danger"><?= $blood_group_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="mobile_no" class="form-label">Mobile No</label>
              <input type="number" name="mobile_no" class="form-control" id="mobile_no" value="<?= $mobile_no; ?>">
              <small class="text-danger"><?= $mobile_no_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="session" class="form-label">Session</label>
              <input type="text" name="session" class="form-control" id="session" value="<?= $session; ?>">
              <small class="text-danger"><?= $session_err; ?></small>
            </div>

            <div class="col-lg-6 mb-3">
              <label for="home_town" class="form-label">Home Town</label>
              <input type="text" name="home_town" class="form-control" id="home_town" value="<?= $home_town; ?>">
              <small class="text-danger"><?= $home_town_err; ?></small>
            </div>

            <div class="col-lg-12 mt-1">
              <input type="submit" class="btn btn-primary form-control" value="Create Record">
            </div>
          </div>
        </form>
        <!-- form end -->
      </div>
    </div>
  </div>
</body>

</html>