<?php
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/vendor/autoload.php';
use \Firebase\JWT\JWT;
class Login_api extends REST_Controller{
    /**
    * Get All Data from this method.
    *
    * @return Response
    */
    public function __construct() {

        parent::__construct();
       
    }

    public function login_post(){
        $data = json_decode(file_get_contents('php://input'), true);
        if(isset($data) && count($data)>0){
           
            foreach($data as $user){
                $email=$user['user_email'];
                $password=$user['user_password'];
            }
            $this->load->model('api_model');
            $login_user=$this->api_model->login_check($email);
            
            if(isset($login_user) && count($login_user)>0){
                foreach($login_user as $user){
                    $login_user_id=$user['id'];
                    $login_user_email=$user['email'];
                    $login_user_pass=$user['password'];
                }
                if( $login_user_email==$email && $login_user_pass==$password){
                    //here generate token and this token save in db then return tokrn to login user with some info 
                    // here generate token
                    $secret_key="abhi";
                    $iss="localhost";
                    $iat=time();
                    $nbf=$iat+10;
                    $exp=$iat+60;
                    $user_info=array(
                        'id'=>$login_user_id,
                        'email'=>$login_user_email
                    );
                    $payload_info=array(
                        "iss" =>$iss ,
                        "iat" => $iat,
                        "nbf" =>$nbf ,
                        "exp"=> $exp,
                        "aud"=>"abhi",
                        "data"=>$user_info
                    );
                    $token=JWT::encode($payload_info,$secret_key);
                    if(isset($token)){
                        $this->load->model('api_model');
                        $token_flag=$this->api_model->update_token($token,$login_user_email);
                        if($token_flag){
                            header('content-type:application/json');
                            echo json_encode(array("status"=>"user login","message"=>"user login successfully","token"=>$token));

                        }else{
                            header('content-type:application/json');
                            echo json_encode(array("status"=>"user login","message"=>"user login successfully","token"=>$token));

                        }

                    }else{
                        echo "token willnot generate ,some issue";
                    }
                    
                }else{
                    header('Content-Type: application/json');
                    echo json_encode(array("status"=>"invalid password","message"=>"enter right password"));
                }
             
            }else{
                header('Content-Type: application/json');
                echo json_encode(array("status"=>"user not exist","message"=>"firstly registered yourself"));
            }

        }else{
            header('Content-Type: application/json');
            echo json_encode(array("status"=>"data not found","message"=>"enter login info of user"));
        }
        // $this->load->model('api_model');
        // $login_flag=$this->api_model->login_check($data);
        // echo $login_flag;
        // $d=json_encode($data);
        // $this->response($data, REST_Controller::HTTP_OK);
        // header('Content-Type: application/json');
        // echo json_encode(array("data"=>$data,"status"=>"user not exist","message"=>"enter valid  id of user"));
    }

}
?>