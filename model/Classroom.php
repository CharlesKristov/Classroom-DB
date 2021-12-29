<?php
class Classroom
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getClassroom($classroom_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `classroom` WHERE id = {$classroom_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getClassroomType($classroom_type_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `classroom_type` WHERE id = {$classroom_type_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return null;
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getClasses($student_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `classroom_detail` JOIN classroom ON `classroom_detail`.`classroom_id` = `classroom`.`id` JOIN classroom_type ON `classroom`.`type_id` = `classroom_type`.`id` WHERE student_id = {$student_id} ORDER BY `classroom`.`id`, `classroom_type`.`id`");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return null;
    }

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
