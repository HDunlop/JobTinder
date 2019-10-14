<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  if (empty($email) || empty($password) || empty($passwordRepeat)) {
    header("Location: ../../html/signup.html?error=emptyfields&mail=".$email);
    exit();
  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../html/signup.html?error=invalidmail");
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../../html/signup.html?error=passwordcheck&mail=".$email);
    exit();
  }
  else {
    $sql = "SELECT userEmail FROM applicants WHERE userEmail=? AND userPassword=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../../html/signup.html?error=sqlerror");
      exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          header("Location: ../../html/signup.html?error=mailtaken");
          exit();
        }
        else {
          $sql = "INSERT INTO applicants (userEmail, userPassword) VALUES (?,?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../html/signup.html?error=sqlerror");
            exit();
          }
          else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../../html/signup.html?signup=success");
            exit();
          }
        }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);



}
else {
  header("Location: ../../html/signup.html");
  exit();
}
