<?php
defined ('BASEPATH') OR exit ('Ação não Permitida!');

class Core_model extends CI_Model{

    //Recupera todos os usuários no DB
    public function get_all($tabela = NULL, $condicao = NULL) {
        if ($tabela){

            if(is_array($condicao)){
                $this->db->where($condicao);
            }

            return $this->db->get($tabela)->result();
         }else{
            return FALSE;
        }

    }
}


