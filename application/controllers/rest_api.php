<?php 
require APPPATH . 'libraries/REST_Controller.php';
     
class Rest_api extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       
    }


    public function user_get(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            // echo "get request";
            $this->load->model('api_model');
            $users=$this->api_model->get_users();
            $this->response($users, REST_Controller::HTTP_OK); 
        }else{
            echo "another request";
        }
    }

    //for insert data
    public function user_post(){
        //below lines used for form data
        // $input = $this->input->post();
        // print_r($input);
        // below line handel file data
        $this->response($input, REST_Controller::HTTP_OK); 
        if($_SERVER['REQUEST_METHOD']=='POST'){

            $users_data = json_decode(file_get_contents('php://input'), true);
            // print_r($data[0]['user_name']);

            //array prepare for send to model
            $data=array();  //that is used for send to model
            foreach($users_data as $user){
                $data=array(
                    'name'=>$user['user_name'],
                    'password'=>$user['user_password']
                );
            }
            $this->load->model('api_model');
            $inser_flag=$this->api_model->insert($data);
            if($inser_flag){
                $this->response( REST_Controller::HTTP_CREATED);
            }else{
                $this->response( REST_Controller::HTTP_NOT_IMPLEMENTED);
            }
            // header('Content-Type: application/json');
            // echo json_encode($data);
            // $this->response($data, REST_Controller::HTTP_OK); 
        }else{
            echo "another request";
        }

    }

    //for update data
    public function user_patch($id=null){
        if(isset($id)){
            $users_data = json_decode(file_get_contents('php://input'), true);
            //array prepare for send to model
            $data=array();  //that is used for send to model
            foreach($users_data as $user){
                $data=array(
    
                    'name'=>$user['user_name'],
                    'password'=>$user['user_password']
                );
            }
            $this->load->model('api_model');
            $update_flag=$this->api_model->update($data ,$id);
            if($update_flag){
                $this->response( REST_Controller::HTTP_OK);
            }else{
                $this->response( REST_Controller::HTTP_NOT_IMPLEMENTED);
            }
            
        }else{
            echo "another request";
        }

    }

    //for delete data
    public function user_delete($id=null){
        if(isset($id)){
        
            $this->load->model('api_model');
            $delete_flag=$this->api_model->delete($id);
            if($delete_flag){
                $this->response( REST_Controller::HTTP_OK);
            }else{
                $this->response( REST_Controller::HTTP_NOT_FOUND);
            }
            
        }else{
            echo "another request";
        }

    }

    //put example
    public function user_put($id=null){
        if(isset($id)){

            $input = $this->put();
            $this->response($input, REST_Controller::HTTP_OK);
        }else{
            $this->response($input, REST_Controller::HTTP_NOT_FOUND);
        }
        
    }
        // echo "abhishek";
        // print_r($_SERVER);
        // if($_SERVER['REQUEST_METHOD']=='GET'){
        //     // echo "get request";
        //     $this->load->model('registration_model');
        //     $users=$this->registration_model->get_users();
        //     $this->response($users, REST_Controller::HTTP_OK);
        //     // header('Content-Type: application/json');
        //     // echo json_encode($users);

        // }else if($_SERVER['REQUEST_METHOD']=='POST'){
        //         echo "post request";
        //         // echo json_encode($_POST);
        //         // print_r($_POST);
        //         $data = json_decode(file_get_contents('php://input'), true);
        //         header('Content-Type: application/json');
        //         echo json_encode($data);
        // }else if($_SERVER['REQUEST_METHOD']=='PATCH') {
        //     echo 'HERE UPDATE DATA AND THROW EXCEPTION';
        // }else if($_SERVER['REQUEST_METHOD']=='PUT') {
        //     echo 'EXIST UPDATE IF NOT EXIST THEN CRETE NEW IDENTITY';
        // }
        // else if($_SERVER['REQUEST_METHOD']=='DELETE') {
        //     echo 'DELETE REQUEST';
        // }
    //     
    // }
}
?>