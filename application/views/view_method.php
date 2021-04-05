<!-- <?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
?> -->
<?php include('header.php'); ?>
<!-- <?php print_r($methods);?> -->
<!--making add method button  -->
<div class="container text-right m-2">
    <a class="btn btn-primary  " href="http://[::1]/ACL/index.php/Add_methods_handler">ADD METHOD</a>
</div>
<div class="container border border-primary m-4">
  
  <h5 class="text-center"> views all method</h5>
  <table  class="table table-striped text-center">
    <thead class="thead-dark bg-dark text-white">
        <tr>
        <th scope="col">METHOD ID</th>
        <th scope="col">METHOD NAME</th>
        <th colspan="1" scope="col" >ACTION</th>
        </tr>
    </thead>
    <tbody>
      <?php
          foreach($methods as $method){
      ?>
        <tr>
          <td><?php echo $method['method_id'];?></td>
          <td><?php echo $method['method_name'];?></td>
          <!-- to do provide role to user  -->
          <td><a class="btn btn-danger" href="http://[::1]/ACL/index.php/view_method_handler/get_id/<?php echo $method['method_id'];?>">DELETE</a></td>
          
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