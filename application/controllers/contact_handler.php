<?php
class Contact_handler extends CI_Controller{
    public function contact(){
        $contact_data=$_POST;
        $this->load->model('ContactUs_model');
        $conatct_flag=$this->ContactUs_model->submit_contact($contact_data);
        if(isset($conatct_flag)){
            echo "message send sucessfully";
        }else{
            echo "something went wrong";
        }
    }
}
?>