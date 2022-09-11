<?php
defined ('BASEPATH') OR exit ('Ação não Permitida!');

//Classe que conterá todos os métodos para realizar ações dentro do DB
class Core_model extends CI_Model{

    //Função que Recupera todos os usuários no DB
    public function get_all($tabela = NULL, $condicao = NULL) {
        if ($tabela){//Se a Tabela Existir faça...

            if(is_array($condicao)){ //se a Condição Existir e for um array faça...
                $this->db->where($condicao);//... Faça um where no banco com esta Condição
            }

            return $this->db->get($tabela)->result();//Retorne uma listagem da Tabela no DB dos itens conforme a condição
         }else{
            return FALSE;//Senão Retorne Falso
        }

    }

    //Função que recupera um dado específico da tabela utilizando o id
    public function get_by_id($tabela = NULL, $condicao = NULL) {
        if($tabela && is_array($condicao)){//Se a tabela existir e a Condição existir e for um array Faça...

            $this->db->where($condicao);//...Faça uma busca no DB conforme a codição...

            $this->db->limit(1);//Limite a busca em uma linha

            return $this->db->get($tabela)->row();//Retorne do DB uma linha da tabela passada anteriormente
        }else{//senão

            return FALSE;//Retorne Falso.
        
        }
    }

    //Função para inserir dados na tabela
    public function insert($tabela = NULL,$data = NULL, $get_last_id = NULL){
        if($tabela && is_array($data)){//Se a tabela existir e data exisitr e for um array faça...


            $this->db->insert($tabela, $data);//insira na tabela o data informado

            if($get_last_id) {//se Get_last_id existir

                $this->$_SESSION->set_userdata('last_id',$this->db->insert_id());//coloque no campo last_id o ultimo id inserido
            }

            if($this->db->affected_rows() > 0){//Se o numero de linhas afetadas no DB for maior que zero faça...

                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');//Envie na sessão a mensagem de salvo com sucesso

            }else{//Senão...

                $this->session->set_flashdata('error', 'Erro ao salvar dados no DB');//Enviar na sessao a mensagem de erro ao salvar no banco de dados

            }
        }
    }

    //Função que atualiza o Banco de Dados
    public function update($tabela = NULL, $data = NULL, $condicao = NULL) {

        if ($tabela && is_array($data) && is_array($condicao)) {//Se a tabela existe e data existir e for um array e condição existir e for um array faça...

            if ($this->db->update($tabela, $data, $condicao)) {//Se tabela. data e condição existirem faça a atualização no DB...

                $this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');//Envie uma mensagem Dados salvos com sucesso na sessão...
            } else {//Senão...
                
                $this->session->set_flashdata('error', 'Erro ao atualizar os dados');//Envie a mensagem Erro ao atualizar os dados na sessão 
            }
            
        } else {//Senão...
            return FALSE;//Retorne falso
        }
        
    }

    //Função que deleta informações no Banco de Dados
    public function delete($tabela = NULL, $condicao = NULL){

        $this->db->debug = FALSE;//Desabilita a função debug do Codeignite

        if($tabela && is_array($condicao)) {//Se Tabela exisitir e COndição existir e for um array faça...
            
            $status = $this->db->delete($tabela, $condicao);// Status recebe o resultado da deleção no DB


            $error = $this->db->error();//Variavel error vai armazenar erro de chave estrangeira que ocorrer no banco.

            if (!$status) {//Se status não existir
                foreach ($error as $code){//Para cada...(Error agora é Code)
                    if ($code == 1451) {//se Code é igual a 1451 faça...
                        $this->session->set_flashdata('error', 'Esse registro está sendo utilizado em outra tabela e não pode ser deletada');//Enviar mensagem para sesssion Esse registro está sendo utilizado em outra tabela e não pode ser deletada
                    }
                }

            } else {//Senão...
                $this->session->set_flashdata('sucesso', ' Registro excluído com sucesso');//Enviar mensagem para session Registro excluído com sucesso
            }

            $this->db->debug = TRUE;//Habilita a função debug do Codeignite
            
        }else{//Senão...

            return FALSE;//Retorna falso

        }

    }
}


