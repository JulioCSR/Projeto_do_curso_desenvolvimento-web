<?php
defined('BASEPATH') 
OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('funcionarios_model');
    }
	
	public function index(){
        
        $papel = $this->session->userdata('papel');

        switch ($papel){
            case 'administrador':
                $data['titulo'] = "Farmácia";
                $data['subtitulo'] = "Subtítulo da Página"; 
        
                $data['users'] = $this->funcionarios_model->getUsersList();
        
                
                $this->load->view('structure/header', $data);
                $this->load->view('nova_pagina');
                $this->load->view('structure/footer');
                break;
            case 'auxiliar':
                 break;
            default:
                break;
        }   

	}
}