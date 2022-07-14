<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios extends CI_Controller {

    //para carregar o banco de dados
    public function __construct()
    {
            parent::__construct();
            $this->load->model('funcionarios_model');
    }

    public function index(){
        /* Função temPermissão definida ao final desse arquivo */
        if($this->temPermissao()){	
            $data['titulo'] = "Farmácia";
            $data['subtitulo'] = "Subtítulo da Página"; 

            $data['users'] = $this->funcionarios_model->getUsersList();

            $this->load->view('structure/header', $data);
            $this->load->view('funcionarios');
            $this->load->view('structure/footer');
        }else{
            /* caso o usuário não tenha permissão ele é redirecionado para a
            página de login */
            redirect('login');
        }
	}

    public function novoFuncionarios(){
        
        // Pego os dados enviados pelo $.post
        $dados['cpf'] = $this->input->post('cpf');
        $dados['nome'] = $this->input->post('nome');
        $dados['login'] = $this->input->post('login');
        $dados['senha'] = $this->input->post('senha');
        $dados['papel'] = $this->input->post('papel');
        $dados['status'] = $this->input->post('status');

        //envio para o meu model
        $retorno = $this->funcionarios_model->novoFuncionarios($dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output($retorno);
    }


    public function editarFuncionarios(){
        
        // Pego os dados enviados pelo $.post
        $id = $this->input->post('id');
        $dados['cpf'] = $this->input->post('cpf');
        $dados['nome'] = $this->input->post('nome');
        $dados['login'] = $this->input->post('login');
        $dados['papel'] = $this->input->post('papel');
        $dados['status'] = $this->input->post('status');

        //envio para o meu model
        $retorno = $this->funcionarios_model->editarFuncionarios($id, $dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output('true');
    }


    public function apagarFuncionarios($id){

        //envio para o meu model
        $data['retorno'] = $this->funcionarios_model->apagarFuncionarios($id);

        //recarrego minha view
		$data['titulo'] = "Farmácia";
		$data['subtitulo'] = "Subtítulo da Página"; 

        $data['users'] = $this->funcionarios_model->getUsersList();

        $this->load->view('structure/header', $data);
		$this->load->view('funcionarios');
        $this->load->view('structure/footer');
    }


    /* Verifica se o atual usuario tem permissão para acessar determinado recurso 
        para isso pego os dados sobre esse usuário da sessão
        e caso esses dados não atendam meus requisitos eu recuso o acesso dele
    */
    public function temPermissao(){
        $logged_in = $this->session->userdata('papel');
        $papel = $this->session->userdata('papel');

        if($logged_in == true && $papel == 'administrador'){
            return true;
        }else{
            return false;
        }
    }
}