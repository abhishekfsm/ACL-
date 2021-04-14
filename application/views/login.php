<?php
include('reuse_files/header.php');
?>
<?php
// // todo change
// if(isset($_SESSION['user_logged_in'])){
//     redirect('dashboard_handler'); 
// }

// ?>
<div class="h-100 border border-primary d-flex justify-content-center align-items-center" class="bg-image" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');">
    <div class="container border border-primary w-25 ">
        <h5 class="text-center">login  form</h5>
        
            <!-- <form class="column g-3" method="POST" action=""> -->
            <?php echo form_open('login_handler/login_user',' class="column g-3"');?>       
                    <div class=" m-2">
                        <?php echo form_label('Email Id', 'name',['class'=>'visually mY-1'] );?>
                        <?php echo form_input([ 'name'=>'email' , 'class'=>'form-control' ,'value'=>set_value('email'), 'PLACEHOLDER'=>'ENTER YOUR EMAIL']);?>
                        <span class="text-danger"><?php echo form_error('email');?></span>     
                    </div>
                    
                    <div class="m-2">
                        <?php echo form_label('Password', 'name',['class'=>'visually mY-1'] );?>  
                        <?php echo form_password([ 'name'=>'password' , 'class'=>'form-control', 'id'=>'password' ,'value'=>set_value('password'), 'PLACEHOLDER'=>'password ']);?>
                        <span class="text-danger"><?php echo form_error('password');?></span>
                    </div>
                
                    <div class="col-auto m-3">
                        <?php echo form_submit(['class'=>'btn btn-primary','name'=>'login_submit','value'=>'login']);?>
                    </div> 
                    <!-- registration account link -->
                    <p class="m-3">Not Registered ?<a class=" text-primary" href="<?php echo base_url('index.php/registration_handler');?>">Create an account</a></p>
                    <!-- alert box -->  
                    <!--registartion sucessful message print  -->
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible mx-auto bg-danger text-white text-center">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong>  <?php echo $this->session->flashdata('success'); ?> you can login
                        </div>
                    <?php } ?>
                    <!--wrong password alert  -->
                    <?php if ($this->session->flashdata('worng password')) { ?>
                        <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                            <?php echo $this->session->flashdata('worng password'); ?>
                        </div>
                    <?php } ?>
                    <!-- invalid credential alert -->
                    <?php if ($this->session->flashdata('invalid email')) { ?>
                        <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                            <?php echo $this->session->flashdata('invalid email'); ?>
                        </div>
                    <?php } ?>
            </form>
        
    </div>
</div>
       
<?php
    include('reuse_files/footer.php');
?>