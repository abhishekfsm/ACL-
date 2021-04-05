<?php
include('header.php');
?>
<div class="container border border-primary">
        <h1 class="text-center">Registration form</h1>

        <?php echo form_open('registration_handler/user_registration',' class="column g-3"');?>
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
<?php
include('footer.php');
?>