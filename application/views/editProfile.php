<!-- this file is used for ,users can change their informtion  -->
<?php
include('reuse_files/header.php');
?>
<div class="container border border-primary">
        <h1 class="text-center">you can change profile information</h1>

        <?php echo form_open_multipart('',' class="column g-3"');?>
                <div class="w-75 m-3">

                    <?php echo form_label('What is your Name', 'name',['class'=>'visually m-3'] );?>
                    <?php echo form_input([ 'name'=>'name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('name'), 'PLACEHOLDER'=>'ENTER YOUR NAME']);?>
                    <span class="text-danger"><?php echo form_error('name');?></span>
                </div>
                <div class="w-75 m-3">
                    <?php echo form_label('What is your Email', 'email',['class'=>'visually m-3'] );?>
                    <?php echo form_input([ 'name'=>'email' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('email'), 'PLACEHOLDER'=>'ENTER YOUR EmAIL']);?>
                    <span class="text-danger"><?php echo form_error('email');?></span>
                </div>
                
                <div class="w-75 m-3">
                    <?php echo form_label('what is your password', 'password',['class'=>'visually m-3'] );?>
                    <?php echo form_password([ 'name'=>'password' , 'class'=>'form-control', 'id'=>'password' ,'value'=>set_value('password'), 'PLACEHOLDER'=>'password ']);?>
                    <span class="text-danger"><?php echo form_error('password');?></span>
                </div>

                <!-- user image uplord -->
                <div class="w-75 m-3">
                    <?php echo form_label('upload your image', 'user_photo',['class'=>'visually m-3'] );?>
                    <?php echo form_upload([ 'name'=>'user_photo' , 'class'=>'form-control','value'=>set_value('user_photo') ,'id'=>'user_photo' ]);?>
                    <span class="text-danger"><?php echo form_error('user_photo');?></span>
                    <?php if(isset($upload_error)){echo $upload_error;}?>
                
                </div>
               
                <div class="w-75 m-3">
                    <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?>
                </div>
                <!-- registartion meaasssage show hare -->
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('alert')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('alert'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
            </form>
        </div>
<!-- footer -->
<?php include('reuse_files/footer.php');?>