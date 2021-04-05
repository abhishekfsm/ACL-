<?php
class view_role_handler extends CI_Controller{

    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('roles_model');
        $role_data['roles']=$this->roles_model->get_roles();
        // print_r($role_data);
        $this->load->view('view_role',$role_data);
        
    }
}


?>