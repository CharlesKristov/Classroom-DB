<?php
class Organization
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getOrganization($organization_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `organization` WHERE id = {$organization_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function getOrganizations($student_id)
  {
    try {
      $statement = $this->db->prepare("SELECT * FROM `organization_detail` WHERE student_id = {$student_id}");
      $statement->execute();
    } catch (PDOException $e) {
      echo $e;
      return [];
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}
