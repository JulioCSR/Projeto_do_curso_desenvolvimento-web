<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispensacao extends CI_Controller {

    
    public function __construct()
    {
            parent::__construct();
            $this->load->model('dispensacao_model');
    }


	public function index()
	{
		$data['titulo']= 'Farmácia';
        $data['subtitulo'] = 'Esse é o subtitulo';

        $data['users'] = $this->dispensacao_model->getUsersList();
        /*$data['total'] = $this->dispensacao_model->soma();*/ //não deu certo dessa forma.

               
        $this->load->view('structure/header', $data);
        $this->load->view('dispensacao');
        $this->load->view('structure/footer');
        
        
	}
    
    public function novoDispensacao(){
        
        
        $dados['data'] = $this->input->post('data');
        $dados['nome'] = $this->input->post('nome');
        $dados['papel'] = $this->input->post('papel');
        $dados['medicamentos'] = $this->input->post('medicamentos');
        $dados['quantidade'] = $this->input->post('quantidade');
        $dados['preco'] = $this->input->post('preco');

        
        $retorno = $this->dispensacao_model->novoDispensacao($dados);

       
        $this->output->set_output($retorno);
    }

    

    


    public function editarDispensacao(){
        
        
        $id = $this->input->post('id');
        $dados['data'] = $this->input->post('data');
        $dados['nome'] = $this->input->post('nome');
        $dados['papel'] = $this->input->post('papel');
        $dados['medicamentos'] = $this->input->post('medicamentos');
        $dados['quantidade'] = $this->input->post('quantidade');
        $dados['preco'] = $this->input->post('preco');
        
        
        $retorno = $this->dispensacao_model->editarDispensacao($id, $dados);

        
        $this->output->set_output('true');
    }


    public function apagarDispensacao($id){

        
        $data['retorno'] = $this->dispensacao_model->apagarDispensacao($id);

        
		$data['titulo'] = "Farmácia";
		$data['subtitulo'] = "Subtítulo da Página"; 

        $data['users'] = $this->dispensacao_model->getUsersList();

        $this->load->view('structure/header', $data);
		$this->load->view('dispensacao');
        $this->load->view('structure/footer');
    }
    


}