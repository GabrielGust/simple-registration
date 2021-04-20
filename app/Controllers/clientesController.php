<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\Clientes;

class ClientesController extends Controller {
    
    public function index() {
        $clientsModel = new Clientes();
        $clients = $clientsModel->getAll();

        $this->view('clientes', ['clients' => $clients]);
    }

     public function register_user(Request $request){
        if ($request->isMethod('get')) {
            $this->view('index');
        } else {
            $clientModel = new Clientes();         
            $response = $clientModel->record_client($request->post());

            $this->view('confirmacao', ['user' => $request->post(), 'response' => $response]);
        }
    }
}