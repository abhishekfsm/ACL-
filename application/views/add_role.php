<?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
include('reuse_files/header.php');
?>
<!-- main body -->
<div class="row w-100">
    <!-- side bar start -->
    <?php include('reuse_files/side_bar.php');?>
    <!-- body part start -->
    <div class="col-10 my-2">
        <div class="container">
            <p class="text-center">add roles with permission</p>
            <?php echo form_open('add_role_handler/collect_roles',' class="column g-3"');?>
                <div class="w-75 my-3">
                    <?php echo form_label('Roles Name', 'name',['class'=>'visually my-2 font-weight-bold'] );?>
                    <?php echo form_input([ 'name'=>'name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>set_value('name'), 'PLACEHOLDER'=>'ENTER NEW ROLES NAME']);?>
                    <span class="text-danger"><?php echo form_error('name');?></span>
                </div>
                
                <div class="w-75 my-3">
                    <?php echo form_label('Select Method', 'select_method',['class'=>'visually my-2 font-weight-bold'] );?>
                    <br>
                    <!-- here make checkbox for select methods -->
                    <?php
                        foreach($methods as $method){
                            echo $method['method_name'];
                            $data = array(
                                'name'          => 'methods[]',
                                'id'            => $method['method_id'],
                                'value'         => $method['method_id'],
                                'checked'       => false,
                                'style'         => 'margin:10px'
                            );
                            echo form_checkbox($data);
                            echo '<br>';

                    }
                    ?>
                    <!-- <span class="text-danger"><?php echo form_error('name');?></span> -->
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
  </div>
</div>
<!-- footer -->
<?php include('reuse_files/footer.php');?>