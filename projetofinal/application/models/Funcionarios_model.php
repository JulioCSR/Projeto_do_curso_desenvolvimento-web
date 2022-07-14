<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionarios_model extends CI_Model {


    public function getUsersList(){
        // escolhe a tabela
        $this->db->from('funcionarios');

        // pega todos os registros
        $result = $this->db->get()->result();

        // coloca o resultado como saída (retorno) da função
        return $result;
    }

    public function novoFuncionarios($dados){
        /* tenta inserir $dados na tabela usuarios */
        if($this->db->insert('funcionarios', $dados)){
            return 'true'; // se der certo retorna true
        }else{
            return 'false'; // caso contrário retorna falso
        }
    }

    public function editarFuncionarios($id, $dados){
        /* seleciono o registro que eu quero alterar */
        $this->db->where('id', $id);

        /* tento fazer o update */
        if($this->db->update('funcionarios', $dados)){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function apagarFuncionarios($id){
        /* seleciono o registro que eu quero alterar */
        $this->db->where('id', $id);

        /* tento fazer o update */
        if($this->db->delete('funcionarios')){
            return 'true';
        }else{
            return 'false';
        }
    }

}