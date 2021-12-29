<?php
session_start();
if (isset($_SESSION['administrator'])) {
  unset($_SESSION['administrator']);
}
header("Location: ../../");
