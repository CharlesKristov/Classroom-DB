<?php
include("../../database/Database.php");

session_start();

$table = $_SESSION['administrator']['table'];
$datas = $_POST;
$columns = join(",", array_map(function ($key) {
  return "`$key`";
}, array_keys($datas)));
$values = join(",", array_map(function ($value) {
  if ($value == "") {
    return "NULL";
  }
  if (strval($value) !== strval(intval($value))) {
    return "'$value'";
  }

  return $value;
}, array_values($datas)));

$db = (new Database())->connect();
function insertRow($table, $columns, $values)
{
  global $db;
  try {
    $statement = $db->prepare("INSERT INTO `$table` ($columns) VALUES ($values)");
    $statement->execute();
  } catch (PDOException $e) {
    return $statement->errorInfo()[2];
  }

  return $statement->errorInfo()[2];
}
$message = insertRow($table, $columns, $values);
if ($message != null) {
  $_SESSION['administrator']['error'] = $message;
  $_SESSION['administrator']['columns'] = join(",", array_keys($datas));
  $_SESSION['administrator']['row'] = join(",", array_values($datas));
  header("Location: ../../?dashboard=administrator&administrator=form");
} else {
  unset($_SESSION['administrator']);
  header("Location: ../../?dashboard=administrator");
}
