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

    public function edit(Request $request){
        if ($request->isMethod('get')) {
            $clientId = $request->get();
            $clientsModel = new Clientes();
            $client = $clientsModel->getOne($clientId);

            $this->view('index', ['clientInfo' => $client]);
        } else {
            $clientId = $request->get();
            $clientData = $request->post();
            $clientsModel = new Clientes();
            $client = $clientsModel->edit_client($clientData, ['id_client' => $clientId]);

            $this->redirect('/clientes');
        } 
    }

    public function delete(Request $request){
        $clientId = $request->get();

        if ($clientId != null) {
            $clientsModel = new Clientes();
            $clients = $clientsModel->delete_client($clientId); 
        }

        $this->redirect('/clientes');
    }
}