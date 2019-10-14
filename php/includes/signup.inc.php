<?php
if (isset($_POST['signup-submit'])) {

  require 'dbh.inc.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];


  }
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../html/signup.html?error=invalidmail&uid=".$username);
    exit();
  }
  else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: ../../html/signup.html?error=invalidmail&uid=".$username);
    exit();
  }
  else if ($password !== $passwordRepeat) {
    header("Location: ../../html/signup.html?error=passwordcheckuid=".$username."&mail=".$email);
    exit();
  } else {
    $sql = "SELECT uidUsers FROM applicants WHERE uidUsers=? AND userPassword=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../../html/signup.html?error=sqlerror");
      exit();
    }
  }
    else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
          header("Location: ../../html/signup.html?error=usertaken&mail=".$email);
          exit();
        }}
        else {
          $sql = "INSERT INTO applicants (uidUsers, userEmail, userPassword) VALUES (?,?,?)";
          $stmt = mysqli_stmt_init($conn);
          $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
          mysqli_stmt_execute($stmt);
          header("Location: ../../html/signup.html?signup=success");
          exit();
          }



  mysqli_stmt_close($stmt);
  mysqli_close($conn);




else {
  header("Location: ../../html/signup.html ");
  exit();
}
