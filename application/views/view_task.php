<?php include('header.php')?>

<?php
// echo '<pre>';
// print_r($tasks);
// print_r($button_name);
// echo '</pre>';
$add_task_btn_name='';
if(isset($button_name) ) {

  $add_task_btn_name='add task for '.$button_name;

}else{

  $add_task_btn_name='ADD TASK';
}
?>

<!--making add role button  -->
<div class="container text-right m-2">
  <?php
      //starting admin check through session
      $this->load->helper('session_checking');
      //calling for role check and check method here{ add_task is the name of method which is allocated to admin}
      if(role_check('add_task')) {

        echo '<a class = "btn btn-primary"  href="/ACL/index.php/task_handler">'.$add_task_btn_name.'</a>';
      } else {
       
        echo 'you have no permission of add task';
      }
      
    ?>
    <!-- <a class="btn btn-primary  " href="http://[::1]/ACL/index.php/task_handler">ADD TASK</a> -->
</div>
<div class="container border border-primary m-4">
  
  <h5 class="text-center"> views all tasks</h5>
  <table  class="table table-striped text-center" >
    <thead class="thead-dark bg-dark text-white">
        <tr>
        <th scope="col">task name</th>
        <th scope="col">task description</th>
        <th scope="col">task of project</th>
        <th scope="col">task status1</th>
        <th scope="col">task status1</th>
        <th scope="col">start date</th>
        <th scope="col">end date</th>
        <th colspan="2" scope="col" >action</th>
        </tr>
    </thead>
    <tbody>
      <?php 
        if(isset($tasks) && count($tasks)>0){
      
          //checking role delete
          $this->load->helper('session_checking');
          //calling for role check and check method 
          $permission_delete='';
          $permission_edit='';
          if(role_check('delete_task')) { 
            $permission_delete=true;
          }else{
            $permission_delete=false;
            echo 'you have no permission of delete task';
          }
          if(role_check('edit_task')){
            $permission_edit=true;
          }else {
            $permission_edit=false;
            echo 'you have no permission of edit task';
          }


          foreach($tasks as $task){    
      ?>
        <tr>
          
          <td><?php echo $task['task_name'];?></td>
          <td><?php echo $task['task_description'];?></td>
          <td><?php echo $task['project_name'];?></td>
          <td><?php echo $task['task_status1'];?></td>
          <td><?php echo $task['task_status2'];?></td>
          <td><?php echo $task['task_start_date'];?></td>
          <td><?php echo $task['task_end_date'];?></td>
          <?php
            //edit button
            if($permission_edit){
              echo '<td><a class="btn btn-primary" href="http://[::1]/ACL/index.php/edit_task_handler/edit_task/'. $task['task_id'].'">edit</a></td>';
            }
            //delete button
            if($permission_delete){
              echo '<td><a class="btn btn-danger" href="http://[::1]/ACL/index.php/view_task_handler/delete_task/'. $task['task_id'].'">delete</a></td>';
            }
          ?>
          <!-- edit or delete button
          <td><a class="btn btn-primary" href="http://[::1]/ACL/index.php/edit_task_handler/get_id/<?php echo $task['task_id'];?>">edit</a></td>
          <td><a class="btn btn-danger" href="http://[::1]/ACL/index.php/view_task_handler/get_id/<?php echo $task['task_id'];?>">delete</a></td> -->

        </tr>
      <?php 
                }
          } else{

            echo 'please create first task <a href="/ACL/index.php/task_handler ">create task</a>';
            echo '</br></br>';
            
              // redirect('http://[::1]/ACL/index.php/task_handler');
          }
      ?>  
    
        
    </tbody>
  </table>
</div>

<?php include('footer.php')?>