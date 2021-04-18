<?php

namespace App\Models;

use Core\Database;

class Clientes {
  private $table = "clientes";

  public function getAll(){
    $db = Database::getInstance();

    return $db->getList($this->table, "*");
  }
}