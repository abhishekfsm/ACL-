<?php
class Methods_model extends CI_Model{
    //insert methods data
    public function submit_methods($methods_data){
        print_r($methods_data);
        $query = $this->db->get_where('methods', array('method_name' => $methods_data['method_name']));
        
        if($query->num_rows()<1){
          
            if($this->db->insert('methods', $methods_data)){
                $this->session->set_flashdata('success', 'methods Create Succcess');
                //now check flashdata if true then first ine send email and 2nd one redirect redirect('registration_handler');
		        redirect('add_methods_handler');
                }
                else{
                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('add_methods_handler');                   
                }
        }
        else{
            
            $this->session->set_flashdata('alert', 'method already exist');
		    redirect('add_methods_handler');
            

        }
    }


     // fetch  methods data 
     public function get_methods(){
        $query=$this->db->get('methods');
        return $query->result_array(); 
        
    }


    // fetch methods data for special method_id
    public function get_method_by_id($id){      
        $query=$this->db->get_where('methods',array('method_id'=>$id));
        return $query->result_array(); 
        
    }

    //fetch method id using method name
    public function get_method_by_name($name){
        
        $query=$this->db->get_where('methods',array('method_name'=>$name));
       
        return $query->result_array();
    }
    
    //delete methods data on method id, simultaneously delete from role_method table
    public function delete_method($method_id){
        // echo "delete method data on id".$method_id;
        // exit; 
        $tables = array('methods','role_method');       
        $this->db->where('method_id', $method_id);
        if($this->db->delete($tables)){
            redirect('view_method_handler');
        }
    }




}
?>