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
    
    
    //fetch users api of  specific id 
    public function get_users_byId($id){
        $this->db->where('id',$id);
        $query=$this->db->get('api_user');
        if($query->num_rows() >= 1){
            $this->db->where('id',$id);
            $query=$this->db->get('api_user');
            return $query->result_array();
        }else{
            return $query->num_rows();
        }

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
        $this->db->where('id', $id);
        $query=$this->db->get('api_user');
        if($query->num_rows()==1){
            $this->db->where('id', $id);
            $this->db->update('api_user',$data);
            if($this->db->affected_rows()>0){
                return "update";
            }else{
                return "not_update";
            }

        }else{
           
            return "user_not_found";
        }
    }

    
}
?>