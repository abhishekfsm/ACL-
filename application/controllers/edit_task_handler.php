<?php
class edit_task_handler extends CI_Controller{

    public function edit_task($id=null){
        // echo "update of this ids tasks table".$id;
        //here check perminsssion 
        $this->load->helper('session_checking');
        $permission_edit='';
        if(role_check('edit_task')) { 
            
            $permission_edit=true;
        } else {

            $permission_edit=false;
        }
        
        if(isset($id) && $permission_edit==true){
            $this->load->model('task_model');
            $task_data['tasks']=$this->task_model->get_tasks_by_id($id);
            $task_data['projects']=$this->fetch_project_name_id($task_data);
            //get all  developer for assign task===
            $this->load->model('roles_model');
            $task_data['developers']=$this->roles_model->get_developer('developer');
            //======end=======

            //pre select developer===
            $task_data['pre_select_developers']=$this->get_developer_by_task_id($id);
            ///=========end==========
            $this->load->view('edit_task',$task_data);

        } else {
            redirect('http://[::1]/ACL/index.php/view_task_handler');
        }
    }

    //here fetch project name with id 
    private function fetch_project_name_id($task_data){
        $this->load->model('project_model');
        return  $this->project_model->fetch_projects_name();
    }

    //here fetch (developer name and ids) pre selected developer for task 
    private function  get_developer_by_task_id($task_id){
        if(isset($task_id)){
            $this->load->model('task_assign_model');
            return $this->task_assign_model->get_pre_developers($task_id);

        }else{
            redirect('view_task_handler');
        }

    } 


    //here receive updated task data from edit task form
    public function receive_edit_task(){        
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('task_name', 'Task NAME', 'required');
        $this->form_validation->set_rules('desc_task', 'DESCRIPTION OF Task','required');
        $this->form_validation->set_rules('task_project', 'DESCRIPTION OF Task','required');
        $this->form_validation->set_rules('status_task', 'STATUS OF Task', 'required');
        $this->form_validation->set_rules('status2_task', 'STATUS OF Task','required');
        $this->form_validation->set_rules('start_date', 'start date of task', 'required');
        $this->form_validation->set_rules('end_date', 'end date of task','required');
        if ($this->form_validation->run()) { 
            $task_id=$this->input->post('task_id');
            $task_name=$this->input->post('task_name');
            $task_description=$this->input->post('desc_task');
            $task_project_id=$this->input->post('task_project');
            $task_status1=$this->input->post('status_task');
            $task_status2=$this->input->post('status2_task');
            $task_start_date=$this->input->post('start_date');
            $task_end_date=$this->input->post('end_date');
            $task_data = array(
                'task_name' => $task_name,
                'task_description' => $task_description,
                'task_project_id'=>$task_project_id,
                'task_status1'=>$task_status1,
                'task_status2' => $task_status2,
                'task_start_date' => $task_start_date,
                'task_end_date'=>$task_end_date
            );    
            print_r($task_data);
            exit;

            ///here prepare array for upate assign_task_to developers
            
            $this->load->model('task_model');
            $this->task_model->update_task_information($task_data,$task_id);

        } else { 
            $this->load->view('edit_task'); 
        }
    }
}
?>