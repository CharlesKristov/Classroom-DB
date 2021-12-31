<?php
include("../../database/Database.php");

session_start();

$table = $_SESSION['administrator']['table'];
$values = explode(",", $_SESSION['administrator']['row']);
$columns = explode(",", $_SESSION['administrator']['columns']);
$conditions = [];
foreach (array_combine($columns, $values) as $column => $value) {
  if (strtotime($value) != false || strval($value) !== strval(intval($value))) {
    continue;
  }
  $conditions = [...$conditions, "`$column`" . "=" . intval($value)];
}

$datas = $_POST;
$values = array_values($datas);
$columns = array_keys($datas);
$update = [];
foreach (array_combine($columns, $values) as $column => $value) {
  if (strtotime($value) != false || strval($value) !== strval(intval($value))) {
    $update = [...$update, "`$column`" . "=" . "'$value'"];
    continue;
  }
  $update = [...$update, "`$column`" . "=" . intval($value)];
}

$db = (new Database())->connect();
function updateRow($table, $update, $conditions)
{
  global $db;
  try {
    $statement = $db->prepare("UPDATE `$table` SET " . join(', ', $update) . " WHERE " . join(' AND ', $conditions));
    $statement = $db->prepare("UPDATE `$table` SET " . join(', ', $update) . " WHERE " . join(' AND ', $conditions));
    $statement->execute();
  } catch (PDOException $e) {
    return $statement->errorInfo()[2];
  }

  return $statement->errorInfo()[2];
}
$message = updateRow($table, $update, $conditions);
if ($message != null) {
  $_SESSION['administrator']['error'] = $message;
  $_SESSION['administrator']['columns'] = join(",", array_keys($datas));
  $_SESSION['administrator']['row'] = join(",", array_values($datas));
  header("Location: ../../?dashboard=administrator&administrator=form");
} else {
  unset($_SESSION['administrator']);
  header("Location: ../../?dashboard=administrator");
}
