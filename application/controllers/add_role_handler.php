<?php
class Add_role_handler extends CI_Controller{

    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('methods_model');
        $method_data['methods']=$this->methods_model->get_methods();
        $this->load->view('add_role',$method_data);
    }

    //here method(permission come from view side)
    public function collect_roles(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Roles name', 'required');
        if ($this->form_validation->run()){
            $role_name=$this->input->post('name');
            $method_ids=$this->input->post('methods');          
            $roles_data = array(
                'role_name' => $role_name,
                
            );  
             
            $this->load->model('roles_model');
            //here calling to insert roles data(role_id,role_name)
            $last_inserted_id= $this->roles_model->submit_roles($roles_data);


            //fetch curently role id and selct method submit into new table(role_method_table{id,role_id,method_id})
            // echo $last_inserted_id;
            foreach($method_ids as $method_id){
    
                $role_method_table_data = array(
                    'role_id'=>$last_inserted_id,
                    'method_id' =>$method_id
                );
                // print_r($role_method_table_data);
                //TODO here multiple time query run;solve problem
                $this->load->model('role_method_model');
                $this->role_method_model->insert_method_and_role($role_method_table_data);

            }
            // exit;
            redirect('add_role_handler');  
          
        }  
        else{

            $this->load->view('add_role');
             
        }

    }
}
?>