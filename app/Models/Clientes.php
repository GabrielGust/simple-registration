<?php

namespace App\Models;

use Core\Database;

class Clientes {
  private $table = "clientes";

  public function getAll(){
    $db = Database::getInstance();

    return $db->getList($this->table, "*");
  }

  public function record_client($data = null) {
    $db = Database::getInstance();

    //echo var_dump($data);

    if($data != null && !empty($data)){
      if(isset($data['name']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

        $data = [
          'client_name' => $data['name'],
          'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
          'tell' => $data['tell'],
          'age' => intval($data['age']),
        ];

        return $db->insert($this->table, $data);
      }      
    }

    return false;
  }
}