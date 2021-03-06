<?php

namespace App\Controllers;

use Core\Controller;
use Core\Request;
use App\Models\Clientes;
use Core\Session;

class ClientesController extends Controller {
    private $session;

    public function __construct() {
        $this->session = Session::getInstance();
    }
    
    public function index() {
        $users = $this->session->get('user');

        if($users){
            $clientsModel = new Clientes();
            $clients = $clientsModel->getAll();
            $id = $users;

            $this->view('clientes', ['clients' => $clients, 'idUser' => $id]);
        } else {
            $this->redirect('/login');
        }
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
        $users = $this->session->get('user');
        
        if($users){
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
        } else {
            $this->redirect('/login');
        }         
    }

    public function delete(Request $request){
        $users = $this->session->get('user');
        
        if($users){
            $clientId = $request->get();

            if ($clientId != null) {
                $clientsModel = new Clientes();
                $clients = $clientsModel->delete_client($clientId); 
                
                $this->redirect('/clientes');
            }
        } else {
            $this->redirect('/login');
        }                
    }
}