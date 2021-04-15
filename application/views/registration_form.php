<?php
include('reuse_files/header.php');
?>
<div class="h-100  d-flex justify-content-center align-items-center" class="bg-image" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/75.jpg');">
    <div class="container w-25 d-flex flex-column justify-content-center shadow-lg p-3 mb-5 ">
    <h5 class="text-center ">Registration  form</h5>
        <?php echo form_open_multipart('registration_handler/user_registration',' class="column g-3"');?>
            <div class=" m-3">

                <?php echo form_label(' Name', 'name',['class'=>'visually my-1'] );?>
                <?php echo form_input([ 'name'=>'name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('name'), 'PLACEHOLDER'=>'ENTER YOUR NAME']);?>
                <span class="text-danger"><?php echo form_error('name');?></span>
            </div>
            <div class=" m-3">
                <?php echo form_label(' Email', 'email',['class'=>'visually my-1'] );?>
                <?php echo form_input([ 'name'=>'email' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('email'), 'PLACEHOLDER'=>'ENTER YOUR EmAIL']);?>
                <span class="text-danger"><?php echo form_error('email');?></span>
            </div>
            
            <div class=" m-3">
                <?php echo form_label('Password', 'password',['class'=>'visually my-1'] );?>
                <?php echo form_password([ 'name'=>'password' , 'class'=>'form-control', 'id'=>'password' ,'value'=>set_value('password'), 'PLACEHOLDER'=>'password ']);?>
                <span class="text-danger"><?php echo form_error('password');?></span>
            </div>

            <!-- user image uplord -->
            <div class="m-3">
                <?php echo form_label('Upload  Image', 'user_photo',['class'=>'visually my-1'] );?>
                <?php echo form_upload([ 'name'=>'user_photo' , 'class'=>'form-control','value'=>set_value('user_photo') ,'id'=>'user_photo' ]);?>
                <span class="text-danger"><?php echo form_error('user_photo');?></span>
                <?php if(isset($upload_error)){echo $upload_error;}?>
            
            </div>
            
            <div class="m-3">
                <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?>
            </div>
            <div class="m-3">
                <!-- login account link -->
                <p class="m-3">Have you account ? <a class=" text-primary" href="<?php echo base_url('index.php/login_handler');?>">Login</a></p>
                    
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

</div>

<!-- footer -->
<?php include('reuse_files/footer.php');?>