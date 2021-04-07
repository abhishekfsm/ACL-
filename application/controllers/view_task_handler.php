<?php 
class View_task_handler extends CI_Controller{
    public function index(){
        //starting checking session
       
        $this->load->helper('session_checking');
        user_check();
        if($_SESSION['user_role_id']=='33'||$_SESSION['user_role_id']=='34'){
            $this->load->model('task_model');
       
            $this->load->model('project_assign_model');
            $task_data['tasks']=$this->project_assign_model->get_task_assign_project($_SESSION['user_id']);
            $task_data['button_name']=' NEW PROJECT';
            $this->load->view('view_task',$task_data);

        }else if ($_SESSION['user_role_id']=='35'){

            $this->load->model('task_assign_model');
            $task_data['tasks']=$this->task_assign_model->get_task_by_developer($_SESSION['user_id']); 
            $this->load->view('view_task',$task_data);
        }
        else{
            $this->load->view('view_task');
            echo 'no permission';
        }
    }

    //here function show task relarted to pass project_id
    public function view_task($project_id=null){
        if(isset($project_id)){
            // echo 'this project id related task come here'.$project_id;
            $this->load->model('task_model');
            $task_data['tasks']=$this->task_model->get_tasks_by_project_id($project_id);
            // print_r($task_data);
            if(isset($task_data) && count($task_data['tasks'])>0){
                $task_data['button_name']=$task_data['tasks'][0]['project_name'];
                $this->load->view('view_task',$task_data);
            }else{
                $this->load->view('view_task');    
            }

        }else{
            redirect('/ACL/index.php/view_project_handler');
        }
    }



    //get task id for delete task dta from tasks table of db
    public function delete_task($id=null){
        //here check perminsssion 
        $this->load->helper('session_checking');
        $permission_delete='';
        if(role_check('delete_task')) { 

            $permission_delete=true;
        } else {

            $permission_delete=false;
        }
        if(isset($id) && $permission_delete==true) {
            
            $this->load->model('task_model');
            $result=$this->task_model->delete_task($id);
            echo $result;
            print_r($result);
            exit;
            if($result=$this->task_model->delete_task($id)){
                redirect('view_task_handler');
            }

        } else {
            redirect('http://[::1]/ACL/index.php/view_task_handler');
        }
    }
}

?>