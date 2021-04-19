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

     public function registerUser(Request $request){
        if ($request->isMethod('get')) {
            $this->view('index');
        } else {
            $clientModel = new Clientes();

            $data = [
                'client_name' => $request->post('name'),
                'email' => filter_var($request->post('email'), FILTER_VALIDATE_EMAIL),
                'tell' => $request->post('tell'),
                'age' => intval($request->post('age')),
            ];

            $response = $clientModel->recordClient($data);

            $this->view('confirmacao', ['user' => $data, 'response' => $response]);
        }
    }
}