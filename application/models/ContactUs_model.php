<?php
class ContactUs_model extends CI_Model{
    public function submit_contact($contact_data){
        
        if(isset($contact_data)&& count($contact_data)>0){
            $this->db->insert('contact_us',$contact_data);
            $no=$this->db->affected_rows();
            if($no==1){
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