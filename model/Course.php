<?php
class Course
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getCourseDetail($course_detail_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `course_detail` WHERE id = {$course_detail_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return null;
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getCourse($course_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `course` WHERE id = {$course_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return null;
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
