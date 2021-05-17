<?php

namespace App\Models;

use Core\Database;

class Clientes {
  private $table = "clientes";

  public function login($email, $password) {
    $db = Database::getInstance();

    if (!empty($email) && !empty($password)) {
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);
      $data = $db->getList($this->table, '*', ['email' => $email]);
      $user = $data[0];

      if (isset($user['id_client'])) {
        if (password_verify($password,$user['password'])) {
          unset($user['password']);
          return $user;
        }           
      }
    }

    return false;
  }

  public function getAll(){
    $db = Database::getInstance();

    return $db->getList($this->table, "*");
  }

  public function getOne(int $id){
    $db = Database::getInstance();
    $userInfo = $db->getList($this->table, "*", ['id_client' => $id]);

    return $userInfo[0];
  }

  public function record_client($data = null) {
    $db = Database::getInstance();

    if($data != null && !empty($data)){
      if(isset($data['name']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

        $data = [
          'client_name' => $data['name'],
          'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
          'password' => password_hash($data['password'], PASSWORD_BCRYPT, ["cost" => 10]),
          'tell' => $data['tell'],
          'age' => intval($data['age']),
        ];

        return $db->insert($this->table, $data);
      }      
    }

    return false;
  }

  public function edit_client($data, $condition) {
    $db = Database::getInstance();

    if($data != null && !empty($data) && !empty($data['password'])){ // caso a senha SEJA alterada
      if(isset($data['name']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

        $data = [
          'id_client' => $condition['id_client'],
          'client_name' => $data['name'],
          'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
          'password' => password_hash($data['password'], PASSWORD_BCRYPT, ["cost" => 10]),
          'tell' => $data['tell'],
          'age' => intval($data['age']),
        ];

        return $db->update($this->table, $data, $condition);
      }      
    } elseif($data != null && !empty($data)) { // caso a senha NÃO SEJA alterada
      if(isset($data['name']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)){

        $data = [
          'id_client' => $condition['id_client'],
          'client_name' => $data['name'],
          'email' => filter_var($data['email'], FILTER_VALIDATE_EMAIL),
          'tell' => $data['tell'],
          'age' => intval($data['age']),
        ];

        return $db->update($this->table, $data, $condition);
      }
    }

    return false;
  }

  public function delete_client(int $id) {
    $db = Database::getInstance();

    return $db->delete($this->table, ['id_client' => $id]);
  }
}