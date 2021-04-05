<?php
class Add_methods_handler extends CI_Controller{

    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->view('add_methods');
    }

    //here method(permission come from view side)
    public function collect_methods(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();

        // echo"here collect methods name";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Method name', 'required');
        if ($this->form_validation->run()){
            // all variable of user input data
            $method_name=$this->input->post('name');
                      
            $methods_data = array(
                'method_name' => $method_name,
                
            );  
            // print_r($methods_data);  
            $this->load->model('methods_model');
            $this->methods_model->submit_methods($methods_data);
          
        }  
        else{

            $this->load->view('add_methods');
             
        }



    }
}
?>