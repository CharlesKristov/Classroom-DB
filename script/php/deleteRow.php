<?php
  include("../../database/Database.php");

  $data = isset($_POST) ? $_POST : null;
  if(is_null($data)) {
    return;
  }
  
  $table = $data['table'];
  $columns = explode(",", $data['columns']);
  $row = explode(",", $data['row']);
  $conditions = [];
  foreach($columns as $index => $column) {
    if(strtotime($row[$index]) != false || strval($row[$index]) !== strval(intval($row[$index]))) {
      continue;
    }
    $conditions = [...$conditions, "`$column`"."=".intval($row[$index])];
  }

  $db = (new Database())->connect();
  try {
    $statement = $db->prepare("DELETE FROM `$table` WHERE ".join(" AND ", $conditions));
    $statement->execute();
  } catch(PDOException $e) {
    return;
  }

  echo "deleted ".json_encode(array_combine($columns, $row))." from table ".$table;
?>