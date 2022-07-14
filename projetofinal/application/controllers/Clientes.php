<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    //para carregar o banco de dados
    public function __construct()
    {
            parent::__construct();
            $this->load->model('clientes_model');
    }


	public function index()
	{
		$data['titulo']= 'Farmácia';
        $data['subtitulo'] = 'Esse é o subtitulo';

        $data['users'] = $this->clientes_model->getUsersList();
        
        $this->load->view('structure/header', $data);
        $this->load->view('clientes');
        $this->load->view('structure/footer');
	}
    public function novoCliente(){
        
        // Pego os dados enviados pelo $.post
        $dados['cpf'] = $this->input->post('cpf');
        $dados['nome'] = $this->input->post('nome');
        $dados['telefone'] = $this->input->post('telefone');
        $dados['login'] = $this->input->post('login');
        $dados['senha'] = $this->input->post('senha');
        

        //envio para o meu model
        $retorno = $this->clientes_model->novoCliente($dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output($retorno);
    }


    public function editarCliente(){
        
        // Pego os dados enviados pelo $.post
        $id = $this->input->post('id');
        $dados['cpf'] = $this->input->post('cpf');
        $dados['nome'] = $this->input->post('nome');
        $dados['telefone'] = $this->input->post('telefone');
        $dados['login'] = $this->input->post('login');
        $dados['senha'] = $this->input->post('senha');
        
        //envio para o meu model
        $retorno = $this->clientes_model->editarCliente($id, $dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output('true');
    }


    public function apagarCliente($id){

        //envio para o meu model
        $data['retorno'] = $this->clientes_model->apagarCliente($id);

        //recarrego minha view
		$data['titulo'] = "Farmácia";
		$data['subtitulo'] = "Subtítulo da Página"; 

        $data['users'] = $this->clientes_model->getUsersList();

        $this->load->view('structure/header', $data);
		$this->load->view('clientes');
        $this->load->view('structure/footer');
    }
}