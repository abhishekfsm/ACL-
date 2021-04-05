<?php
class View_project_handler extends CI_Controller{

    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        
        $this->load->model('project_assign_model');
        $project_ids=$this->project_assign_model->get_project_id($_SESSION['user_id']);
        if(isset($project_ids) && count($project_ids)>=1){

            $ids=array();
            foreach($project_ids as $project_id){
                $ids[]=$project_id['project_id'];
            }
            $this->load->model('project_model');
            $project_data['projects']=$this->project_model->get_project_assigned($ids);
            // print_r($project_data);
            $this->load->view('view_project',$project_data);
        }else{
            $this->load->view('view_project');
            // echo 'you have not assigned any  project';
        }

    }

    //here get project_id and delete data from bd on given id
    public function delete_project($project_id=null){
       
        //here check perminsssion 
        $this->load->helper('session_checking');
        $permission_delete='';
        if(role_check('delete_project')) { 

            $permission_delete=true;
        } else {

            $permission_delete=false;
        }
        if(isset($project_id) && $permission_delete==true) {

            $this->load->model('project_model');
            $this->project_model->delete_project($project_id);

        } else {
            redirect('http://[::1]/ACL/index.php/view_project_handler');
        }
    }
}


?>