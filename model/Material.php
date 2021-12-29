<?php 
  class Material {
    private $db;

    public function __construct(PDO $db) {
      $this->db = $db;
    }

    public function getMaterial($material_id) {
      try {
        $statement = $this->db->prepare("SELECT * FROM `material` WHERE `id` = {$material_id}`");
      } catch(PDOException $e) {
        echo $e;
        return null;
      }
      return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
  }
