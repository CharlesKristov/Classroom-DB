<?php 
  include("validation.php");

  $email = $_POST['email'];
  $password = $_POST['password'];


  if(validateLogin($email, $password)) {
    $_SESSION['page'] = 'dashboard';

    if(isset($_SESSION['error']['login']))
      unset($_SESSION['error']['login']);
  }

  header("Location: ./../");
?>