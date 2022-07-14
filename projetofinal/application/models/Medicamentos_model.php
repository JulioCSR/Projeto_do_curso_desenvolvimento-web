<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicamentos_model extends CI_Model {


    public function getUsersList(){
        // escolhe a tabela
        $this->db->from('medicamentos');

        // pega todos os registros
        $result = $this->db->get()->result();

        // coloca o resultado como saída (retorno) da função
        return $result;
    }

    public function novoMedicamento($dados){
        /* tenta inserir $dados na tabela usuarios */
        if($this->db->insert('medicamentos', $dados)){
            return 'true'; // se der certo retorna true
        }else{
            return 'false'; // caso contrário retorna falso
        }
    }

    public function editarMedicamento($id, $dados){
        /* seleciono o registro que eu quero alterar */
        $this->db->where('id', $id);

        /* tento fazer o update */
        if($this->db->update('medicamentos', $dados)){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function apagarMedicamento($id){
        /* seleciono o registro que eu quero alterar */
        $this->db->where('id', $id);

        /* tento fazer o update */
        if($this->db->delete('medicamentos')){
            return 'true';
        }else{
            return 'false';
        }
    }

}