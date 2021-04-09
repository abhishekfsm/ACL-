<?php
// if(isset($_SESSION['user_logged_in'])){
//   include('header.php');
// }
// else{
//   redirect('login_handler');
// }
include('reuse_files/header.php');
?>
<div class="row w-100">
    <!-- side bar start -->
    <?php include('side_bar.php');?>
    <!-- body part start -->
    <div class="col-10 my-1">
        <div class="container border border-secondary">
            <p class="text-center my-2">EDIT  ROLE</p>
            <hr>

            <?php 
                //this is only only role name and id
                print_r($role_id_name);
                //this is combination of model and role
                print_r($role_data);
                $role_id="";
                $role_name="";
                if(isset($role_id_name)){
                    $role_id=$role_id_name[0]['role_id'];
                    $role_name=$role_id_name[0]['role_name'];
                }
            ?>
            
            <?php echo form_open('edit_role_handler/update_roles',' class="column g-3"');?>
                <!--hidden form use for pass role_id  -->
            <?php
                    $data = array(
                        'role_id'  =>$role_id,
                    );
                    echo form_hidden($data);    
            ?>           
                <div class="w-75 m-3">
                    <?php echo form_label('roles Name', 'name',['class'=>'visually m-3'] );?>
                    <?php echo form_input([ 'name'=>'name' , 'class'=>'form-control', 'id'=>'name' ,'value'=>$role_name, 'PLACEHOLDER'=>'ENTER ROLES NAME']);?>
                    <span class="text-danger"><?php echo form_error('name');?></span>  
                </div>
                <!-- select checkbox for methods -->
                <div class="w-75 m-3">
                    <?php echo form_label('select method', 'select_method',['class'=>'visually m-3'] );?>
                    <br>
                    <?php
                        $role_method=array();
                        foreach($role_data as $role){
                            $role_method[$role['method_id']]=$role['method_id'];
                        }
                        // print_r($role_method);
                        foreach($methods as $method){
                            if(array_key_exists($method['method_id'],$role_method)){
                            //    echo "abhi"; 
                            echo $method['method_name'];
                                $data = array(
                                    'name'          => 'methods[]',
                                    'id'            => $method['method_id'],
                                    'value'         => $method['method_id'],
                                    'checked'       => true,
                                    'style'         => 'margin:10px'
                                );
                                echo form_checkbox($data);
                                echo '<br>';
                            }
                            else{
                                // echo "abhi1";
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
                        
                    }
                    ?>
                
                </div>


                <div class="w-75 m-3">
                    <?php echo form_submit(['class'=>' mx-4 btn btn-primary','name'=>'submit','value'=>'submit']);?>
                </div>
                <!--  meaasssage show hare -->
                <?php if ($this->session->flashdata('method_alert')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('method_alert'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('role_alert')) { ?>
                    <div class="alert  w-50 mx-auto bg-danger text-white text-center "   role="alert">
                        <?php echo $this->session->flashdata('role_alert'); ?>
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