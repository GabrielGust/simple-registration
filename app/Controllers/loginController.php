<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Clientes;
use Core\Request;
use Core\Session;

class LoginController extends Controller {
  private $session;

  public function __construct() {
    $this->session = Session::getInstance();
  }

  public function index(Request $request) {
    if ($request->isMethod('get')) {
      $this->view('login');

    } else {
      $email = preg_replace("/\s+/", "", $request->post('email'));
      $password = preg_replace("/\s+/", "", $request->post('password'));

      $userLogin = new Clientes();
      $user = $userLogin->login($email, $password);

      if($user) {
        $this->session->set('user', $user['id_client']);
        $this->redirect('/clientes');
      } 

      $this->view('login');
    } 
  }

  public function logout() {
    $users = $this->session->get('user');
    
    if($users){
      $this->session->destroy();
      $this->redirect('\login');
    } else {
      $this->redirect('\login');
    }    
  }
}