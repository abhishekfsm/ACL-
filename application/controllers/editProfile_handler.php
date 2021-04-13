<?php
class editProfile_handler extends CI_Controller {
    public function index() {
        //starting checking user_loged in or not
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('registration_model');
        $user_data['user']=$this->registration_model->get_user_by_id($_SESSION['user_id']);
        $this->load->view('editProfile',$user_data);   
    }
    //used for access user data
    private function  current_user_data(){
        $this->load->model('registration_model');
        return  $this->registration_model->get_user_by_id($_SESSION['user_id']);
      

    }

    public function update_profile(){
        //starting checking user_loged in or not
        $this->load->helper('session_checking');
        user_check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Username', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run()){
            // all variable of user input data
            $user_id=$this->input->post('user_id');
            $user_name=$this->input->post('name');
            $user_email=$this->input->post('email');
            $user_password=$this->input->post('password'); 
            
            if(empty($_FILES['user_photo']['name'])){
                echo 'phot not set';
                $user_data = array(
                    'user_id'=>$suer_id,
                    'user_name' => $user_name,
                    'user_email' => $user_email,
                    'user_password' => $user_password,
                ); 

            } else{
                echo 'photo is set';
                 // user  photo uplord configuration
                $config = array(
                    'upload_path' => "./uploads/users_image",
                    'allowed_types' => "gif|jpg|png|jpeg",
                    // 'overwrite' => TRUE,
                    'max_size' => "", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "",
                    'max_width' => ""
                    );
                    $this->load->library('upload',$config);
                    $this->upload->do_upload('user_photo');

                    $data = array('image_metadata' => $this->upload->data());
                    $user_image_path=base_url("uploads/users_image/".$data['image_metadata']['raw_name'].$data['image_metadata']['file_ext']);         
                    $user_data = array(
                        'user_id'=>$user_id,
                        'user_name' => $user_name,
                        'user_email' => $user_email,
                        'user_password' => $user_password,
                        'user_image' =>$user_image_path
                    ); 

            }
            $this->load->model('registration_model');
            $editProfile_status=$this->registration_model->update_user_profile($user_data); 
            if(isset($editProfile_status)){
                $this->session->set_flashdata('edit_pofile_success', 'your profile sucessfully updated');
                redirect('editProfile_handler');  
            }  else{
                $this->session->set_flashdata('edit_pofile_error', 'somethimg went wrong');
                redirect('editProfile_handler');
            } 
        }  
        else{
            $user_data['user']=$this->current_user_data();
            $this->load->view('editProfile',$user_data);
                
        } 
    }
}
?>