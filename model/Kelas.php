<?php  
  class Kelas {
    private $db;

    public function __construct(PDO $db) {
      $this->db = $db;
    }

    public function getClass($class_id) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `class` WHERE id = {$class_id}");
        $statement->execute();
      } catch (PDOException $e) {
        echo $e;
        return null;
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

    public function getClasses($student_id) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `class` JOIN `classroom` ON `class`.`classroom_id` = `classroom`.`id` JOIN classroom_type ON `classroom`.`type_id` = `classroom_type`.`id` JOIN `classroom_detail` ON `classroom`.`id` = `classroom_detail`.`classroom_id` WHERE `student_id` = {$student_id} ORDER BY `time`");
        $statement->execute();
      } catch(PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOngoingClass($student_id) {
      $classes = $this->getClasses($student_id);
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