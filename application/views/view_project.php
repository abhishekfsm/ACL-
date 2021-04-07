<?php
include('header.php');
?>
<!--making add role button  -->
<div class="container text-right m-2">
    <?php
      //starting admin check through session
      $this->load->helper('session_checking');
      //calling for role check and check method here{ add_project is the name of method which is allocated to admin}
      if(role_check('add_project')) { 
        echo '<a class="btn btn-primary " href="http://[::1]/ACL/index.php/project_handler">ADD PROJECT</a>';
      } else {
        echo 'you have no permission of add project';
      }    
    ?>
</div>
<!-- delete confirm box start -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DELETE PROJECT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you want to delete project?, if you  delete,then  project related all data will be destroy 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="delete" class="btn btn-danger" value="1">delete</button>
      </div>
    </div>
  </div>
</div>
<!-- ==========end============ -->
<div class="fluid-container border border-primary m-5">
  
  <h5 class="text-center"> views all projects</h5>
  <table  class="table table-striped text-center">
    <thead class="thead-dark bg-dark text-white">
        <tr>
        <th scope="col">project id</th>
        <th scope="col">project name</th>
        <th scope="col">project description</th>
        <th scope="col">project status1</th>
        <th scope="col">project status1</th>
        <th scope="col">start date</th>
        <th scope="col">end date</th>
        <th colspan="3" scope="col" >action</th>
        </tr>
    </thead>
    <tbody>
      <?php
          //===========manage enable and disenable data which is showing to admin all and other user show only enable
          $project_data=array();
          if(isset($projects) && count($projects)>1){
            if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']!='33'){
              // echo "not admin";
              foreach($projects as $project){
                if($project['status1']=='enable'){
                  $project_data[]=$project;
                }
              }
            }else{
              // echo "admin section";
              $project_data=$projects;
            }
          }else{
            echo '</br>';
            echo 'you have not assign any project,contact admin';
            echo '</br>';
          }
          //=========================================================================================================
          //checking role delete
          $this->load->helper('session_checking');
          //calling for role check and check method 
          $permission_delete='';
          $permission_edit='';
          if(role_check('delete_project')) { 
            $permission_delete=true;
          }else{
            $permission_delete=false;
            echo 'you have no permission of delete project';
          }
          if(role_check('edit_project')){
            $permission_edit=true;
          }else {
            $permission_edit=false;
            echo 'you have no permission of edit project';
          }
          if(isset($project_data) && count($project_data)>=1) {
            foreach($project_data as $project) {
      ?>
        <tr>
          <td><?php echo $project['project_id'];?></td>
          <td><?php echo $project['project_name'];?></td>
          <td><?php echo $project['project_description'];?></td>
          <td><?php echo $project['status1'];?></td>
          <td><?php echo $project['status2'];?></td>
          <td><?php echo $project['start_date'];?></td>
          <td><?php echo $project['end_date'];?></td>
          <?php
            //edit button
            if($permission_edit){
              echo '<td><a class="btn btn-primary" href="http://[::1]/ACL/index.php/edit_project_handler/edit_project/'. $project['project_id'].'">edit</a></td>';
            }
            //delete button
            if($permission_delete){
              echo '<td><a class="btn btn-danger" href="http://[::1]/ACL/index.php/view_project_handler/delete_project/'. $project['project_id'] .'">delete</a></td>';
            }
          ?>
          <!-- view task related  -->
          <td><a class="btn btn-warning w-1" href="/ACL/index.php/view_task_handler/view_task/<?php echo $project['project_id'];?>">view task</a></td>
          
          <td>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  delete with model
            </button>
          </td>
        </tr>
      <?php 
          }
        
        }else{
          echo '</br>';
          echo 'you have not assign any project,contact admin';
          echo '</br>';
        }
      ?>  
    
        
    </tbody>
  </table>
</div>
<?php 
include('footer.php');
?>
