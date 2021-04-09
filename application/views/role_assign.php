<?php
if(isset($_SESSION['user_logged_in'])){
  include('reuse_files/header.php');
}
else{
  redirect('login_handler');
}
?>

<div class="container border border-secondary">
    <?php //print_r($user);?>
    <?php //print_r($roles);?>
    <p class="text-center my-2">ASSIGN ROLE TO USER(<?php echo  $user[0]['user_name'];?>)</p>
    <P>NAME:   <?php echo  $user[0]['user_name'];?></P>
    <P>Email:  <?php echo  $user[0]['user_email'];?></P>
    <hr>
    <!-- start 23-03-21 -->
    <?php echo form_open('role_assign_handler/receive_role_by_admin',' class="column g-3"');?>
                
        <div class="w-75 m-3">
            <!-- here hidden form of user id (using for update user table ) -->
            <?php 
                $data = [
                    'user_id'  =>$user[0]['user_id']                    
                ];
                
                echo form_hidden($data);
            ?>




            <?php echo form_label('Select ROLE', 'select_role',['class'=>'visually m-3'] );?>
            <!-- <br> -->
            <!-- here make drop_dowm for select methods -->
            <?php
                foreach($roles as $role){
                    $options[] = array(
                    $role['role_id'] => $role['role_name'],
                    );  
                }
                echo form_dropdown('select_role', $options);
                
            ?>
            
        </div>
        <div class="w-75 m-3">
            <?php echo form_submit(['class'=>' mx-4 btn btn-primary','name'=>'submit','value'=>'submit']);?>
        </div>
        <!--  meaasssage show hare -->
        <?php if ($this->session->flashdata('role_success')) { ?>
            <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                <?php echo $this->session->flashdata('role_success'); ?>
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