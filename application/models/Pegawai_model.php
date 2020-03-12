<?php

class Pegawai_model extends CI_Model{


    public function getPegawai($id_pegawai = null){
        if($id_pegawai === null){
            return $this->db->get('pegawai')->result_array();
        } else{
            return $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai]) ->result_array();
        }
        
    }

    public function deletePegawai($id_pegawai){
        $this->db->delete('pegawai' , ['id_pegawai' => $id_pegawai]);
        return $this->db->affected_rows();
    }

    public function createPegawai($data){
        $this->db->insert('pegawai', $data);
        return $this->db->affected_rows();
    }

    public function updatePegawai($data,$id_pegawai){
        $this->db->update('pegawai' , $data , ['id_pegawai' => $id_pegawai]);
        return $this->db->affected_rows();
    }

    // BUAT LOGIN

    public function login($username = null, $password = null){
        if($username === null || $password === null){
            return $this->db->get('pegawai')->result_array();
        } else{
            return $this->db->get_where('pegawai', ['username' => $username], ['password' => $password]) ->result_array();
        }
        
    }
    
}

    // function isNotLogin(){
    //     return $this->session->userdata('user_logged') === null;
    // }

    // private function _updateLastLogin($user_id){
    //     $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
    //     $this->db->query($sql);
    // }
