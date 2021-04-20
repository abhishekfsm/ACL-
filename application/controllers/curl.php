<?php
class Curl extends CI_Controller{
    public function index(){
        echo "curl page ";
        /* API URL */
        // $url = 'http://jsonplaceholder.typicode.com/users';

        
        $url='http://[::1]/ACL/index.php/Rest_api/user';     
        /* Init cURL resource */
        $ch = curl_init($url);
        //  /* Array Parameter Data */
        //  $data = ['name'=>'Hardik', 'email'=>'itsolutionstuff@gmail.com'];
   
        //  /* pass encoded JSON string to the POST fields */
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
   
       
        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            
        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
        /* execute request */
        $result = curl_exec($ch);
             
        /* close cURL resource */
        curl_close($ch);
        print_r($result);
    }
}
?>