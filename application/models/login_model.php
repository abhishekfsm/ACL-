<?php
class Login_model extends CI_Model{
    public function get_user_data($user_email,$user_password){
        // echo "email ".$user_email."password ".$user_password;
        $query = $this->db->get_where('users', array('user_email' => $user_email));
        
        if($query->num_rows()==1){
            // echo "collect data for checking credential";
            return $query->result_array();
            // print_r($result);
        }
        else{
            $this->session->set_flashdata('invalid email', 'User are not registered ,firstly registered yourself');
            redirect('login_handler');
            // echo "user are not registered";
        }

    }

    //here get user with assign role name
    //fetch users and roles data (with the help of join method)
    public function users_roles($user_email,$user_password){
        $this->db->select(array('users.user_id','users.user_name','users.user_email','users.user_password','users.user_role_id','roles.role_name','users.user_image'));
        $this->db->from('users');
        $this->db->where(array('user_email' => $user_email,'user_password'=>$user_password));
        $this->db->join('roles', 'roles.role_id = users.user_role_id');
        $query = $this->db->get();
        if($query->num_rows()==1){
            // echo "collect data for checking credential";
            return $query->result_array();
            // print_r($result);
        }
        else{
            $this->session->set_flashdata('invalid email', 'User are not registered ,firstly registered yourself');
            redirect('login_handler');
            // echo "user are not registered";
        }
        


    }
}
?>