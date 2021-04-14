<?php
class Logout extends CI_Controller{
    public function index(){
        //here unset the session and rediret to login page
        unset($_SESSION['user_logged_in']);
        redirect('home_handler');
    }
}
?>