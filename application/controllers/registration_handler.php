<?php
class Registration_handler extends CI_Controller{
    public function index(){
        $this->load->helper('form'); 
        $this->load->view('registration_form');
    }
    

    // this function used for duser input data manage and send to model
    public function user_registration(){
        //load form validation library
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Username', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if(empty($_FILES['user_photo']['name'])){
            $this->form_validation->set_rules('user_photo', 'Photo of user','required');
        }
      
        // blog photo uplord configuration
        $config = array(
        'upload_path' => "./uploads/users_image",
        'allowed_types' => "gif|jpg|png|jpeg",
        // 'overwrite' => TRUE,
        'max_size' => "", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'max_height' => "",
        'max_width' => ""
        );
        
        $this->load->library('upload',$config);
        if ($this->form_validation->run() && $this->upload->do_upload('user_photo')){
            // all variable of user input data
            $user_name=$this->input->post('name');
            $user_email=$this->input->post('email');
            $user_password=$this->input->post('password');  
            $data = array('image_metadata' => $this->upload->data());
            $user_image_path=base_url("uploads/users_image/".$data['image_metadata']['raw_name'].$data['image_metadata']['file_ext']);         
            
            $user_data = array(
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_password' => $user_password,
                'user_image' =>$user_image_path
            ); 
            $this->load->model('registration_model');
            $this->registration_model->submit_user_registration($user_data);
          
        }  
        else{
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            $this->load->view('registration_form');
             
        }

    }
    
}
?>