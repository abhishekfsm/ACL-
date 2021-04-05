<?php
class Registration_model extends CI_Model{
    //insert user data
    public function submit_user_registration($user_data){
        // print_r($user_data);
        $query = $this->db->get_where('users', array('user_email' => $user_data['user_email']));
        
        if($query->num_rows()<1){
          
            if($this->db->insert('users', $user_data)){
                $this->session->set_flashdata('success', 'Account Create Succcess');
                //now check flashdata if true then first ine send email and 2nd one redirect redirect('registration_handler');
		        redirect('dashboard_handler');
                }
                else{
                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('registration_handler');                   
                }
        }
        else{
            
            $this->session->set_flashdata('alert', 'user Account already exist');
		    redirect('registration_handler');
            

        }
    }


     // fetch  users data 
     public function get_users(){
        $query=$this->db->get('users');
        return $query->result_array(); 
        
    }
    //fetch users and roles data (with the help of join method)
    public function users_roles(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('roles', 'roles.role_id = users.user_role_id');
        $query = $this->db->get();
        return $query->result_array(); 


    }

    //fetch users data for special user_id
    public function get_user_by_id($user_id){
        // echo "model of users".$user_id;      
        $query=$this->db->get_where('users',array('user_id'=>$user_id));
        return $query->result_array(); 
        
    }

    //update users (add user_role_id)
    public function update($data){
        // echo "abhi";
        // print_r($data);
        $set_data = [
            'user_role_id' => $data['select_role'],
        ];
        $this->db->where('user_id', $data['user_id']);
        
        if($this->db->update('users', $set_data)){
            $this->session->set_flashdata('role_success', 'role assign Succcess');
            redirect("role_assign_handler/get_id/{$data['user_id']}");
        }
        else{
            $this->session->set_flashdata('alert', 'Something went wrong');
		    redirect("role_assign_handler/get_id/{$data['user_id']}"); 
        }
    }

    //fetch user data from users acoording to user_role_id'
    public function get_user_by_UserRoleId($role_id){
        $query=$this->db->get_where('users',array('user_role_id'=>$role_id));
        return $query->result_array(); 

    }



}
?>