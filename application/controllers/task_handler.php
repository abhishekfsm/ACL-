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
            $project_data['projects']=$this->project_model->fetch_projects_name();
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
        $this->form_validation->set_rules('status_task', 'STATUS OF Task', 'required');
        $this->form_validation->set_rules('status2_task', 'STATUS OF Task','required');
        $this->form_validation->set_rules('start_date', 'start date of task', 'required');
        $this->form_validation->set_rules('end_date', 'end date of task','required');
        if ($this->form_validation->run()) { 

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
            // print_r($task_data);
            $this->load->model('task_model');
            $this->task_model->submit_task_information($task_data);

        }
        else{ 
            $this->load->view('add_task'); 
        }


    }
}
?>
