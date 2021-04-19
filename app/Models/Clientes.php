<?php

namespace App\Models;

use Core\Database;

class Clientes {
  private $table = "clientes";

  public function getAll(){
    $db = Database::getInstance();

    return $db->getList($this->table, "*");
  }

  public function recordClient($data = null) {
    $db = Database::getInstance();

    if($data != null && !empty($data)){
      return $db->insert($this->table, $data);
    }

    return false;
  }
}