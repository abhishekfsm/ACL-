<?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
include('reuse_files/header.php');
?>
<!-- main body -->
<div class="row w-100">
  <!-- side bar start -->
  <?php include('reuse_files/side_bar.php');?>
  <!-- body part start -->
  <div class="col-10 my-2">
    <!--making add role button  -->
    <div class="container text-right m-2">
        <a class="btn btn-primary  " href="http://[::1]/ACL/index.php/add_role_handler">ADD ROLE</a>
    </div>
    <div class="container m-2">
      
      <p class="text-center"> views all roles</p>
      <table  class="table table-striped">
        <thead class="thead-dark bg-dark text-white">
          <tr>
            <th scope="col">role id</th>
            <th scope="col">role name</th>
            <th colspan="1" scope="col" >action</th>
          </tr>
        </thead>
        <tbody>
          <?php
              foreach($roles as $role){
          ?>
            <tr>
              <td><?php echo $role['role_id'];?></td>
              <td><?php echo $role['role_name'];?></td>
              <!-- to do provide role to user  -->
              <td><a class="btn btn-primary" href="http://[::1]/ACL/index.php/edit_role_handler/get_id/<?php echo $role['role_id'];?>">edit</a></td>
              
            </tr>
          <?php 
              }
          ?>      
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- footer -->
<?php include('reuse_files/footer.php');?>
