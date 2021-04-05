<?php
class Edit_role_handler extends CI_Controller{
    public function index(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();

    }

    public function get_id($id=null){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();

        $data=array();
        $this->load->model('roles_model');
        //get roles data by id
        $data['role_id_name']=$this->roles_model->get_role_by_id($id);
        //get combinaation data
        $data['role_data']=$this->roles_model->get_role_with_methods($id);
        // print_r($data);
        // exit;
        $this-> fetch_all_method($data);  
    }

    //fetch all methods 
    
    public function fetch_all_method($data){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
        $this->load->model('methods_model');
        $data['methods']=$this->methods_model->get_methods();
        $this->load->view('edit_role',$data); 
       
    }

    //here update roles data
    public function update_roles(){
        //starting checking session
        $this->load->helper('session_checking');
        user_check();
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Roles name', 'required');
        if ($this->form_validation->run()){
            $role_name=$this->input->post('name');
            $role_id=$this->input->post('role_id');
            $method_ids=$this->input->post('methods');//here data come in array from (new methodsS_id data come)
            // print_r($method_ids);

            //==here fetch data form role_method table(all_exist_method  on id)=
            $this->load->model('role_method_model');
            $role_method=$this->role_method_model->get_method_id($role_id);

            foreach($role_method as $method){
                $all_exist_methods[$method['method_id']]=$method['method_id'];
            }
            // print_r($all_exist_methods);
            //###========================end=====================================

            if(isset($method_ids)){
                //here new methods come from admin side on id(receive from from data)
                foreach($method_ids as $method_id){
                    $new_methods[$method_id]=$method_id;
                }
                // print_r($new_methods);
                //=============================end====================================

                //===========delete method id checking=============
                //here get those method_id, want to delete form db
                foreach($all_exist_methods as $exist_method){
                    if(!array_key_exists($exist_method,$new_methods)){
                        $delete_method_id[]=$exist_method;

                    }
                }
                //===========delete method checking end=========

                //============insert method id check==================
                //here get those method id which is insert into db
                foreach($new_methods as $new_method){

                    if(!array_key_exists($new_method,$all_exist_methods)){

                        $insert_method_id[]=$new_method;
                    }
                   
                }
                //===========insert method id  check end=================
                //delete data
                if(isset($delete_method_id)){
                    // print_r($delete_method_id)
                    //caling to model for delete data
                    $this->load->model('role_method_model');
                    $this->role_method_model->delete($role_id,$delete_method_id);  
                }
                //insert data
                if(isset($insert_method_id)){
                    // print_r($insert_method_id);
                    foreach($insert_method_id as $method_id){
                        $data[]=array(
                            'role_id'=>$role_id,
                            'method_id'=>$method_id
                        );
                    }
                    // print_r($data);
                    $this->load->model('role_method_model');
                    $this->role_method_model->new_method_role_insert($data);
                }
                redirect("edit_role_handler/get_id/{$_POST['role_id']}");

            }
            else{
                $this->session->set_flashdata('method_alert', 'select minimum one name');
		        redirect("edit_role_handler/get_id/{$_POST['role_id']}");
            }    
        }
        else{
            
            $this->session->set_flashdata('role_alert', ' role name is required');
		    redirect("edit_role_handler/get_id/{$_POST['role_id']}");
        }
    }
}

?>