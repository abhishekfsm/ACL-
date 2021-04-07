<?php
class Project_assign_model extends CI_Model{

    //here insert data
    public function submit_project_assign_information($project_assign_data){
       
        if($this->db->insert_batch('project_assign', $project_assign_data)){
            redirect('http://[::1]/ACL/index.php/view_project_handler');
        } 
    }
    
    //here fetch daata on project_id
    public function get_asssign_project($project_id){
        $this->db->select('project_id');
        $this->db->select('project_assign_manager_id');
        $query=$this->db->get_where('project_assign',array('project_id'=>$project_id));
        return $query->result_array();
    }

    //delete project_asssign data on project_assign_manager_id
    public function delete($data,$project_id){
        // echo 'project_assign moedle';
        // print_r($data);
        // exit;
        $this->db->where('project_id',$project_id);
        $this->db->where_in('project_assign_manager_id', $data);
        if($this->db->delete('project_assign')){
            return true;
        }else{
            return false;
        }
    } 

    //get project_id according to assign _proejct_manager
    public function get_project_id($user_id){
        if(isset($user_id)){
            // echo $user_id;
            $this->db->select('project_id');
            $query=$this->db->get_where('project_assign',array('project_assign_manager_id'=> $user_id));
            return $query->result_array();
        }else{
            return false;
        }
    }


    //get task related to assigned projects(join project assign +tasks)
    public function get_task_assign_project($user_id){
        if(isset($user_id)){
            $this->db->select(array('tasks.task_id','tasks.task_name','tasks.task_description','project_assign.project_name','projects.status1',
            'tasks.task_status1','tasks.task_status2','tasks.task_start_date','tasks.task_end_date',
            ));
            $this->db->from('project_assign');
            $this->db->where('project_assign_manager_id',$user_id);
            $this->db->join('tasks', 'tasks.task_project_id = project_assign.project_id');
            $this->db->join('projects','projects.project_id=project_assign.project_id');
            $query = $this->db->get();
            return $query->result_array(); 
        }
        else{
            return false;
        }
    }
}
?>