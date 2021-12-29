<?php 
  session_start();
  session_destroy();
  session_unset();
  $_SESSION['page'] = 'login';
  header("Location: ./../");
