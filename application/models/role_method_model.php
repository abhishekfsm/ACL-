<?php
class Role_method_model extends CI_Model{

    public function index(){

    }

    public function insert_method_and_role($role_method_table_data){
        $query = $this->db->get_where('role_method', array('role_id' => $role_method_table_data['role_id'], 'method_id'=> $role_method_table_data['method_id']));
        
        if($query->num_rows()<1){
            if($this->db->insert('role_method', $role_method_table_data)){
                // $this->session->set_flashdata('success', 'roles Create Succcess');
                
		        // redirect('add_role_handler');
               
                }
                else{
                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('add_role_handler');                   
                }
        }
        else{
            // echo "alredy line exist";
            $this->session->set_flashdata('alert', 'role already exist');
		    redirect('add_role_handler');
    
        }
    }

    //get methods id from (role_method table) using where role_id exist
    public function get_method_id($id){
        $query=$this->db->get_where('role_method', array('role_id' => $id));
        return $query->result_array(); 

    }

    //here delete data 
    public function delete($role_id,$delete_method_id){
        // echo "delete data";
        // exit;
        if (!empty($delete_method_id)) {
            $this->db->where('role_id', $role_id);
            $this->db->where_in('method_id', $delete_method_id);
            $this->db->delete('role_method');
        }
       
    }

    
    //here insert new method and role data (which come on condition{edit role with method})
    public function new_method_role_insert($data){
        // echo "new insert data";
        // print_r($data);
        $this->db->insert_batch('role_method',$data);
    }

    //check method_id and role_id line number present in table 
    public function check_method_role_is_exist($role_id,$method_id){
        $query=$this->db->get_where('role_method', array('role_id' => $role_id,'method_id'=>$method_id));
        if( $query->num_rows()==1){
            return true;
        } else {
            return false;
        }
        // return $query->num_rows(); 
    }


}

?>