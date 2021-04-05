<?php
class Dashboard_handler extends CI_Controller{

    ////
    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('registration_model');
        $data['users_data']=$this->registration_model->users_roles();
        // print_r($data);
        // exit;
        $this->load->view('dashboard',$data);
        // if(isset($_POST['id'])){
        //     $id=$_POST['id'];
        //     $this->blog_model->delete_blog($id);
        //     echo $id;
            
        // }
        // // echo $_GET['id'];
        // if(isset($_GET['id'])){ 
        //     $id=$_GET['id'];
        //     $this->blog_model->delete_blog($id);
        // }
    }

   

}

?>