<?php
class Role_assign_handler extends CI_Controller{
   
    
    // get users id and provide roles //TODO
    public function get_id($id=null){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        // echo $id;
        // echo "abhi";
        $this->load->model('registration_model');
        $user_data['user']=$this->registration_model->get_user_by_id($id);
        // print_r($user_data);
        // $this->load->view('role_assign.php',$user_data);
        $this->get_roles_with_method($user_data);

    }
    public function get_roles_with_method($user_data){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        
        $this->load->model('roles_model');
        $user_data['roles']=$this->roles_model->get_roles();
        $this->load->view('role_assign.php',$user_data);
       

    }
    //here collect role which is provide by admin and its update user registration table
    public function receive_role_by_admin(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        // print_r($_POST);
        $this->load->model('registration_model');
        $this->registration_model->update($_POST);

    }


}
?>