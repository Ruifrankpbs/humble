
<?php
defined ('BASEPATH') OR exit ('Você não tem permissão para acessar esse arquivo!');

class Home extends CI_Controller{

    // comentarios
    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->view('layout/header');
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }

    
}