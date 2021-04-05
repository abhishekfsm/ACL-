<?php
// print_r($projects);
     include('header.php');
?>

<!--form start  -->
<div class="container border border-primary">
            <h5 class="text-center">ADD TASK</h5>

            <?php echo form_open('task_handler/add_task',' class="column g-3"');?>
                <div class="w-75 m-1">

                    <?php echo form_label('NAME of TASK ', 'task_name',['class'=>'visually m-1'] );?>
                    <?php echo form_input([ 'name'=>'task_name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('task_name'), 'PLACEHOLDER'=>'ENTER title of blog ']);?>
                    <span class="text-danger"><?php echo form_error('task_name');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('description of task ', 'desc_task',['class'=>'visually m-1'] );?>
                    <?php echo form_textarea([ 'name'=>'desc_task' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('desc_task'), 'PLACEHOLDER'=>'ENTER description of blog']);?>
                    <span class="text-danger"><?php echo form_error('desc_task');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('task of project ', 'task_project',['class'=>'visually m-1'] );?>
                    <!-- here dynamic name of project name -->
                    <!-- STATRT HERE AFTER SUNDAY  HERE ONLY ASSIGNED PROJECT ACORDING TO USER -->
                    <?php
                    $options=array();
                        if(isset($projects) && count($projects)>0){
                            foreach($projects as $project){
                                $options[] = array(
                                    $project['project_id'] => $project['project_name'],
                                    );  
                            }
                            echo form_dropdown('task_project', $options);
                        }
                    ?>
                    
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('status of task ', 'status_task',['class'=>'visually m-1'] );?>
                    
                    <?php echo form_radio('status_task', 'enable', @$mchecked).form_label('enable', 'enable'); ?>
                    <?php echo  form_radio('status_task', 'disable', @$fchecked).form_label('disable','enable'); ?>
                </div> 
                <!-- TODO -->
                <div class="w-75 m-1">
                    <?php echo form_label('status of task ', 'status2_task',['class'=>'visually m-1'] );?>
                    <?php 
                        $options = array(
                            'current'   => 'CURRENT',
                            'delay'     => 'delay',
                            
                        );
                        echo form_dropdown('status2_task', $options)
                    ?>
                </div> 
                <div class="w-75 m-1">
                    <?php echo form_label('start date  of task ', 'start_date',['class'=>'visually m-1'] );?>
                    <?php
                       $data = array(
                        'type' => 'date',
                        'name' => 'start_date',
                        'placeholder' => 'yyyy-mm-dd'
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
                            'placeholder' => 'yyyy-mm-dd'
                            );
                            echo form_input($data); 
                    ?>
                   
                </div>           
                 
                <div class="w-75 m-1">
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
<?php 
include('footer.php');
?>