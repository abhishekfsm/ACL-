<?php
class Roles_model extends CI_Model{

    //insert roles data
    public function submit_roles($roles_data){
        
        $query = $this->db->get_where('roles', array('role_name' => $roles_data['role_name']));
        
        if($query->num_rows()<1){
          
            if($this->db->insert('roles', $roles_data)){
                $this->session->set_flashdata('success', 'roles Create Succcess');
                //now check flashdata if true then first ine send email and 2nd one redirect redirect('registration_handler');
		        // redirect('add_role_handler');
                $last_id=$this->last_insert_id();
                return $last_id;
                }
                else{
                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('add_role_handler');                   
                }
        }
        else{
            
            $this->session->set_flashdata('alert', 'role already exist');
		    redirect('add_role_handler');
            

        }
    }


     // fetch  roles data for show with role
     public function get_roles(){
        $query=$this->db->get('roles');
        return $query->result_array(); 
        
    }
    //fetch role with alocated methods 
    public function get_role_with_methods($id){
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('roles.role_id', $id);
        $this->db->join('role_method', 'role_method.role_id = roles.role_id');
        $query = $this->db->get();
        return $query->result_array(); 

    }

    /// get last inserted id
    public function last_insert_id(){
        $insertId = $this->db->insert_id();
        return $insertId;
    }


    //fetch roles data for special user_id
    public function get_role_by_id($id){      
        $query=$this->db->get_where('roles',array('role_id'=>$id));
        return $query->result_array();    
    }

    //fetch role data on role name
    public function get_role_by_name($name){
        $query=$this->db->get_where('roles',array('role_name'=>$name));
        return $query->result_array();
    }


}
?>