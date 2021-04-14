<?php
class Home_handler extends CI_Controller{
    public function index(){
        $this->load->model('project_model');
        $project_data['projects']=$this->project_model->get_project_form_homePage();
        // print_r($project_data);
        $this->load->view('home',$project_data);
    }
}
?>