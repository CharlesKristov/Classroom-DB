<?php
class Student
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getStudents()
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `student`");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getStudent($first_name, $last_name)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `student` WHERE first_name = '{$first_name}' AND `last_name` = '{$last_name}'");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getClassrooms($student_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `classroom_detail` WHERE `student_id` = {$student_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCourses($student_id)
  {
    try {
      $statement = $this->db->prepare("SELECT DISTINCT `course`.`id`, `class`.`classroom_id`, `class`.`id` AS `class_id` FROM  `course` 
        JOIN `course_detail` ON `course`.`id` = `course_detail`.`course_id` 
        JOIN `class` ON `course_detail`.`id` = `class`.`course_detail_id`
        JOIN `classroom` ON `class`.`classroom_id` = `classroom`.`id`
        JOIN `classroom_detail` ON `classroom`.`id` = `classroom_detail`.`classroom_id`
        WHERE `student_id` = {$student_id}
        GROUP BY `course`.`id`, `classroom`.`type_id`, `classroom`.`id`");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }


  public function getClasses($student_id)
  {
    try {
      $statement = $this->db->prepare(
        "SELECT `class`.`id`, `class`.* FROM `class` 
        JOIN `classroom` ON `class`.`classroom_id` = `classroom`.`id` 
        JOIN `classroom_detail` ON `classroom`.`id` = `classroom_detail`.`classroom_id` 
        WHERE student_id = {$student_id} 
        ORDER BY `class`.`time` ASC"
      );
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOngoingClass($student_id)
  {
    $classes = $this->getClasses($student_id);
    $current_class = null;
    $current_time = new DateTime();

    $minimal = PHP_INT_MAX;

    foreach ($classes as $class) {
      $time = new DateTime($class['time']);
      $diff = date_diff($current_time, $time);
      $minutes = $diff->days * 24 * 60 + $diff->h * 60 + $diff->i;
      if ($minutes < $minimal) {
        $current_class = $class;
        $minimal = $minutes;
      }
    }

    return $current_class;
  }
}
