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
}
?>