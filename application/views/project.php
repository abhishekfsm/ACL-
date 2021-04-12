<?php

include('reuse_files/header.php');
// print_r($project_managers);
?>
<!--form start  -->
<div class="container border border-primary">
            <h5 class="text-center">ADD PROJECT</h5>

            <?php echo form_open_multipart('project_handler/add_project',' class="column g-3"');?>
                <div class="w-75 m-1">

                    <?php echo form_label('What is NAME of PROJECT ', 'project_name',['class'=>'visually m-1'] );?>
                    <?php echo form_input([ 'name'=>'project_name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('project_name'), 'PLACEHOLDER'=>'ENTER title of blog ']);?>
                    <span class="text-danger"><?php echo form_error('project_name');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('description of project ', 'desc_project',['class'=>'visually m-1'] );?>
                    <?php echo form_textarea([ 'name'=>'desc_project' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('desc_project'), 'PLACEHOLDER'=>'ENTER description of blog']);?>
                    <span class="text-danger"><?php echo form_error('desc_project');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('status of project ', 'status_project',['class'=>'visually m-1'] );?>
                    <!-- <?php 
                        $options = array(
                            'enable'         => 'do enable mode of prject',
                            'disable'           => 'do disable mode of project',
                            
                        );
                        echo form_dropdown('status_project', $options, 'enable')
                    ?> -->
                    <?php echo form_radio('status_project', 'enable', @$mchecked).form_label('enable', 'enable'); ?>
                    <?php echo  form_radio('status_project', 'disable', @$fchecked).form_label('disable','enable'); ?>
                </div> 
            
                <div class="w-75 m-1">
                    <?php echo form_label('status of project ', 'status2_project',['class'=>'visually m-1'] );?>
                    <?php 
                        $options = array(
                            'current'   => 'CURRENT',
                            'delay'     => 'delay',
                            
                        );
                        
                        echo form_dropdown('status2_project', $options);
                    ?>
                </div> 
                <!-- project asssign to project manager -->
                <div class="w-75 m-1">
                    <?php echo form_label(' project assign to project manager ', 'project_manager',['class'=>'visually m-1'] );?>
                    <?php 
                        if(isset($project_managers) && count($project_managers)>0){
                            $options=array();
                            foreach($project_managers as $manager){
                                $options[$manager['user_id']]=$manager['user_name'];   
                            }
                    
                            echo form_multiselect('project_manager[]', $options);
                        }
                    
                    ?>
                </div>

                <div class="w-75 m-1">
                    <?php echo form_label('start date  of project ', 'start_date',['class'=>'visually m-1'] );?>
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
                    <?php echo form_label('end date  of project ', 'end_date',['class'=>'visually m-1'] );?>
                    <?php
                        $data = array(
                            'type' => 'date',
                            'name' => 'end_date',
                            'placeholder' => 'yyyy-mm-dd'
                            );
                            echo form_input($data); 
                    ?>
                   
                </div>  
                <!--project image uplord  -->
                
                <div class="w-75 m-3">
                    <?php echo form_label('upload your image', 'project_photo',['class'=>'visually m-3'] );?>
                    <?php echo form_upload([ 'name'=>'project_photo' , 'class'=>'form-control','value'=>set_value('project_photo') ,'id'=>'user_photo' ]);?>
                    <span class="text-danger"><?php echo form_error('project_photo');?></span>
                    <?php if(isset($upload_error)){echo $upload_error;}?>
                
                </div>
                 
                <div class="w-75 m-1">
                    <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?>
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