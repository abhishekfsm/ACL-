<?php
class Task_model extends CI_Model{
    //here insert task data
    public function submit_task_information($task_data){
        // echo"abhi";
        // print_r($task_data);
        $query = $this->db->get_where('tasks', array('task_name' => $task_data['task_name']));
        if($query->num_rows()<1){   

            if($this->db->insert('tasks', $task_data)) {

                $this->session->set_flashdata('task_success', 'task create Successfully');
                return $this->db->insert_id();
                //now check flashdata if true then first ine send email and 2nd one redirect redirect('registration_handler');
		        // redirect('view_task_handler');
                } else {

                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('task_handler');                  
                }
        } else {
            
            $this->session->set_flashdata('already_task', 'this task name already exist');
		    redirect('task_handler');
        }
    }

    //here fetch ttask view data
    public function get_tasks() {
        $query=$this->db->get('tasks');
        return $query->result_array();
    }
   

    //fetch project data on specific task id
    public function get_tasks_by_id($id){
        $query = $this->db->get_where('tasks', array('task_id' => $id));
        return $query->result_array();
    }

    //fetch tasks data and project name (with the help of join method)
    public function tasks_projects(){
        $this->db->select(array('tasks.task_id','tasks.task_name','tasks.task_description','projects.project_name',
            'tasks.task_status1','tasks.task_priority','tasks.task_start_date','tasks.task_end_date',
        ));
        $this->db->from('tasks');
        $this->db->join('projects', 'projects.project_id = tasks.task_project_id');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    //here fetch task data on special project_id
    public function get_tasks_by_project_id($project_id){
        // echo "model for ready for fetch task".$project_id;
        if(isset($project_id)){
            $this->db->select(array('tasks.task_id','tasks.task_name','tasks.task_description','projects.project_name','projects.status1',
            'tasks.task_status1','tasks.task_priority','tasks.task_start_date','tasks.task_end_date',
            ));
            $this->db->from('tasks');
            $this->db->where('task_project_id', $project_id);
            $this->db->join('projects', 'projects.project_id = tasks.task_project_id');
            $query = $this->db->get();
            return $query->result_array();

        }else{
            return false;
        }
    }
    

    //here delete task data on specific task id
    public function delete_task($id){
        if(isset($id)){
            $table=array('tasks','task_assign');
            $this->db->where('task_id', $id);
            if($this->db->delete($table)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    //here update task data come form edit task form
    public function update_task_information($task_data,$task_id){
        // echo 'task id on which update data'.$task_id;
        // print_r($task_data);
        $this->db->where('task_id',$task_id);
        if($this->db->update('tasks', $task_data)){
            // redirect('http://[::1]/ACL/index.php/view_task_handler');
            return true;
        }
        
    }

    //fetch tasks data and project name (with the help of join method)
    public function fetch_taskProject_by_task_id($task_id){
        $this->db->select(array('tasks.task_id','tasks.task_name','tasks.task_description',
                                'projects.project_id','projects.project_name','projects.status1',
                             'tasks.task_status1','tasks.task_priority','tasks.task_start_date',
                             'tasks.task_end_date',
        ));
        $this->db->from('tasks');
        $this->db->where('task_id',$task_id);
        $this->db->join('projects', 'projects.project_id = tasks.task_project_id');
        $query = $this->db->get();
        return $query->result_array(); 
    }
}
?>