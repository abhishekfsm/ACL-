<?php
class Task_assign_model extends CI_Model {
    //here insert task data
    public function submit_task_assign_information($task_assign_data){
        if(isset($task_assign_data)){
            if($this->db->insert_batch('task_assign', $task_assign_data)){
            return true;
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
}
?>