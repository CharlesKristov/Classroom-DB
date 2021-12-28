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

    
    public function getCourses($teacher_id) {
      try {
        $statement = $this->db->prepare("SELECT DISTINCT `course`.`id`, `class`.`classroom_id`, `class`.`id` AS `class_id` FROM  `course` 
        JOIN `course_detail` ON `course`.`id` = `course_detail`.`course_id` 
        JOIN `class` ON `course_detail`.`id` = `class`.`course_detail_id`
        JOIN `classroom` ON `class`.`classroom_id` = `classroom`.`id`
        WHERE `teacher_id` = {$teacher_id}
        GROUP BY `course`.`id`, `classroom`.`type_id`, `classroom`.`id`");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }

      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClasses($teacher_id) {
      try {
        $statement = $this->db->prepare("SELECT `class`.`id`, `class`.* FROM `class` 
          WHERE teacher_id = {$teacher_id}
          ORDER BY `class`.`time` ASC");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }

      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOngoingClass($teacher_id) {
      $classes = $this->getClasses($teacher_id);
      $current_class = null;
      $current_time = new DateTime();

      $minimal = PHP_INT_MAX;

      foreach($classes as $class) {
        $time = new DateTime($class['time']);
        $diff = date_diff($current_time, $time);
        $minutes = $diff->days * 24 * 60 + $diff->h * 60 + $diff->i;
        if($minutes < $minimal) {
          $current_class = $class;
          $minimal = $minutes; 
        }
      }

      return $current_class;
    }
  }
?>