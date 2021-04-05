<?php
  function user_check(){
    if(!isset($_SESSION['user_logged_in'])){
        redirect('login_handler');
      }
    
  }

  function role_check($method) {

    if(isset($_SESSION['user_logged_in'])) {

      $ci =& get_instance();
      $ci->load->model('methods_model');
      $method_data=$ci->methods_model->get_method_by_name($method);
      if(isset($method_data) && count($method_data)==1) {

        $method_id=$method_data[0]['method_id'];
        // echo $method_id;
        $ci =& get_instance();
        $ci->load->model('role_method_model');
        $role_method_exist=$ci->role_method_model->check_method_role_is_exist($_SESSION['user_role_id'],$method_id);
        if($role_method_exist){
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }

      
    }
   

  
?>