<?php
include('reuse_files/header.php');
?>
<!-- main body -->
<div class="row w-100 h-100 border border-primary">
  <!-- side bar start -->
  <?php include('reuse_files/side_bar.php');?>
  <!-- body part start -->
  <!-- TODO DIV HEIGH AND OVERFLOW PROPERTY -->
  <div class="col-10  h-100 border border-primary ">
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
            Are you want to delete <span id="p_name"></span>project?, if you  delete,then  project related all data will be destroy 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <!-- delete button  -->
            <?php echo form_open('view_project_handler/delete_project',' class="column g-1"');?>   
                <!-- hidden form task id -->
                <?php
                    $data = [
                        'type'  => 'hidden',
                        'name'  => 'final_delete_project',
                        'id'=>'final_delete_project'    
                    ];
                    echo form_input($data);
                ?>
                <?php echo form_submit(['class'=>'btn btn-danger','name'=>'delete','value'=>'delete']);?>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- ==========end============ -->
    <div id="content_body" class="container m-2 h-75 d-inline-block overflow-auto">
      
      <P class="text-center"> views all projects</P>
      <table  class="table table-striped text-center">
        <thead class="thead-dark bg-dark text-white">
            <tr>
            <th scope="col">project Id</th>
            <th scope="col">Project Name</th>
            <th scope="col">Project Description</th>
            <th scope="col">Project Status1</th>
            <th scope="col">Project Status1</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
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
            <tr <?php if($project['status1']=='disable'){ echo 'style="opacity: 0.5;"'; } ?>>
              <td><?php echo $project['project_id'];?></td>
              <td class="project_name"><?php echo $project['project_name'];?></td>
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
                  echo '<td>
                            <button type="button" class=" delete_project_button btn btn-danger" data-toggle="modal" data-target="#exampleModal"  data-project_id="'.$project['project_id'].'">
                              delete 
                            </button>
                        </td>';
                }
              ?>
              <!-- view task related  -->
              <td><a class="btn btn-warning w-1" href="/ACL/index.php/view_task_handler/view_task/<?php echo $project['project_id'];?>">view task</a></td>

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

  </div>

</div>
<!-- javascript for get the reply button value  -->
<script>
    $(document).ready(function(){
      $(document).on("click",".delete_project_button", function(){

        var ProjectId=$(this).data("project_id");
        var ProjectNameForDelete=$(this).closest('tr').find('.project_name').text(); 
        $('#p_name').val(ProjectNameForDelete); 
        $('#final_delete_project').val(ProjectId); 
        });
    });

</script>
<!-- footer -->
<?php include('reuse_files/footer.php');?>