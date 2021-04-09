<?php
class Project_model extends CI_Model{

    //insert blog data 
    public function submit_project_information($project_data){
        // echo "abhi project";
        // print_r($project_data);
        
        $query = $this->db->get_where('projects', array('project_name' => $project_data['project_name']));
        if($query->num_rows()<1){   

            if($this->db->insert('projects', $project_data)) {

                $this->session->set_flashdata('project_success', 'project create Successfully');
                //now check flashdata if true then first ine send email and 2nd one redirect redirect('registration_handler');
		        return $this->db->insert_id();
                } else {

                    $this->session->set_flashdata('alert', 'Something went wrong');
		            redirect('project_handler');                  
                }
        } else {
            
            $this->session->set_flashdata('already_project', 'this project name already exist');
		    redirect('project_handler');
        }
    }
    
    //fetch all projects data
    public function get_projects() {
        $query=$this->db->get('projects');
        return $query->result_array();
    }

    //fetch projects name and ids
    public function fetch_projects_name(){
        $this->db->select('project_id, project_name');
        $query = $this->db->get('projects');
        return $query->result_array();
        
    } 

    
    //fetch project data on specific preoject id
    public function get_project_by_id($id){
        $query = $this->db->get_where('projects', array('project_id' => $id));
        return $query->result_array();
        // print_r($result);
        // echo "fetch project data of this id=".$id;
    }

    //here delete project data on specific project id
    //when on eproject delete then project related task,task assign,project_asisgn will be deleted 
    public function delete_project($id){
        // echo "project-id data delete ==".$id;
        $this->db->where('project_id', $id);
        $this->db->delete(array('projects','project_assign','task_assign'));
        $affected_rows = $this->db->affected_rows();
        // echo "abhiiiiii";
        // print_r($affected_rows);
        if($affected_rows>0){
            return true;
        }else{
            return  false;
        }
        
    }

    //here delete project's task 
    public function delete_tasks_of_projects($id){
        echo "s2";
        $this->db->query("DELETE from tasks WHERE task_project_id = '$id' ");
        // $this->db->delete('tasks',array('task_project_id'=>$id));
        $affected_rows = $this->db->affected_rows();
        print_r($affected_rows);
        if($affected_rows>0){
            redirect('http://[::1]/ACL/index.php/view_project_handler');
        }
    }

    //here project data update
    public function update_project_information($project_data,$id){
      
        $this->db->where('project_id', $id);
        if($this->db->update('projects', $project_data)){
            // redirect('http://[::1]/ACL/index.php/view_project_handler');
            return true;
        }else{
            return false;
        }
    }

    //get project_data on based project_ids using where_in
    public function get_project_assigned($data){
        if(isset($data) && count($data)>=1) {
            $this->db->where_in('project_id',$data);
            $query=$this->db->get('projects');
            return $query->result_array();
        } else {
            return false;
        }
        
    }

    //get assign  project name and project id ,,only those user login 
    public function get_project_name($user_id){
        if(isset($user_id)){
            $this->db->select(array('projects.project_id','projects.project_name','projects.status1'));
            $this->db->from('project_assign');
            $this->db->where_in('project_assign_manager_id',$user_id);
            $this->db->join('projects','projects.project_id=project_assign.project_id');
            $query=$this->db->get();
            return $query->result_array();
        }else{
            return false;
        }
    }

}
?>