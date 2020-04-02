<?php

class Data_hewan_model extends CI_Model{

    //untuk tampil semua data
    public function getLog($id = null){
        if($id === null){
            return $this->db->query("SELECT data_hewan.id_hewan, data_hewan.id_jenis, data_hewan.id_ukuran, data_hewan.nama, data_hewan.tgl_lhr, data_hewan.created_at, data_hewan.update_at, data_hewan.delete_at, data_hewan.id_pegawai_cs, data_hewan.id_pegawai_kasir, data_hewan.id_member,jenis_hewan.jenis , ukuran_hewan.ukuran , member.nama AS 'nama_member' FROM data_hewan JOIN jenis_hewan USING (id_jenis) JOIN ukuran_hewan USING (id_ukuran) JOIN member USING (id_member)")->result_array();
        } else{
            return $this->db->get_where('data_hewan', ['id_hewan' => $id]) ->result_array();
        }
        
    }

    //tidak menampilkan yang ter soft delete  
    public function getData_hewan($id_hewan = null){
        if($id_hewan === null){
            return $this->db->query("SELECT data_hewan.id_hewan, data_hewan.id_jenis, data_hewan.id_ukuran, data_hewan.nama, data_hewan.tgl_lhr, data_hewan.created_at, data_hewan.update_at, data_hewan.delete_at, data_hewan.id_pegawai_cs, data_hewan.id_pegawai_kasir, data_hewan.id_member,jenis_hewan.jenis , ukuran_hewan.ukuran , member.nama AS 'nama_member' FROM data_hewan JOIN jenis_hewan USING (id_jenis) JOIN ukuran_hewan USING (id_ukuran) JOIN member USING (id_member) WHERE data_hewan.delete_at IS NULL")->result_array();
        } else{
            return $this->db->get_where('data_hewan', ['id_hewan' => $id_hewan]) ->result_array();
        }
        
    }

    public function deleteData_hewan($data,$id_hewan){
        $this->db->update('data_hewan' , $data , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }

    public function hardDelete($id_hewan){
        $this->db->delete('data_hewan' , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }

    public function createData_hewan($data){
        $this->db->insert('data_hewan', $data);
        return $this->db->affected_rows();
    }

    public function updateData_hewan($data,$id_hewan){
        $this->db->update('data_hewan' , $data , ['id_hewan' => $id_hewan]);
        return $this->db->affected_rows();
    }
}