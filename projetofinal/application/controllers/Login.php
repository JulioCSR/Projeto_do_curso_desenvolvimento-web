<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    //para carregar o banco de dados
    public function __construct()
    {
            parent::__construct();
            $this->load->model('login_model');
    }

    public function index(){	
        $this->load->view('structure/header_login');
		$this->load->view('login');
	}

    public function login_user($alerta = null){


        //armazena os dados do formulario em variáveis
        $login = $this->input->post('login');
        $senha = $this->input->post('senha');
        
        // Verifico se as informações conferem com o banco de dados
        $result = $this->login_model->check_login($login, $senha);
        
        switch ($result) {
            case 'FALSE':
                //login inválido
                $alerta = array(
                "class" => "danger",
                "mensagem" => "Dados inválidos, senha ou login incorreto."
                );
                break;
            case 'TRUE':
                redirect('dashboard');
                break;
            default:
                //login inválido
                $alerta = array(
                "class" => "danger",
                "mensagem" => "Dados inválidos, entre em contato com o administrador."
                );
                break;
        }

        $dados = array(
            "alerta" => $alerta
		);
		$this->load->view('structure/header');
        $this->load->view('login', $dados);
    }

    /* Função para sair (logout) do sistema */
    public function sair(){
        $this->session->sess_destroy();
        $this->load->view('structure/header');
        $this->load->view('login');
    } 

}