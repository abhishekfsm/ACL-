<?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
// $this->load->helper('session_checking');
// user_check();
?>
<?php  include('header.php'); ?>
<?php //print_r($users_data);?>
<div class="container border border-primary m-4">
  <h5 class="text-center"> views all users</h5>
  <table  class="table table-striped">
    <thead class="thead-dark bg-dark text-white">
        <tr>
        <th scope="col">user id</th>
        <th scope="col">user name</th>
        <th scope="col">user email</th>
        <th scope="col">user password</th>
        <th scope="col">user role name</th>
        <th colspan="2" scope="col" >action</th>
        </tr>
    </thead>
    <tbody>
      <?php
          foreach($users_data as $user){
      ?>
        <tr>
          <td><?php echo $user['user_id'];?></td>
          <td><?php echo $user['user_name'];?></td>
          <td><?php echo $user['user_email'];?></td>
          <td><?php echo $user['user_password'];?></td>
          <td><?php echo $user['role_name'];?></td>
        <!-- to do provide role to user  -->
          <td><a href="http://[::1]/ACL/index.php/role_assign_handler/get_id/<?php echo $user['user_id'];?>">edit</a></td>
          <td><a href="/<?php echo $user['user_id'];?>">delete</a></td>
        </tr>
      <?php 
          }
      ?>  
    
        
    </tbody>
  </table>
</div>
<?php
include('footer.php');
?>