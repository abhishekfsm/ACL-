<?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
include('header.php');
?>

<!--making add role button  -->
<div class="container text-right m-2">
    <a class="btn btn-primary  " href="http://[::1]/ACL/index.php/add_role_handler">ADD ROLE</a>
</div>
<div class="container border border-primary m-4">
  
  <h5 class="text-center"> views all roles</h5>
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
          <td><a href="http://[::1]/ACL/index.php/edit_role_handler/get_id/<?php echo $role['role_id'];?>">edit</a></td>
          
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
