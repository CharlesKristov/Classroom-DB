<?php  
  class Teacher {
    private $db;

    public function __construct(PDO $db) {
      $this->db = $db;
    }

    public function getTeacher($first_name, $last_name) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `teacher` WHERE first_name = '{$first_name}' AND `last_name` = '{$last_name}'");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getTeacherById($teacher_id) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `teacher` WHERE id = {$teacher_id}");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getClassrooms($teacher_id) {
      try {
        $statement = $this->db->prepare("SELECT DISTINCT `classroom_id` FROM `class` WHERE `teacher_id` = {$teacher_id}");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>