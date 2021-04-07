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
        $this->form_validation->set_rules('task_assign[]', 'Task assign to developer','required');
        $this->form_validation->set_rules('status_task', 'STATUS OF Task', 'required');
        $this->form_validation->set_rules('status2_task', 'STATUS OF Task','required');
        $this->form_validation->set_rules('start_date', 'start date of task', 'required');
        $this->form_validation->set_rules('end_date', 'end date of task','required');
        if ($this->form_validation->run()) { 
            $task_id=$this->input->post('task_id');
            $task_name=$this->input->post('task_name');
            $task_description=$this->input->post('desc_task');
            $task_project_id=$this->input->post('task_project');
            $task_assign_developers=$this->input->post('task_assign[]');
            $task_status1=$this->input->post('status_task');
            $task_status2=$this->input->post('status2_task');
            $task_start_date=$this->input->post('start_date');
            $task_end_date=$this->input->post('end_date');
            //prepare array for update task data
            $task_data = array(
                'task_name' => $task_name,
                'task_description' => $task_description,
                'task_project_id'=>$task_project_id,
                'task_status1'=>$task_status1,
                'task_status2' => $task_status2,
                'task_start_date' => $task_start_date,
                'task_end_date'=>$task_end_date
            );

            //here old developer for task assign
            $pre_select_developers=$this->get_developer_by_task_id($task_id);
            $old_developers=array();
            foreach($pre_select_developers as $developer){  
                $old_developers[$developer['task_assign_developer_id']]=$developer['task_assign_developer_id'];
            }
            // echo '<br>';
            // echo "old_developers for task assign";
            // print_r($old_developers);

            //here new developer for task assign
            $new_developers=array();
            foreach($task_assign_developers as $developer){
                $new_developers[$developer]=$developer;
            }
            // echo'<br>';
            // echo "task assign to new developers";
            // print_r($new_developers);

            //find out insert developer id
            $new_developer_insert=array();
            foreach($new_developers as $new_developer){
                if(!array_key_exists($new_developer,$old_developers))
                {
                    $new_developer_insert[]=$new_developer;
                }
            }
            // echo'<br>';
            // echo "insert developers";
            // print_r($new_developer_insert);

            //find out delete manager id
            $new_developer_delete=array();
            foreach($old_developers as $old_developer){
                if(!array_key_exists($old_developer,$new_developers))
                {
                    $new_developer_delete[]=$old_developer;
                }
            }
            // echo'<br>';
            // echo "delete developers";
            // print_r($new_developer_delete);

            ///=========
            $this->load->model('task_model');
            $flag=$this->task_model->update_task_information($task_data,$task_id);

            if($flag){
                //delete project_maangers from project_assign.
                if(isset($new_developer_delete) && count($new_developer_delete)>0){
                    $delete_flag='';
                    $this->load->model('task_assign_model');
                    $delete_flag=$this->task_assign_model->delete_task_assign($new_developer_delete,$task_id);    
                }
                if(isset($new_developer_insert) && count($new_developer_insert)>0){
                    //insert maanger
                    foreach($new_developer_insert as $developer){
                        $project_assign_data[]=array(
                            'project_id'=>$task_project_id,
                            'task_id'=>$task_id,
                            'task_name' => $task_name,
                            'task_assign_developer_id'=>$developer
                        );
                    }
                    $this->load->model('task_assign_model');
                    $this->task_assign_model->submit_task_assign_information($project_assign_data);

                }
                if(isset($delete_flag)){
                    //after delete redirect
                    redirect('http://[::1]/ACL/index.php/view_task_handler');
                }

            }else{
                echo 'task not update';
            }

        } else { 
            $this->load->view('edit_task'); 
        }
    }
}
?>