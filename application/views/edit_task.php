<?php 
    include('header.php');
    // echo '<pre>';
    // print_r($tasks);
    // print_r($projects);
    // echo '</pre>';
    // todo 3-03-21
    //here start
    $task_id='';
    $task_name='';
    $task_description='';
    $task_project_id='';
    $task_status1='';
    $task_status2='';
    $start_date='';
    $end_date='';

    if(isset($tasks) && count($tasks)==1){
        $task_id=$tasks[0]['task_id'];
        $task_name=$tasks[0]['task_name'];
        $task_description=$tasks[0]['task_description'];
        $task_project_id=$tasks[0]['task_project_id'];
        $task_status1=$tasks[0]['task_status1'];
        $task_status2=$tasks[0]['task_status2'];
        $start_date=$tasks[0]['task_start_date'];
        $end_date=$tasks[0]['task_end_date'];
    } else {
        redirect('http://[::1]/ACL/index.php/view_task_handler');
    }

?>

<!--form start  -->
<div class="container border border-primary">
    <h5 class="text-center">EDIT TASK</h5>

    <?php echo form_open('edit_task_handler/receive_edit_task',' class="column g-3"');?>
        <div class="w-75 m-1">
            <!-- hidden form for project_id -->
            <?php
                $data = [
                    'type'  => 'hidden',
                    'name'  => 'task_id',
                    'value' => $task_id 
                ];
                
                echo form_input($data);
            ?>

            <?php echo form_label('NAME of TASK ', 'task_name',['class'=>'visually m-1'] );?>
            <?php echo form_input([ 'name'=>'task_name' , 'class'=>'form-control', 'id'=>'name' ,'value'=> $task_name, 'PLACEHOLDER'=>'ENTER title of blog ']);?>
            <span class="text-danger"><?php echo form_error('task_name');?></span>
        </div>
        <div class="w-75 m-1">
            <?php echo form_label('description of task ', 'desc_task',['class'=>'visually m-1'] );?>
            <?php echo form_textarea([ 'name'=>'desc_task' , 'class'=>'form-control', 'id'=>'email' ,'value'=>$task_description, 'PLACEHOLDER'=>'ENTER description of blog']);?>
            <span class="text-danger"><?php echo form_error('desc_task');?></span>
        </div>
        <div class="w-75 m-1">
            <?php echo form_label('task of project ', 'task_project',['class'=>'visually m-1'] );?>
            <!-- here dynamic name of project name -->
            <?php
            $options=array();
                if(isset($projects) && count($projects)>0){
                    $select='';
                    foreach($projects as $project){
                        if($project['project_id']==$task_project_id){
                            $select=$project['project_id'];
                        }
                        $options[] = array(
                            $project['project_id'] => $project['project_name'],
                            );  
                    }
                    echo form_dropdown('task_project', $options,$select);
                }
            ?>
            
        </div>
        <div class ="w-75 m-1">
            <?php echo form_label('task assign to developer', 'task_assign',['class'=>'visually m-1'] );?>
            <!-- here come all developer name with id -->
            <?php
                if($_SESSION['user_role_id']=='33' || $_SESSION['user_role_id']=='34'){
                    //here pre select developer
                    $select=array();
                    if(isset($pre_select_developers) && count($pre_select_developers)>0){
                        foreach($pre_select_developers as $developer){
                            $select[]=$developer['task_assign_developer_id'];
                        }
                    }
                    //here all developer present
                    $developers_option=array();
                    if(isset($developers) && count($developers)>0){
                        foreach($developers as $developer){
                            $developers_option[$developer['user_id']] = $developer['user_name'];
                        }
                        echo form_multiselect('task_assign[]', $developers_option,$select);
                    } else {

                        echo "<span class='text-danger'>there is no one developers,contact admin</span>";
                    }
                }else { 

                    echo '<sapn class="text-danger">you have not authority</span>';
                }    
            ?>

        </div>

        <div class="w-75 m-1">
            <?php echo form_label('status of task ', 'status_task',['class'=>'visually m-1'] );?>
            <?php
                //here select radio button according privious data
                $check_value=false;
                $check_value2=false;
                if($task_status1=='enable'){
                    $check_value=true;
                }else{
                    $check_value2=true;
                }
            
            ?>
            <?php echo form_radio('status_task', 'enable', $checked=$check_value).form_label('enable', 'enable'); ?>
            <?php echo  form_radio('status_task', 'disable', $checked=$check_value2).form_label('disable','enable'); ?>
        </div> 
        <!-- TODO -->
        <div class="w-75 m-1">
            <?php echo form_label('status of task ', 'status2_task',['class'=>'visually m-1'] );?>
            <?php 
                //here auto fill dropdown
                if($task_status2=='current'){
                    $check='current';
                }
                else {
                    $check='delay';
                }
                $options = array(
                    'current'   => 'CURRENT',
                    'delay'     => 'delay',
                    
                );
                echo form_dropdown('status2_task', $options,$check)
            ?>
        </div> 
        <div class="w-75 m-1">
            <?php echo form_label('start date  of task ', 'start_date',['class'=>'visually m-1'] );?>
            <?php
                $data = array(
                'type' => 'date',
                'name' => 'start_date',
                'placeholder' => 'yyyy-mm-dd',
                'value'=>$start_date
                );
                echo form_input($data); 
            ?>
            
        </div>
        <div class="w-75 m-1">
            <?php echo form_label('end date  of task ', 'end_date',['class'=>'visually m-1'] );?>
            <?php
                $data = array(
                    'type' => 'date',
                    'name' => 'end_date',
                    'placeholder' => 'yyyy-mm-dd',
                    'value'=>$end_date
                    );
                    echo form_input($data); 
            ?>
            
        </div>           
            
        <div class="w-75 m-1">
            <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
            <!-- <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?> -->
        </div>
        <!--  meaasssage show hare -->
        <?php if ($this->session->flashdata('task_success')) { ?>
            <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                <?php echo $this->session->flashdata('task_success'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('alert')) { ?>
            <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                <?php echo $this->session->flashdata('alert'); ?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('already_task')) { ?>
            <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                <?php echo $this->session->flashdata('already_task'); ?>
            </div>
        <?php } ?>
    </form>
</div>
<!-- form end -->

<?php include('footer.php');?>