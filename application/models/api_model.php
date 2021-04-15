<?php
class Api_model extends CI_Model{

    //for insert datat
    public function insert($data){
        if(isset($data) && count($data)>0){
            if($this->db->insert('api_user',$data)){
                return true;

            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    //fetch users
    public function get_users(){
        $query=$this->db->get('api_user');
        return $query->result_array();  
    }

    //delete user
    public function delete($id){
        if(isset($id)){
            $this->db->delete('api_user',array('id'=>$id));
            if($this->db->affected_rows()>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

   
    //update user
    public function update($data ,$id){
        if(isset($data) && isset($id) && count($data)>0){
            $this->db->where('id', $id);
            $this->db->update('api_user',$data);
            if($this->db->affected_rows()>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    
}
?>