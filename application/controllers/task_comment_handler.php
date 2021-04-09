<?php
class Task_comment_handler extends CI_Controller{
    public function index(){

    }

    //fetch and send comment data on view
    public function comment($task_id=null,$insert_id=null){
        //starting checking user_loged in or not
        $this->load->helper('session_checking');
        user_check();
        $task_data['last_comment']=$insert_id;
        if(isset($task_id)){
            //get privious comments on task_id
            $this->load->model('comment_model');
            $task_data['comments']=$this->comment_model->get_comments_by_task_id($task_id);
            //get task data on task id 
            $this->load->model('task_model');
            $task_data['tasks']=$this->task_model->fetch_taskProject_by_task_id($task_id);
            $this->load->view('task_comment',$task_data);
            print_r($task_data);
            
        }else{
            redirect('http://[::1]/ACL/index.php/view_task_handler');
        } 
    }

    //recievied query data from 
    public function submit_comment(){
        //starting checking user_loged in or not
        $this->load->helper('session_checking');
        user_check();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comment_title', 'title of comment', 'required');
        $this->form_validation->set_rules('comment_desc', 'DESCRIPTION OF query','required'); 
        if ($this->form_validation->run()){
            $comment_title=$this->input->post('comment_title');
            $comment_description=$this->input->post('comment_desc');
            $task_id=$this->input->post('task_id');
            $user_id=$this->input->post('user_id');
            $parent_id=$this->input->post('parent_id');
          

            //array prepare for submit query dat
            $comment_data=array(
                'comment_title'=>$comment_title,
                'comment_description'=>$comment_description,
                'task_id'=>$task_id,
                'user_id'=>$user_id,
                'parent_id'=>$parent_id
            );
            $this->load->model('comment_model');
            $comment_insert_id=$this->comment_model->insert_comment($comment_data);
            if(isset($comment_insert_id)){
                $this->comment($task_id,$comment_insert_id);
                // redirect()
            }
           
        } else {
                $this->load->view('task_comment');
        }
    }
}
?>