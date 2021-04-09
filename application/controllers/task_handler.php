<?php 
class  task_handler extends CI_Controller{

    public function index() {
        //starting checking session
        // $this->load->helper('session_checking');
        // user_check();
        //starting admin check through session
        $this->load->helper('session_checking');
        //calling for role check and check method here{ add_task is the name of method which is allocated to admin}
        if(role_check('add_task')) { 
            $this->load->model('project_model');
            $project_data['projects']=$this->project_model->get_project_name($_SESSION['user_id']);

            //get developer===

            $this->load->model('roles_model');
            $project_data['developers']=$this->roles_model->get_developer('developer');

            //======end=======
            $this->load->view('add_task',$project_data);
        } else{
            redirect('http://[::1]/ACL/index.php/view_task_handler');
        }

    }
    public function add_task(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('task_name', 'Task NAME', 'required');
        $this->form_validation->set_rules('desc_task', 'DESCRIPTION OF Task','required');
        $this->form_validation->set_rules('task_project', 'DESCRIPTION OF Task','required');
        $this->form_validation->set_rules('task_assign[]', 'Task assigned to developer','required');
        $this->form_validation->set_rules('status_task', 'STATUS OF Task', 'required');
        $this->form_validation->set_rules('task_priority', 'PRIORITY OF Task','required');
        $this->form_validation->set_rules('start_date', 'start date of task', 'required');
        $this->form_validation->set_rules('end_date', 'end date of task','required');
        if ($this->form_validation->run()) { 

            $task_name=$this->input->post('task_name');
            $task_description=$this->input->post('desc_task');
            $task_project_id=$this->input->post('task_project');
            $task_assign_developers=$this->input->post('task_assign[]');
            $task_status1=$this->input->post('status_task');
            $task_priority=$this->input->post('task_priority');
            $task_start_date=$this->input->post('start_date');
            $task_end_date=$this->input->post('end_date');
            $task_data = array(
                'task_name' => $task_name,
                'task_description' => $task_description,
                'task_project_id'=>$task_project_id,
                'task_status1'=>$task_status1,
                'task_priority' => $task_priority,
                'task_start_date' => $task_start_date,
                'task_end_date'=>$task_end_date
            );    
        
            $this->load->model('task_model');
            $task_id=$this->task_model->submit_task_information($task_data);
            if($task_id) {
                //array prepare for task assign
                foreach($task_assign_developers as $developer){
                    $task_assign_data[]=array(
                        'project_id'=>$task_project_id,
                        'task_id'=>$task_id,
                        'task_name'=>$task_name,
                        'task_assign_developer_id'=>$developer
                    );
                }
                $this->load->model('task_assign_model');
                if($this->task_assign_model->submit_task_assign_information($task_assign_data)){
                    redirect('view_task_handler');
                }else{
                    echo 'task not assigned';
                }
            }else{
                echo 'somethimg went wrong regarding to task_id';
                redirect('view_task_handler');
            }

        }
        else{ 
            $this->load->view('add_task'); 
        }


    }
}
?>
