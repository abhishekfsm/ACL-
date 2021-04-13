<?php
// print_r($projects);
     include('reuse_files/header.php');
?>
<!-- main div -->
<div class="row w-100">
    <?php  
    include('reuse_files/side_bar.php');
    ?>
    <div class="col-10">
    <!--form start  -->
        <div class="container">
            <p class="text-center">ADD TASK</p>

            <?php echo form_open('task_handler/add_task',' class="column g-3"');?>
                <div class="w-75 my-1">

                    <?php echo form_label('Task Name ', 'task_name',['class'=>'visually my-1'] );?>
                    <?php echo form_input([ 'name'=>'task_name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('task_name'), 'PLACEHOLDER'=>'ENTER title of blog ']);?>
                    <span class="text-danger"><?php echo form_error('task_name');?></span>
                </div>
                <div class="w-75 my-1">
                    <?php echo form_label('Task Description', 'desc_task',['class'=>'visually my-1'] );?>
                    <?php echo form_textarea([ 'name'=>'desc_task' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('desc_task'), 'PLACEHOLDER'=>'ENTER description of blog']);?>
                    <span class="text-danger"><?php echo form_error('desc_task');?></span>
                </div>
                <div class="w-75 my-1">
                    <?php echo form_label('Task of Project ', 'task_project',['class'=>'visually my-1'] );?>
                    <!-- here dynamic name of project name -->
                    <!-- STATRT HERE AFTER SUNDAY  HERE ONLY ASSIGNED PROJECT ACORDING TO USER -->
                    <?php
                    $options=array();
                    
                        if(isset($projects) && count($projects)>0){
                            foreach($projects as $project){
                                if($project['status1']=='enable') {
                                    $options[] = array(
                                        $project['project_id'] => $project['project_name'],
                                    ); 
                                }
                            }
                            echo form_dropdown('task_project', $options);
                        } else{
                            echo "<span class='text-danger'>you have not assigned any project</span>";
                        }
                    ?>
                    
                </div>
                <div class ="w-75 my-1">
                    <?php echo form_label('Task Assign To Developer', 'task_assign',['class'=>'visually my-1'] );?>
                    <!-- here come all developer name with id -->
                    <?php
                        $developers_option=array();
                        if(isset($developers) && count($developers)>0){
                            foreach($developers as $developer){
                                $developers_option[$developer['user_id']] = $developer['user_name'];
                            }
                            echo form_multiselect('task_assign[]', $developers_option);
                        } else{
                            echo "<span class='text-danger'>there is no one developers,contact admin</span>";
                        }
                    ?>

                </div>
                <div class="w-75 my-1">
                    <?php echo form_label('Status of Task ', 'status_task',['class'=>'visually my-1'] );?>
                    
                    <?php echo form_radio('status_task', 'enable', @$mchecked).form_label('enable', 'enable'); ?>
                    <?php echo  form_radio('status_task', 'disable', @$fchecked).form_label('disable','enable'); ?>
                </div> 
                <!-- TODO -->
                <div class="w-75 my-1">
                    <?php echo form_label('Priority Of Task ', 'task_priority',['class'=>'visually my-1'] );?>
                    <?php 
                        $options = array(
                            'low'   => 'LOW',
                            'normal'=> 'NORMAL',
                            'high'=>'HIGH'
                            
                        );
                        echo form_dropdown('task_priority', $options)
                    ?>
                </div> 
                <div class="w-75 my-1">
                    <?php echo form_label('Start Date Of Task ', 'start_date',['class'=>'visually my-1'] );?>
                    <?php
                        $data = array(
                        'type' => 'date',
                        'name' => 'start_date',
                        'placeholder' => 'yyyy-mm-dd'
                        );
                        echo form_input($data); 
                    ?>
                    
                </div>
                <div class="w-75 my-1">
                    <?php echo form_label('End Date Of Task ', 'end_date',['class'=>'visually my-1'] );?>
                    <?php
                        $data = array(
                            'type' => 'date',
                            'name' => 'end_date',
                            'placeholder' => 'yyyy-mm-dd'
                            );
                            echo form_input($data); 
                    ?>
                    
                </div>           
                    
                <div class="w-75 mx-2">
                    <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?>
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
    </div>
</div>

<!-- footer -->
<?php include('reuse_files/footer.php');?>