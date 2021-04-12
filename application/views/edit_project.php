<?php

// print_r($project);
// echo count($project);
// here null initialise variable
$pojetc_id='';
$project_name='';
$project_desc='';
$project_status1='';
$project_status2='';
$project_start_date='';
$project_end_date='';
$project_image='';

if(isset($project) && count($project)==1){
    $pojetc_id=$project[0]['project_id'];
    $project_name=$project[0]['project_name'];
    $project_desc=$project[0]['project_description'];
    $project_status1=$project[0]['status1'];
    $project_status2=$project[0]['status2'];
    $project_start_date=$project[0]['start_date'];
    $project_end_date=$project[0]['end_date'];
    $project_image=$project[0]['project_image'];
} else{
    redirect('http://[::1]/ACL/index.php/view_project_handler');
}
?>
<?php include('reuse_files/header.php')?>
<!--form start  -->
<div class="container border border-primary">
            <h5 class="text-center">EDIT PROJECT</h5>

            <?php echo form_open_multipart('edit_project_handler/collect_project_info',' class="column g-3"');?>
                <div class="w-75 m-1">
                    <!-- hidden form for project_id -->
                    <?php
                        $data = [
                            'type'  => 'hidden',
                            'name'  => 'project_id',
                            'value' => $project[0]['project_id']  
                        ];
                        
                        echo form_input($data);
                    ?>
                    <?php echo form_label('What is NAME of PROJECT ', 'project_name',['class'=>'visually m-1'] );?>
                    <?php echo form_input([ 'name'=>'project_name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>$project_name, 'PLACEHOLDER'=>'ENTER title of blog ']);?>
                    <span class="text-danger"><?php echo form_error('project_name');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('description of project ', 'desc_project',['class'=>'visually m-1'] );?>
                    <?php echo form_textarea([ 'name'=>'desc_project' , 'class'=>'form-control', 'id'=>'email' ,'value'=>$project_desc, 'PLACEHOLDER'=>'ENTER description of blog']);?>
                    <span class="text-danger"><?php echo form_error('desc_project');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('status of project ', 'status_project',['class'=>'visually m-1'] );?>
                    <?php
                        $check_value=false;
                        $check_value2=false;
                        if($project_status1=='enable'){
                            $check_value=true;
                        } else{
                            $check_value2=true;
                        }

                    ?>
                    <?php echo form_radio('status_project', 'enable',$checked=$check_value).form_label('enable', 'enable'); ?>
                    <?php echo  form_radio('status_project', 'disable',$checked=$check_value2).form_label('disable','enable'); ?>
                </div> 
                <!-- TODO -->
                <div class="w-75 m-1">
                    <?php echo form_label('status of project ', 'status2_project',['class'=>'visually m-1'] );?>
                    <?php 
                        //here auto fill dropdown
                        if($project_status2=='current'){
                            $check='current';
                        }
                        else {
                            $check='delay';
                        }
                        $options = array(
                            'current'   => 'CURRENT',
                            'delay'     => 'delay',
                            
                        );
                        
                        echo form_dropdown('status2_project', $options, $check)
                    ?>
                </div> 
                
                <!-- project asssign to project manager -->
                <div class="w-75 m-1">
                    <?php echo form_label(' project assign to project manager ', 'project_manager',['class'=>'visually m-1'] );?>
                    <?php 
                        if($_SESSION['user_role_id']=='33'){
                            //pre select option auto fill code
                            // print_r($project_assign_old);
                            $select=array();
                            if(isset($project_assign_old) && count($project_assign_old)>0){
                                foreach( $project_assign_old as $project) { 

                                    $select[]=$project['project_assign_manager_id'];
                                }
                            }
                            //========end
                            if(isset($project_managers) && count($project_managers)>0){
                                $options=array();
                                foreach($project_managers as $manager){
                                    $options[$manager['user_id']]=$manager['user_name'];   
                                }

                                echo form_multiselect('project_manager[]', $options,$select);
                            }
                        } else {
                            echo '<span class ="text-danger">you have no permission</span>';
                        }                    
                    ?>
                </div>

                <div class="w-75 m-1">
                    <?php echo form_label('start date  of project ', 'start_date',['class'=>'visually m-1'] );?>
                    <?php
                       $data = array(
                        'type' => 'date',
                        'name' => 'start_date',
                        'placeholder' => 'yyyy-mm-dd',
                        'value'=>$project_start_date

                                        
                        );
                        echo form_input($data); 
                    ?>        
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('end date  of project ', 'end_date',['class'=>'visually m-1'] );?>
                    <?php
                        $data = array(
                            'type' => 'date',
                            'name' => 'end_date',
                            'placeholder' => 'yyyy-mm-dd',
                            'value'=>$project_end_date
                            );
                            echo form_input($data); 
                    ?>
                   
                </div>   

                <!-- !--project image uplord  --> 
               
                
                <div class="w-75 m-3">
                    last image<img class="mx-3" src=" <?php echo $project_image?>" alt="previous project image" width="200" height="170" ><br>
                    <?php echo form_label('upload your image', 'project_photo',['class'=>'visually m-3'] );?>
                    <?php echo form_upload([ 'name'=>'project_photo' , 'class'=>'form-control','value'=>set_value('project_photo') ,'id'=>'user_photo' ]);?>
                    <span class="text-danger"><?php echo form_error('project_photo');?></span>
                    <?php if(isset($upload_error)){echo $upload_error;}?>
                
                </div>        
                 
                <div class="w-75 m-1">
                    <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    <!-- <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?> -->
                </div>
                <!--  meaasssage show hare -->
                <?php if ($this->session->flashdata('project_success')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('project_success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('alert')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('alert'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('already_project')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('already_project'); ?>
                    </div>
                <?php } ?>
            </form>
        </div>
        <!--blog form end -->
<!-- footer -->
<?php include('reuse_files/footer.php');?>
