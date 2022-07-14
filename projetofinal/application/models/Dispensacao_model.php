<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dispensacao_model extends CI_Model {


    public function getUsersList(){
        
        $this->db->from('dispensacao');

        
        $result = $this->db->get()->result();
                   
                        
        return $result;
               
    }

    /*public function soma(){
        $query = $this->db->query('SELECT sum(preco) As valor_total FROM dispensacao');
        
        return $query->result();
        
    }*/ // nao deu certo dessa forma.
    
    
     

    public function novoDispensacao($dados){
        
        if($this->db->insert('dispensacao', $dados)){
            return 'true'; 
        }else{
            return 'false';
        }
    }

    public function editarDispensacao($id, $dados){
        
        $this->db->where('id', $id);

       
        if($this->db->update('dispensacao', $dados)){
            return 'true';
        }else{
            return 'false';
        }
    }

    public function apagarDispensacao($id){
        
        $this->db->where('id', $id);

       
        if($this->db->delete('dispensacao')){
            return 'true';
        }else{
            return 'false';
        }
    }

     
    
}