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
     
    
        if ($this->form_validation->run()){
            // all variable of user input data
            $user_name=$this->input->post('name');
            $user_email=$this->input->post('email');
            $user_password=$this->input->post('password');           
            $user_data = array(
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_password' => $user_password,
                
            );  
            // print_r($user_data);  
            $this->load->model('registration_model');
            $this->registration_model->submit_user_registration($user_data);
          
        }  
        else{
            // echo $upload_error;
            $this->load->view('registration_form');
             
        }

    }
    
}
?>