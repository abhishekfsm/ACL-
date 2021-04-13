<?php
class edit_project_handler extends CI_Controller{
    public function index(){

    }

    //here get project_id from bd on given id and edit project data and update its data 
    public function edit_project($project_id=null){
        //here check perminsssion 
        $this->load->helper('session_checking');
        $permission_edit='';
        if(role_check('edit_project')) { 

            $permission_edit=true;
        } else {

            $permission_edit=false;
        }
        
        if(isset($project_id) && $permission_edit==true){
            //1=========fetch project manager data
            $this->load->model('roles_model');
            //calling model for fetch role_id of "project_manger"
            $roles=$this->roles_model->get_role_by_name('project manager');
            $role_id='';
            if(isset($roles) && count($roles)==1){
                $role_id=$roles[0]['role_id'];
                // echo $role_id;
                $this->load->model('registration_model');
                $project_data['project_managers']=$this->registration_model->get_user_by_UserRoleId($role_id);
            
            }
            //==========end =====================

            //2===here fetch project predefine data====
            $this->load->model('project_model');
            $project_data['project']=$this->project_model->get_project_by_id($project_id);
            //======end================================

            //3===here fetch project_assign data========
            //calling private function 
            $project_data['project_assign_old']=$this->get_project_assign($project_id);
            //=================end====================

            $this->load->view('edit_project',$project_data); 
        }
        else{
            redirect('http://[::1]/ACL/index.php/view_project_handler');
        }
    }


    //private function for fetch project assign to project manager data (related to 3 type data)
    private function get_project_assign($project_id){
        $this->load->model('project_assign_model');
        return $this->project_assign_model->get_asssign_project($project_id);
    } 

    //here get all update data of edit project form and receive and update it
    public function collect_project_info(){
        $project_assign_old=$this->get_project_assign($_POST['project_id']);
        $old_managers=array();
        if(isset($project_assign_old) && count($project_assign_old)>0){
            foreach( $project_assign_old as $project) { 
                $old_managers[$project['project_assign_manager_id']]=$project['project_assign_manager_id'];
            }
        }//here old manager which have project 
        // echo "old managers";
        // print_r($old_managers);

        //starting checking user_loged in or not
        $this->load->helper('session_checking');
        user_check();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('project_name', 'PROJECT NAME', 'required');
        $this->form_validation->set_rules('desc_project', 'DESCRIPTION OF PROJECT','required');
        $this->form_validation->set_rules('status_project', 'STATUS OF PROJECT', 'required');
        $this->form_validation->set_rules('status2_project', 'STATUS OF PROJECT','required');
        $this->form_validation->set_rules('project_manager[]', 'Choose PROJECT MANAGER OF PROJECT','required');
        $this->form_validation->set_rules('start_date', 'start date of project', 'required');
        $this->form_validation->set_rules('end_date', 'end date of project','required');

        if ($this->form_validation->run()){
            $project_id=$this->input->post('project_id');
            $project_name=$this->input->post('project_name');
            $project_description=$this->input->post('desc_project');
            $project_status1=$this->input->post('status_project');
            $project_status2=$this->input->post('status2_project');
            $project_assign_managers=$this->input->post('project_manager[]');
            $project_start_date=$this->input->post('start_date');
            $project_end_date=$this->input->post('end_date');

            //find out new manager, we will assign project to new manager
            $new_managers=array();
            $new_managers[$_SESSION['user_id']]=$_SESSION['user_id'];
            foreach($project_assign_managers as $project_assign_manager) {
                $new_managers[$project_assign_manager]=$project_assign_manager;
            }
            // echo "new manager";
            // print_r($new_managers);

            //find out insert manager id
            $new_manager_insert=array();
            foreach($new_managers as $new_manager){
                if(!array_key_exists($new_manager,$old_managers))
                {
                    $new_manager_insert[]=$new_manager;
                }
            }
            // echo 'insert manager ids';
            // print_r($new_manager_insert);

            //find out delete manager id
            $new_manager_delete=array();
            foreach($old_managers as $old_manager){
                if(!array_key_exists($old_manager,$new_managers))
                {
                    $new_manager_delete[]=$old_manager;
                }
            }
            // echo 'delete manager ids';
            // print_r($new_manager_delete);
            // exit;

            ///===============================IMAGE========
            if(!empty($_FILES['project_photo']['name'])){
                // echo 'image is  set';
                $config = array(
                 'upload_path' => "./uploads/projects_image",
                 'allowed_types' => "gif|jpg|png|jpeg",
                 // 'overwrite' => TRUE,
                 'max_size' => "", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                 'max_height' => "",
                 'max_width' => ""
                 );
                 $this->load->library('upload',$config);
                 $this->upload->do_upload('project_photo');
                 $data = array('image_metadata' => $this->upload->data());
                 $project_image_path=base_url("uploads/projects_image/".$data['image_metadata']['raw_name'].$data['image_metadata']['file_ext']);         
                 //array prepare with image for project_information
                 $project_data = array(
                    'project_name' => $project_name,
                    'project_description' => $project_description,
                    'status1'=>$project_status1,
                    'status2' => $project_status2,
                    'start_date' => $project_start_date,
                    'end_date'=>$project_end_date,
                    'project_image'=>$project_image_path
                ); 

             }
             else{
                // ECHO 'IMAGE IS NOT SET';
                //array prepare with-out image for project_information
                $project_data = array(
                    'project_name' => $project_name,
                    'project_description' => $project_description,
                    'status1'=>$project_status1,
                    'status2' => $project_status2,
                    'start_date' => $project_start_date,
                    'end_date'=>$project_end_date
                );  


             }

            //////IMAGE END================================

            //prepare data sending to model for update projects information
         
            $this->load->model('project_model');
            $flag=$this->project_model->update_project_information($project_data,$project_id);
            
            if($flag){
                //delete project_maangers from project_assign.
                if(isset($new_manager_delete) && count($new_manager_delete)>0){
                    $delete_flag='';
                    $this->load->model('project_assign_model');
                    $delete_flag=$this->project_assign_model->delete($new_manager_delete,$project_id);    
                }
                 
                if(isset($new_manager_insert) && count($new_manager_insert)>0){
                    //insert maanger
                    foreach($new_manager_insert as $manager){
                        $project_assign_data[]=array(
                            'project_id'=>$project_id,
                            'project_name' => $project_name,
                            'project_assign_manager_id'=>$manager
                        );
                    }
                    $this->load->model('project_assign_model');
                    $this->project_assign_model->submit_project_assign_information($project_assign_data);

                }
                if(isset($delete_flag)){
                    //after delete redirect
                    redirect('http://[::1]/ACL/index.php/view_project_handler');
                }
                redirect('http://[::1]/ACL/index.php/view_project_handler');
            } else {
                echo 'project not update';
            }

        }
        else{ 
            $this->load->view('edit_project');  
        }
    }
}
?>