<?php

namespace App\Controllers;

use Core\Controller;

use App\Models\Clientes;

class ClientesController extends Controller {
    
    public function index() {
        $pageTitle = 'Clientes cadastrados';
        $title = "Lista de clientes";
        $content = "<p>Veja os clientes:</p>";

        $clientsModel = new Clientes();

        $clients = $clientsModel->getAll();
        var_dump($clients);

        $showInfo = ['pageTitle' => $pageTitle, 'title' => $title, 'clients' => $clients];

        $this->view('clientes', $showInfo);
    }
}