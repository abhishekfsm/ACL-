<?php 
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/vendor/autoload.php';
use \Firebase\JWT\JWT;
   
class Rest_api extends REST_Controller {
    
    /**
    * Get All Data from this method.
    *
    * @return Response
    */
    public function __construct() {

        parent::__construct();
       
    }

    //get user data in api-form
    public function user_get($id=null){
        $this->load->model('api_model');
        $all_headers=getallheaders();
        $token="";
        $token=$all_headers['Authorization'];
        print_r($token);
        if(isset($token)){
            //==========token expire according to given time==
            // $secret_key="abhi";
            // try {
            //     $decoded = JWT::decode($token, $secret_key, array('HS256'));
            //  } catch (Exception $e) {
            //      echo 'Exception catched: ',  $e->getMessage(), "\n";  
            //  }
            //===========expire time check end

            
            $secret_key="abhi";
            $decoded = JWT::decode($token, $secret_key, array('HS256'),true);
            $user_id=$decoded->data->id;
            //now fetch token from db and compare with header token if same then do word ,other option token expire
            $this->load->model('api_model');
            $token_from_db=$this->api_model->get_token_by_id($user_id);
            // print_r($token_from_db[0]['token']);
            if($token==$token_from_db[0]['token']){
                echo "token checked";
                $this->load->model('api_model');
                if(isset($id)){
                    $users=$this->api_model->get_users_byId($id);
                    if($users==0){
                        header('Content-Type: application/json');
                        echo json_encode(array("status"=>"user not exist","message"=>'enter valid  id of user'));

                    }else{
                        $this->response($users, REST_Controller::HTTP_OK);
                    }
                    

                }else{
                    $users=$this->api_model->get_users();
                    $this->response($users, REST_Controller::HTTP_OK);
                }

            }else{
                header('Content-Type: application/json');
                echo json_encode(array("status"=>"token has expired","message"=>'again login'));
            }



        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"token is not set","message"=>'you are not login'));

        } 
    }

    //check user existance registartioj time
    public function user_exist_check($email){
        $this->load->model('api_model');
        return $this->api_model->exist_user($email);
    }

    //for insert data
    public function user_post(){
        // print_r($_POST);
        // //below lines used for form data
        // $input = $this->input->post('user_name');
        // echo $input;
        // print_r($input);
        // below line handel file data
        // $this->response($input, REST_Controller::HTTP_OK); 
        if($_SERVER['REQUEST_METHOD']=='POST'){

            $users_data = json_decode(file_get_contents('php://input'), true);
            if(isset($users_data) && count($users_data)==1){
                foreach($users_data as $user){
                    $name=$user['user_name'];
                    $email=$user['user_email'];
                    $password=$user['user_password'];
                }

                //check user existance
                $exist_flag=$this->user_exist_check($email);
                if($exist_flag){
                    //array prepare for insert
                    $data=array();
                    $data=array(
                        'name'=>$name,
                        'email'=>$email,
                        'password'=>$password
                    );
                    //send data to model
                    $this->load->model('api_model');
                    $inser_flag=$this->api_model->insert($data);
                    if($inser_flag){
                        header('content-type:application/json');
                        echo json_encode(array("status"=>"user register successfully","message"=>"user can login now"));
                    }else{
                        $this->response( REST_Controller::HTTP_NOT_IMPLEMENTED);
                        header('content-type:application/json');
                        echo json_encode(array("status"=>"not implement","message"=>"some issue"));

                    }
                         
                }else{
                    header('content-type:application/json');
                    echo json_encode(array("status"=>"user exist already","message"=>"change email"));
                }

                

            }else{
                header('content-type:application/json');
                echo json_encode(array("status"=>"data not found(may be count isssue)","message"=>"enter user info"));

            }
                    // // print_r($data[0]['user_name']);
                    // //array prepare for send to model
                    // $data=array();  //that is used for send to model
                    // foreach($users_data as $user){
                    //     $data=array(
                    //         'name'=>$user['user_name'],
                    //         'email'=>$user['user_email'],
                    //         'password'=>$user['user_password']
                    //     );
                    // }

                    // $this->load->model('api_model');
                    // $inser_flag=$this->api_model->insert($data);
                    // if($inser_flag){

                    //     // here generate token
                    //     $secret_key="abhi";
                    //     $iss="localhost";
                    //     $iat=time();
                    //     // $nbf=$iat+10 ;
                    //     // $exp=$iat+120;
                    //     $user_info=array(
                    //         'name'=>$users_data[0]['user_name']
                    //     );
                    //     $payload_info=array(
                    //         "iss" =>$iss ,
                    //         "iat" => $iat,
                    //         // "nbf" =>$nbf ,
                    //         // "exp"=> $exp,
                    //         "aud"=>"abhi",
                    //         "data"=>$user_info
                    //     );
                    //     $token=JWT::encode($payload_info,$secret_key);
                    //     $decoded = JWT::decode($token, $secret_key, array('HS256'),true);
                    //     //fetch user info from decoded token 
                    //     $user_name=$decoded->data->name;
                    //     //token====ending

                    //     $this->response( REST_Controller::HTTP_CREATED);
                    //     header('Content-Type: application/json');
                    //     echo json_encode(array('status'=>"correct",
                    //                             'data'=>$data,
                    //                             'token'=>$token,                        
                    //                     ));
                    //     // echo json_encode(array('decode'=>$decoded));
                    //     echo json_encode(array('user name'=>$user_name));
                    // } else {
                    //     $this->response( REST_Controller::HTTP_NOT_IMPLEMENTED);
                    // }
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
            if($update_flag=="update"){
                $this->response( REST_Controller::HTTP_OK);
                
            }else if($update_flag=="user_not_found"){
                header('Content-Type: application/json');
                echo json_encode(array("status"=>"user not exist","message"=>'enter valid  id of user'));

            }else{
            
                $this->response(REST_Controller::HTTP_NOT_IMPLEMENTED);
            }
            
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"id not get","message"=>'enter id of user'));
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
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"id not get","message"=>'enter id of user'));
        }

    }


    //put -----TODO
    public function user_put($id=null){
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
            if($update_flag=="update"){
                $this->response( REST_Controller::HTTP_OK);
                
            }else if($update_flag=="user_not_found"){
                //here crete new usssssssser
                $this->load->model('api_model');
                $inser_flag=$this->api_model->insert($data);
                if($inser_flag==true){
                    header('Content-Type: application/json');
                    echo json_encode(array("status"=>"new user","message"=>'creted successfully'));
                } else {
                    $this->response(REST_Controller::HTTP_NOT_IMPLEMENTED);
                }

            } else {
            
                $this->response(REST_Controller::HTTP_NOT_IMPLEMENTED);
            }
            
        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"id not get","message"=>'enter id of user'));
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