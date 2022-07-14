<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicamentos extends CI_Controller {

    //para carregar o banco de dados
    public function __construct()
    {
            parent::__construct();
            $this->load->model('medicamentos_model');
    }


	public function index()
	{
		$data['titulo']= 'Farmácia';
        $data['subtitulo'] = 'Esse é o subtitulo';

        $data['users'] = $this->medicamentos_model->getUsersList();
        
        $this->load->view('structure/header', $data);
        $this->load->view('medicamentos');
        $this->load->view('structure/footer');
	}

    public function novoMedicamento(){
        
        // Pego os dados enviados pelo $.post
        $dados['nome_comercial'] = $this->input->post('nome_comercial');
        $dados['principio_ativo'] = $this->input->post('principio_ativo');
        $dados['quantidade'] = $this->input->post('quantidade');
        $dados['preco'] = $this->input->post('preco');
        
        

        //envio para o meu model
        $retorno = $this->medicamentos_model->novoMedicamento($dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output($retorno);
    }
    public function editarMedicamento(){
        
        // Pego os dados enviados pelo $.post
        $id = $this->input->post('id');
        $dados['nome_comercial'] = $this->input->post('nome_comercial');
        $dados['principio_ativo'] = $this->input->post('principio_ativo');
        $dados['quantidade'] = $this->input->post('quantidade');
        $dados['preco'] = $this->input->post('preco');
                
        //envio para o meu model
        $retorno = $this->medicamentos_model->editarMedicamento($id, $dados);

        //retorno pra minha view se está ok ou não.
        $this->output->set_output('true');
    }


    public function apagarMedicamento($id){

        //envio para o meu model
        $data['retorno'] = $this->medicamentos_model->apagarMedicamento($id);

        //recarrego minha view
		$data['titulo'] = "Farmácia";
		$data['subtitulo'] = "Subtítulo da Página"; 

        $data['users'] = $this->medicamentos_model->getUsersList();

        $this->load->view('structure/header', $data);
		$this->load->view('medicamentos');
        $this->load->view('structure/footer');
    }
}