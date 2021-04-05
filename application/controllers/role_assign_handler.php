<?php
class Role_assign_handler extends CI_Controller{
   
    
    // get users id and provide roles //TODO
    public function get_id($id=null){
        
        // echo $id;
        // echo "abhi";
        $this->load->model('registration_model');
        $user_data['user']=$this->registration_model->get_user_by_id($id);
        // print_r($user_data);
        // $this->load->view('role_assign.php',$user_data);
        $this->get_roles_with_method($user_data);

    }
    public function get_roles_with_method($user_data){
        
        $this->load->model('roles_model');
        $user_data['roles']=$this->roles_model->get_roles();
        $this->load->view('role_assign.php',$user_data);
        // print_r($user_data);
        // exit;

        // foreach($roles_data as $role){
        //     // echo "role-id".$role['role_id'];
        //     print_r();
        //     $this->load->model('role_method_model');
        //     $role_methods_data=$this->role_method_model->get_method_id($role['role_id']);
        //     // print_r($role_methods_data);
        //     // echo "method_id".$role_method_data['method_id'];
        //     foreach($role_methods_data as $role_method){
        //         $this->load->model('methods_model');
        //         $method_data=$this->methods_model->get_method_by_id($role_method['method_id']);
        //         // print_r($method_data);
        //         // exit;
        //         foreach($method_data as $method){
        //             $roles_with_method[]=array(
        //                 'role_id'=> $role['role_id'],
        //                 'role_name'=>$role['role_name'],
        //                 'method_name'=>$method['method_name']
        //             );
                    
        //         }
                
        //     }

        // }
        // $user_data['roles_with_method']= $roles_with_method;
        // $this->load->view('role_assign.php',$user_data);
        // echo'<pre>';
        // // print_r($roles_with_method);
        // // print_r($data);
        // echo'</pre>';

    }
    //here collect role which is provide by admin and its update user registration table
    public function receive_role_by_admin(){
        // print_r($_POST);
        $this->load->model('registration_model');
        $this->registration_model->update($_POST);

    }


}
?>