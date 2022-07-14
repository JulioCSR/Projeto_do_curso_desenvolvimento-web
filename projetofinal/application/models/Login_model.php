<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function check_login($login, $senha){       
        
        //selecionando minha tabela para busca
        $this->db->from('funcionarios');
       
        //estou buscando na tabela um registro com esse usuário e senha
        $this->db->where('login', $login);
        $this->db->where('senha', $senha);
        
        //executando a busca e armazenando o resultado nessa variável
        $result = $this->db->get();        
        $row = $result->row(); //armazeno os dados desse usuário nessa variável

        //se o resultado possuir um elemento (achei alguém com esse login e senha)
        if($result->num_rows() === 1){
            //usuario existe
            $session_data = array(
                'iduser' => $row->id,
                'name' => $row->nome,
                'role' => $row->papel,
            );
            //armazeno o resultado na sessão do navegador
            $this->set_session($session_data);
            return 'TRUE';
        }else{
            return 'FALSE';
        }
        
    }

    /* Função responsável por armazenar a sessão do usuário ativo no navegador
    isso impede que o login e senha sejam pedidos a ele a cada nova página do
    nosso sistema que ele visitar */
    public function set_session($session_data){
        $sess_data = array(
            'id' => $session_data['iduser'],
            'nome' => $session_data['name'],
            'papel' => $session_data['role'],
            'logged_in' => true //adiciono essa informação adicional, que ele está logado.
        );
        
        $this->session->set_userdata($sess_data);
    }


}