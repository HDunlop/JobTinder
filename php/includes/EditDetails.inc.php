<?php
if (isset($_POST['save-submit'])) {
  require 'dbh.inc.php';

  $fullname = $_POST['uFullName'];
  $about = $_POST['uAbout'];



  //Insert Info
  $sql = "INSERT INTO applicants (userFull, userAbout) VALUES (?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../editdetails.php?error=sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "ss", $fullname, $about);
    mysqli_stmt_execute($stmt);
    header("Location: ../editdetails.php?detailchange=success");
    exit();
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);


}
else {
  header("Location: ../editdetails.php");
  exit();
}
