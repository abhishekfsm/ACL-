<?php
class View_method_handler extends CI_Controller {

    public function index(){
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('methods_model');
        $method_data['methods']=$this->methods_model->get_methods();
        // print_r($role_data);
        $this->load->view('view_method',$method_data);    
    }

    //get method id and delete data from (methods,role_method tables)
    public function get_id($method_id=null){
        $this->load->helper('session_checking');
        user_check();
        // echo "method_id=".$method_id;
        $this->load->model('methods_model');
        $this->methods_model->delete_method($method_id);
    }
}
?>