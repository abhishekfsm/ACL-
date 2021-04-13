<?php include('reuse_files/header.php')?>

<?php
// echo '<pre>';
//print_r($tasks);
// print_r($button_name);
// echo '</pre>';
$add_task_btn_name='';
if(isset($button_name) ) {

  $add_task_btn_name='add task for '.$button_name;

}else{

  $add_task_btn_name='ADD TASK';
}
?>
<!-- main div -->
<div class="row w-100">
    <?php  
    include('reuse_files/side_bar.php');
    ?>
    <div class="col-10">

      <!--making add role button  -->
      <div class="container text-right my-3">
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
      </div>
      <!-- second component(table) -->

      <div class="container my-2">
  
        <p class="text-center"> views all tasks</p>
        <table class="table table-striped text-center" >
          <thead class="thead-dark bg-dark text-white">
              <tr>
              <th scope="col">Task Name</th>
              <th scope="col">Task Description</th>
              <th scope="col">Task Of Project</th>
              <th scope="col">Task Status1</th>
              <th scope="col">Task Priority</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th colspan="3" scope="col" >Action</th>
              </tr>
          </thead>
          <tbody>
            <?php 
              //here manage projects'task if project enable then show if projeect disable then task not showing
              if(isset($tasks) && count($tasks)>0){
                $task_data=array();
                if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']!='33'){
                  echo "not admin";
                  if($_SESSION['user_role_id']=='34'){
                    echo 'manager';
                    foreach($tasks as $task){
                      if($task['status1']=='enable'){
                        $task_data[]=$task;
                      }
                    }
                  }
                  else if($_SESSION['user_role_id']=='35'){
                    echo 'developer';
                    foreach($tasks as $task){
                      if($task['status1']=='enable' && $task['task_status1']=='enable'){
                        $task_data[]=$task;
                      }
                    }  
                  } 
                }else{
                  echo "admin";
                  $task_data=$tasks;
                }
              }
              // ==============================================================================================

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

            if(isset($task_data) && count($task_data)>0){
              foreach($task_data as $task){    
          ?>
              <!-- pass dynamic id -->
              <tr <?php 
                    if($_SESSION['user_role_id']=='35'){
                        if($task['task_priority']=='high'){
                          echo  'style="background-color: red;"';
                        }else if($task['task_priority']=='low'){
                          echo  'style="background-color: yellow;"';
                        }else{
                          echo  'style="background-color: green;"';
                        }
                        
                    }else{
                      if($task['task_status1']=='disable'){
                        echo 'style="opacity: 0.5;"';
                      }
                    }
                  ?>
              >
                
                <td><?php echo $task['task_name'];?></td>
                <td><?php echo $task['task_description'];?></td>
                <td><?php echo $task['project_name'];?></td>
                <td><?php echo $task['task_status1'];?></td>
                <td><?php echo $task['task_priority'];?></td>
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
                <td> <a class="btn btn-info" href="/ACL/index.php/task_comment_handler/comment/<?php if(isset($task['task_id'])){echo $task['task_id'];}?>">comment</a></td>

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

    </div>   
</div>

<!-- footer -->
<?php include('reuse_files/footer.php');?>