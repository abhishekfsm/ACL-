<?php
include('reuse_files/frontend_header.php');
?>
<!--carousel start -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://source.unsplash.com/WLUHO9A_xik/1200x450" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/1200x450?computer" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://source.unsplash.com/1200x450/?nature,water" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- carousel end -->

<!-- projects show  design -->
<!-- ====== -->
<div id ="my_portfolio" class="jumbotron mt-3">
  <div class="container text-center">
    <h3>My Portfolio</h3>      
    <p>Some text that represents "Me"...</p>
  </div>
</div>
<!-- ======= -->
<hr class='mx-5'>
<!-- cards for represent projects -->
<div class="container-fluid px-5 py-4 d-flex flex-wrap align-content-start">
  <?php
    if(isset($projects) && count($projects)>0){
      foreach($projects as $project){
        // print_r($project);
  ?>
        <!-- card one -->
        <div class="mx-5 mt-3 card" style="width: 18rem;">
            <img src="<?php echo $project['project_image'];?>" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
              <h5><?php echo $project['project_name'];?></h5>
              <p class="card-text"><?php  echo substr($project['project_description'],0,100).'...';?></p>
            </div>
        </div>

  <?php
      }

    }else{
      echo '<span class="text-danger">There is noone project here..cooming soon</span>';
    }

  ?>  
        
</div>

<!-- contact us section start -->
<!-- ===== -->
<div id="contact_us" class="container-fluid py-3" class="bg-image" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
            height: ">
    <!--contact us jumbotron  -->
    <div class="jumbotron ">
      <div class="container text-center">
        <h3>Contact Us</h3> 
        <p>"Our Team Include Great Thinker. You Would Love To Work With Them As They Are Just Amazing People"</p>     
      </div>
    </div>
    <!-- form and address -->
    <div class="row">
      <!-- first column -->
      <div class=" Px-5 col-7  ">
          <div class="well well-smn m-5">
              <form class="form-horizontal" method="post">
                  <fieldset>
                      <!-- <legend class="text-center header">Contact us</legend> -->
                      <div class="form-group">
                          
                          <div class="col-md-10 my-2">
                            <!-- <i class=" m-2 fs-4 fa fa-user bigicon"></i> -->
                            <input id="name" name="name" type="text" placeholder=" Name" class="form-control">
                            <span id="name_validation" class ="text-danger"></span>
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-md-10 my-2">
                            <!-- <i class=" m-2 fs-4 fas fa-envelope-open-text"></i> -->
                            <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            <span id="email_validation" class ="text-danger"></span>
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-md-10 my-2">
                              <!-- <i class="m-2 fs-4 fa fa-phone-square bigicon"></i> -->
                              <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                              <span id="phone_validation" class ="text-danger"></span>
                          </div>
                      </div>

                      <div class="form-group">
                          
                          <div class="col-md-10 my-2">
                            <!-- <i class=" m-2 fs-4 fas fa-pencil-alt"></i> -->
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                            <span id="message_validation" class ="text-danger"></span>
                          </div>
                      </div>
                      <!-- show message -->
                      <div class="form-group">
                        <div class="col-md-10 my-2 text-center bg-danger">
                          <span id="contact_success" class="text-white" ></span>
                        </div>
                      </div>

                      <div class="form-group m-2">
                          
                          <button id="submit" type="submit" class="btn btn-primary ">Submit</button>  
                      </div>
                  </fieldset>
                  
              </form>
          </div>
      </div>
      <!-- second column for show address -->
      <div class="col-4 " >
          <div class="contact_text p-2">
              <p >Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
              <hr class="m-2" >
              <h3>contact info</h3>
              <div class="contact_info ">
                  <li>info@fahem.me</li>
                  <li>south baluadanga,dinajpur</li>
                  <li>+880174120000,+880174120000,</li>
              </div>
              <hr class="m-2" >
              <h3>follow us</h3>
              <DIV class="contact_social ">
                  <li class="text-primary font-weight-bold" ><i class=" m-2 fs-4 fab fa-facebook-square"></i> Facebook</li>
                  <li class="text-danger font-weight-bold"><i class=" m-2 fs-4 fab fa-google-plus-g"></i>Google+</li>
                  <li class="text-success font-weight-bold"><i class="m-2 fs-4 fab fa-whatsapp-square"></i> Whatsapp</li>
                  <li class="text-info font-weight-bold"><i class=" m-2 fs-4 fab fa-twitter"></i> Twitter</li>
              </DIV>                            
          </div>

      </div>
    </div>
</div>
<!-- ====== -->

<!-- contact from  section end -->
<script type="text/javascript">

  $(document).ready(function(){

    $('#submit').click(function(e) {
        // free all validation message
        $('#name_validation').html('');
        $('#email_validation').html('');
        $('#phone_validation').html('');
        $('#message_validation').html('');
        e.preventDefault();
        var send_url= "<?php echo base_url('index.php');?>"+"/contact_handler/contact";
        // console.log(send_url);
        var name=$('#name').val();
        var email=$('#email').val();
        var phone=$('#phone').val();
        var message=$('#message').val();
        if(name!='' && email!='' && phone!='' && message!='') {
          if(!isNaN(phone)){
            if( phone.length==10 ) { 

              if(IsEmail(email)==true) {

                $.ajax({
                        url:send_url,
                        type:'POST',
                        data:{  
                              name: name,
                              email: email,
                              phone:phone,
                              message:message
                            },
                        success:function(data){
                              console.log(data);
                              $('#name').html("");
                              $('#email').html("");
                              $('#phone').html("");
                              $('#message').html("");
                              $('#contact_success').html(data);
                            }
                });

              } else {
                $('#email_validation').html('invalid email ');
              }
            } else {
              $('#phone_validation').html('your phone number digit is not 10');
            } 
          }else{
            $('#phone_validation').html('please enter valid number');
          }   
        
        }else{
          if(name==''){
            $('#name_validation').html('name is required');
          }
          if(email==''){
            $('#email_validation').html('email is required');
          }
          if(phone==''){
            $('#phone_validation').html('phone  number is required');
          }
          if(message==''){
            $('#message_validation').html('message is required');
          }
          
        }

        //check validation for email
        function IsEmail(email) {

          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email)) {

              return false;
          } else {

              return true;
          }
        }

    });

});

</script>


<?php
include('reuse_files/frontend_footer.php');
?>
