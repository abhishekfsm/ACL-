<!-- this file is used for ,users can change their informtion  -->
<?php
include('reuse_files/header.php');
?>
<?php
// all variable
    $user_id='';
    $user_name='';
    $user_email='';
    $user_password='';
    $user_photo='';
if(isset($user) && count($user)==1){

    $user_id=$user[0]['user_id'];
    $user_name=$user[0]['user_name'];
    $user_email=$user[0]['user_email'];
    $user_password=$user[0]['user_password'];
    $user_photo=$user[0]['user_image'];
}

?>
<!-- main div -->
<div class="row w-100">
    <?php  
    include('reuse_files/side_bar.php');
    ?>
    <div class="col-10">
        <!-- form start -->
        <div class="container ">
            <P class="text-center">Edit your profile</P>
            <?php echo form_open_multipart('editProfile_handler/update_profile',' class="column g-3"');?>
                <!-- hidden form for project_id -->
                <?php
                    $data = [
                        'type'  => 'hidden',
                        'name'  => 'user_id',
                        'value' => $user_id  
                    ];
                    
                    echo form_input($data);
                ?>
                
                <div class="w-75 m-1">
                    <?php echo form_label('What is your Name', 'name',['class'=>'visually my-2'] );?>
                    <?php echo form_input([ 'name'=>'name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>$user_name, 'PLACEHOLDER'=>'ENTER YOUR NAME']);?>
                    <span class="text-danger"><?php echo form_error('name');?></span>
                </div>
                <div class="w-75 m-1">
                    <?php echo form_label('What is your Email', 'email',['class'=>'visually my-2' ] );?>
                    <?php echo form_input([ 'name'=>'email' , 'class'=>'form-control', 'id'=>'email' ,'value'=>$user_email, 'readonly'=>'true','PLACEHOLDER'=>'ENTER YOUR EmAIL']);?>
                    <span class="text-danger"><?php echo form_error('email');?></span>
                </div>
                
                <div class="w-75 m-1">
                    <?php echo form_label('Enter new Password', 'password',['class'=>'visually my-2'] );?>
                    <?php echo form_password([ 'name'=>'password' , 'class'=>'form-control', 'id'=>'password' ,'value'=>$user_password, 'PLACEHOLDER'=>'password ']);?>
                    <span class="text-danger"><?php echo form_error('password');?></span>
                </div>

                <!-- user image uplord -->
                <div class="w-75 m-1">
                last Image<img class="mx-3" src=" <?php echo $user_photo?>" alt="previous project image" width="200" height="170" ><br>
                    <?php echo form_label('Change your Image', 'user_photo',['class'=>'visually my-2'] );?>
                    <?php echo form_upload([ 'name'=>'user_photo' , 'class'=>'form-control' ,'id'=>'user_photo' ]);?>
                    <span class="text-danger"><?php echo form_error('user_photo');?></span>
                    <?php if(isset($upload_error)){echo $upload_error;}?>
                
                </div>
                
                <div class="w-75 m-1">
                    <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    <?php echo form_reset(['class'=>'btn btn-primary','name'=>'RESET','value'=>'reset']);?>
                </div>
                <!-- registartion meaasssage show hare -->
                <?php if ($this->session->flashdata('edit_pofile_success')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('edit_pofile_success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('alert')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('alert'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('edit_pofile_error')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('edit_pofile_error'); ?>
                    </div>
                <?php } ?>
            </form>
        </div>
    
    </div>
</div>

<!-- footer -->
<?php include('reuse_files/footer.php');?>