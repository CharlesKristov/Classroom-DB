<?php 

  include("../database/Database.php");
  include("../model/Student.php");
  include("../model/Teacher.php");

  function validateEmail($email) {
    
    // format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      echo $emailErr;
      return false;
    }
    
    // email binus
    if(substr(($email),-11, 5) === "binus") {
      if(substr(($email),-5, 2) == "ac") {
        return true;
      }
      else if(substr(($email),-5, 2) == "tc") {
        return true;
      }
    }
    
    return false;
  }

  function validatePassword($password, $dob) {
    
    // cek panjang 
    if(strlen($password) !== 13){
      return false;
    }

    //cek b!Nu5
    if(substr($password, 0, 5) !== "b!Nu$"){
      return false;
    }

    // cek dob
    if(substr($password, 5, 8) !== $dob){
      return false;
    }

    return true;
  }

  function validateLogin($email, $password) {
    session_start();
    
    $db = (new Database())->connect();
    $student = new Student($db);
    $teacher = new Teacher($db);
    
    $error = [];

    if($email == "admin" && $password == "admin") {
      if(isset($_SESSION['user'])) 
        unset($_SESSION['user']);
        
      $_SESSION['user_type'] = 'admin';
      return true;
    }
    
    
    if(!validateEmail($email)) {
      $error['email'] = 'Invalid Email';
      $_SESSION['error']['login'] = $error;
      return false;
    }

    $user_type = (strpos($email, "binus.ac.id") ? 0 : (strpos($email, "binus.tc.id") ? 1 : 2));
    
    $full_name = explode(".", explode("@", $email, 2)[0], 2);
    $first_name = ucfirst($full_name[0]);
    $last_name = ucfirst(is_null($full_name[1]) ? $full_name[0] : $full_name[1]);


    $user = $user_type == 0 ? $student->getStudent($first_name, $last_name) : $teacher->getTeacher($first_name, $last_name);
    $dob = date_format(date_create($user['dob']), "dmY");

    
    if(!validatePassword($password, $dob)) {
      $error['password'] = 'Invalid Password';
      $_SESSION['error']['login'] = $error;
      return false;
    }


    $_SESSION['user'] = $user;
    $_SESSION['user_type'] = $user_type == 0 ? "student" : "teacher";
    return true;
  }
?>