<?php 
class Tiket_model extends CI_Model{
    public function getTiket($id = null) {
        if($id != ''){
            return $this->db->get_where('tiket', array('id' => $id))->result();
        }else{
            return $this->db->get('tiket')->result();
        }
    }

    public function tambahDataTiket($data){
        $this->db->insert('tiket', $data);
        return $this->db->affected_rows();
    }

    public function hapusDataTiket($id){
        $this->db->where("id = $id");
        return $this->db->delete('tiket');;
    }

    public function ubahDataTiket($data){
        $this->db->where("id = '$data[id]'");
        return $this->db->update('tiket', $data);
    }
    
}