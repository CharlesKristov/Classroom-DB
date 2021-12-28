<?php  
  class Kelas {
    private $db;

    public function __construct(PDO $db) {
      $this->db = $db;
    }

    public function getClass($class_id, $detail = false) {
      try {
        $statement = $detail ? 
        $this->db->prepare(
          "SELECT 
          `class`.`time`,
          `class`.`zoom_link` AS `url`,
          `class_type`.`name` AS `class_type`,
          `classroom`.`id` AS `classroom_number`,
          `classroom_type`.`name` AS `classroom_type`,
          `course`.`name` AS `course_name`, 
          `material`.`title` AS `material_title`, 
          `material`.`session`,
          CONCAT(`teacher`.`first_name`, ' ', `teacher`.`last_name`) AS `teacher_name`
          FROM `class` 
          JOIN `class_type` ON `class`.`type_id` = `class_type`.`id`
          JOIN `teacher` ON `class`.`teacher_id` = `teacher`.`id`
          JOIN `classroom` ON `class`.`classroom_id` = `classroom`.`id`
          JOIN `classroom_type` ON `classroom`.`type_id` = `classroom_type`.`id`
          JOIN `course_detail` ON `class`.`course_detail_id` = `course_detail`.`id` 
          JOIN `course` ON `course_detail`.`course_id` = `course`.`id` 
          JOIN `material` ON `course_detail`.`material_id` = `material`.`id`
          WHERE `class`.`id` = {$class_id}") : 
        $this->db->prepare("SELECT * FROM `class` WHERE id = {$class_id}");

        $statement->execute();
      } catch (PDOException $e) {
        echo $e;
        return "error";
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public function getClassType($class_type_id) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `class_type` WHERE id = {$class_type_id}");
        $statement->execute();
      } catch (PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
  }
?>