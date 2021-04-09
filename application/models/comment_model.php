<?php
class  Comment_model extends CI_Model{
    public function insert_comment($data){

        if(isset($data)){
            if($this->db->insert('comments',$data)){

                return $this->db->insert_id();
            }else{
                return false;
            }

        }else {
            return false;
        }

    }

    //get commnets by task id
    public function get_comments_by_task_id($task_id){
        if(isset($task_id)){
            $this->db->select(array('users.user_name','comments.comment_title',
            'comments.comment_description','comments.parent_id','comments.comment_date',
            'roles.role_name','comments.id'));
            $this->db->from('comments');
            $this->db->where('task_id',$task_id);
            $this->db->join('users','users.user_id=comments.user_id');
            $this->db->join('roles','roles.role_id=users.user_role_id');
            $query=$this->db->get();
            return $query->result_array();

        }else{
            return false;
        }
    }
}
?>

