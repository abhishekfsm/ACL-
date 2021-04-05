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
    public function delete_project($id){
        // echo "project-id data delete ==".$id;
        
        $this->db->where('project_id', $id);
        if($this->db->delete(array('projects','project_assign'))){
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

}
?>