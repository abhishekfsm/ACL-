<?php
if(isset($_SESSION['user_logged_in'])){
    redirect('dashboard_handler'); 
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>login Form!</title>
  </head>
  <body>
  <!-- navbar -->
<!-- navbar-end -->

    <div class="container border border-primary">
        <h5 class="text-center">login  form</h5>
        <div class="d-flex justify-content-center">
            <!-- <form class="column g-3" method="POST" action=""> -->
            <?php echo form_open('login_handler/login_user',' class="column g-3"');?>       
                    <div class="">
                        <?php echo form_label('Email id', 'name',['class'=>'visually m-1'] );?>
                        <?php echo form_input([ 'name'=>'email' , 'class'=>'form-control' ,'value'=>set_value('email'), 'PLACEHOLDER'=>'ENTER YOUR EMAIL']);?>
                        <span class="text-danger"><?php echo form_error('email');?></span>     
                    </div>
                    
                    <div class="">
                        <?php echo form_label('Password', 'name',['class'=>'visually m-1'] );?>  
                        <?php echo form_password([ 'name'=>'password' , 'class'=>'form-control', 'id'=>'password' ,'value'=>set_value('password'), 'PLACEHOLDER'=>'password ']);?>
                        <span class="text-danger"><?php echo form_error('password');?></span>
                    </div>
                
                    <div class="col-auto m-3">
                        <?php echo form_submit(['class'=>'btn btn-primary','name'=>'login_submit','value'=>'submit']);?>
                    </div>  
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
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>