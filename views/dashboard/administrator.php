<?php
  global $db;

  $administrator = isset($_SESSION['administrator']) ? 'form' : 'manage';

  $statement = $db->prepare("SHOW TABLES");
  $statement->execute();
  $tableNameList = $statement->fetchAll(PDO::FETCH_COLUMN);
  $tableList = array_map(function($tableName) {
    global $db;
    try {
      $statement = $db->prepare("SELECT * FROM `$tableName`");
      $statement->execute();
    } catch(PDOException $e) {
      echo $e;
      return null;
    }
    return [$tableName => $statement->fetchAll(PDO::FETCH_ASSOC)];
  }, $tableNameList);
?>

<style>
  .scroll-horizontal {
    overflow-x: auto;
  }
</style>
<?php include("administrator/$administrator.php");?>