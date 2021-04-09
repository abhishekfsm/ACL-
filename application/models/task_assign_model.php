<?php
class Task_assign_model extends CI_Model {
    //here insert task data
    public function submit_task_assign_information($task_assign_data){
        if(isset($task_assign_data)){
            if($this->db->insert_batch('task_assign', $task_assign_data)){
                // return true;
                redirect('http://[::1]/ACL/index.php/view_task_handler');
            } else{
                return false;
            }
        }else{
            return false;
        }
    }

    ///here fetch task assign developer_id by task_id
    public function get_pre_developers($task_id){
        if(isset($task_id)){
            $this->db->select('task_assign_developer_id');
            $this->db->from('task_assign');
            $this->db->where_in('task_id',$task_id);
            $query=$this->db->get();
            return $query->result_array();
        }else{
            return false;
        }
    } 


    //get assign task by developers
    public function get_task_by_developer($user_id){
        if(isset($user_id)){
            $this->db->select(array('tasks.task_id','tasks.task_name','tasks.task_description','projects.project_name','projects.status1',
            'tasks.task_status1','tasks.task_priority','tasks.task_start_date','tasks.task_end_date',
            ));
            $this->db->from('task_assign');
            $this->db->where('task_assign_developer_id',$user_id);
            $this->db->join('tasks', 'tasks.task_id = task_assign.task_id');
            $this->db->join('projects','projects.project_id=task_assign.project_id');
            $query = $this->db->get();
            return $query->result_array(); 

        }else{
            return false;
        }

    }

    //delete task_asssign by task_id
    public function delete_task_assign($data,$task_id){
        $this->db->where('task_id',$task_id);
        $this->db->where_in('task_assign_developer_id', $data);
        if($this->db->delete('task_assign')){
            return true;
        }else{
            return false;
        }
    }


    //get projects those project`s task assign to developers by developer_id
    public function get_projects($user_id){
        if(isset($user_id)){
                
            $this->db->select(array('projects.project_id','projects.project_name','projects.project_description',
            'projects.status1','projects.status2','projects.start_date','end_date'
            ));
            $this->db->from('task_assign');
            $this->db->where('task_assign_developer_id',$user_id);
            $this->db->join('projects','projects.project_id=task_assign.project_id');
            $query = $this->db->get();
            // print_r($query->result_array());
        
            return $query->result_array(); 
        }else{
            return false;
        }

    }
}
?>