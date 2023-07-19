<?php
include 'Includes/dbcon.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="admin/img/logo/logo.png" rel="icon">
  <title>AMS - Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

  <style>
    .btn-maroon {
      background-color: maroon;
      color: white;
    }
  </style>


</head>

<body class="bg-gradient-login" style="padding-top: 2em">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5" style="border-radius: 20px">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <h5 align="center" style="font-weight:900">CCIS STUDENT ATTENDANCE SYSTEM</h5>
                  <div class="text-center">
                    <img src="img/logo/logo.png" style="width:100px;height:100px">
                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4" style="text-transform:uppercase">Login Panel</h1>
                  </div>
                  <form class="user" method="Post" action="">
                    <div class="form-group">
                      <select required name="userType" class="form-control mb-3">
                        <option value="">Select User</option>
                        <option value="Administrator">Administrator</option>
                        <option value="ClassTeacher">Class Teacher</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" required class="form-control" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div> -->
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-maroon btn-block" value="LOG IN" name="login" />
                      </div>
                  </form>

                  <?php

                  if (isset($_POST['login'])) {

                    $userType = $_POST['userType'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $password = md5($password);

                    if ($userType == "Administrator") {

                      $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $rows = $rs->fetch_assoc();

                      if ($num > 0) {

                        $_SESSION['userId'] = $rows['Id'];
                        $_SESSION['firstName'] = $rows['firstName'];
                        $_SESSION['lastName'] = $rows['lastName'];
                        $_SESSION['emailAddress'] = $rows['emailAddress'];

                        echo "<script type = \"text/javascript\">
        window.location = (\"Admin/index.php\")
        </script>";
                      } else {

                        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";
                      }
                    } else if ($userType == "ClassTeacher") {

                      $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $rows = $rs->fetch_assoc();

                      if ($num > 0) {

                        $_SESSION['userId'] = $rows['Id'];
                        $_SESSION['firstName'] = $rows['firstName'];
                        $_SESSION['lastName'] = $rows['lastName'];
                        $_SESSION['emailAddress'] = $rows['emailAddress'];
                        $_SESSION['classId'] = $rows['classId'];
                        $_SESSION['classArmId'] = $rows['classArmId'];

                        echo "<script type = \"text/javascript\">
        window.location = (\"ClassTeacher/index.php\")
        </script>";
                      } else {

                        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";
                      }
                    } else {

                      echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";
                    }
                  }
                  ?>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>