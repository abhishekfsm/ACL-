<?php 
class Login_handler extends CI_Controller{
    function index(){
        // $this->load->helper('form'); 
        if(isset($_SESSION['user_logged_in'])){
            if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='33'){
                   
                redirect('dashboard_handler');  
            } else if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='34'){
                redirect('view_project_handler');
            }else if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='35'){
                redirect('view_task_handler');
            }else{
                redirect('home_handler');
            }

        }else{
            $this->load->view('login');
        
        }
    }
    public function login_user(){
        // echo "login function here data manage for login";
        // $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run()){
            $user_email=$this->input->post('email');
            $user_password=$this->input->post('password');
            $this->load->model('login_model');
            $user_data=$this->login_model->users_roles($user_email,$user_password);
            // temporary
            // $this->load->model('registration_model');
            // $user_data=$this->registration_model->users_roles();
            foreach($user_data as $user ){
                
                if($user_password==$user['user_password'] && $user_email==$user['user_email']) {
                    $newdata = array(
                        'user_id'   =>$user['user_id'],
                        'user_name'    =>$user['user_name'],
                        'user_email'   => $user['user_email'],
                        'user_role_id' =>$user['user_role_id'],
                        'user_role_name'=>$user['role_name'],
                        'user_image'=>      $user['user_image'],
                        'user_logged_in' => TRUE
                    );
                    $this->session->set_userdata($newdata);
                    if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='33'){
                   
                        redirect('dashboard_handler');  
                    } else if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='34'){
                        redirect('view_project_handler');
                    }else if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='35'){
                        redirect('view_task_handler');
                    }else{
                        redirect('home_handler');
                    }
                }
                else{   
                    // echo "wrong password";
                    $this->session->set_flashdata('worng password','wrong password enter right password');
                    redirect('login_handler');
                }     
            }           
        }
        else{
            $this->load->view('login');
        }
    }
}
?>