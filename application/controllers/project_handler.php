<!-- this page is used for add project and project can add only admin -->
<?php
class Project_handler extends CI_Controller{
    public function index(){
        $this->load->model('roles_model');
        //calling model for fetch role_id of "project_manger"
        $roles=$this->roles_model->get_role_by_name('project manager');
        $role_id='';
        if(isset($roles) && count($roles)==1){
            $role_id=$roles[0]['role_id'];
            // echo $role_id;
            $this->load->model('registration_model');
            $user_data['project_managers']=$this->registration_model->get_user_by_UserRoleId($role_id);
            // print_r($user_data);
        }
        
        $this->load->helper('session_checking');
        if(role_check('add_project')) {
            
            $this->load->view('project',$user_data);   
        }else {

            redirect('login_handler');
        }
    }

    //here project add funtion
    public function add_project() {
        // print_r($_POST);

        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        // echo "fn ready for collect blog infoamtion";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('project_name', 'PROJECT NAME', 'required');
        $this->form_validation->set_rules('desc_project', 'DESCRIPTION OF PROJECT','required');
        $this->form_validation->set_rules('status_project', 'STATUS OF PROJECT', 'required');
        $this->form_validation->set_rules('status2_project', 'STATUS OF PROJECT','required');
        $this->form_validation->set_rules('project_manager[]', 'Choose PROJECT MANAGER OF PROJECT','required');
        $this->form_validation->set_rules('start_date', 'start date of project', 'required');
        $this->form_validation->set_rules('end_date', 'end date of project','required');
        if(empty($_FILES['project_photo']['name'])){
            $this->form_validation->set_rules('project_photo', 'Photo of project','required');
        }
      
        // blog photo uplord configuration
        $config = array(
        'upload_path' => "./uploads/projects_image",
        'allowed_types' => "gif|jpg|png|jpeg",
        // 'overwrite' => TRUE,
        'max_size' => "", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'max_height' => "",
        'max_width' => ""
        );
        
        $this->load->library('upload',$config);

        if ($this->form_validation->run() &&  $this->upload->do_upload('project_photo')){
          
            $project_name=$this->input->post('project_name');
            $project_description=$this->input->post('desc_project');
            $project_status1=$this->input->post('status_project');
            $project_status2=$this->input->post('status2_project');
            $project_assign_managers=$this->input->post('project_manager[]');
            $project_start_date=$this->input->post('start_date');
            $project_end_date=$this->input->post('end_date');
            $data = array('image_metadata' => $this->upload->data());
            $project_image_path=base_url("uploads/projects_image/".$data['image_metadata']['raw_name'].$data['image_metadata']['file_ext']);         
            
            
            $project_data = array(
                'project_name' => $project_name,
                'project_description' => $project_description,
                'status1'=>$project_status1,
                'status2' => $project_status2,
                'start_date' => $project_start_date,
                'end_date'=>$project_end_date,
                'project_image'=>$project_image_path
            ); 
            $this->load->model('project_model');
            $project_id=$this->project_model->submit_project_information($project_data);
            // echo "last project insert id is ".$project_id;
            
            //here project assign data prepare
            $project_assign_data=array();
            if(isset($project_id)){
                //here add login id to assiggn project.


                //start here 02-04-21
                $project_assign_managers[]=$_SESSION['user_id'];
                foreach($project_assign_managers as $manager){
                    $project_assign_data[]=array(
                        'project_id'=>$project_id,
                        'project_name' => $project_name,
                        'project_assign_manager_id'=>$manager
                    );
                }
                // print_r($project_assign_data);
                // exit;
                $this->load->model('project_assign_model');
                $this->project_assign_model->submit_project_assign_information($project_assign_data);  
            } else {
                echo 'somethig went wrong';
            }
        }
        else{
             
            $this->load->view('project');  
        }
    }
}
?>