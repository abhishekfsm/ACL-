<?php
class ContactList_handler extends CI_Controller{
    public function index(){
       
        $this->load->model('ContactUs_model');
        $data['contacters']=$this->ContactUs_model-> fetch_contacter();
        
        $this->load->view('ContactList',$data);
    
    }
}
?>