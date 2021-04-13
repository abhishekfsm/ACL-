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
<div class="jumbotron">
  <div class="container text-center">
    <h1>My Portfolio</h1>      
    <p>Some text that represents "Me"...</p>
  </div>
</div>
<!-- ======= -->
<hr class='mx-5'>
<div class="container d-flex flex-wrap justify-content-center border border-primary">
  
        <!-- card one -->
        <div class=" m-3 card" style="width: 18rem;">
            <img src="https://source.unsplash.com/1200x450?computer" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <!-- card one -->
        <div class="m-3 card" style="width: 18rem;">
            <img src="https://source.unsplash.com/1200x450?computer" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <!-- card one -->
        <div class="m-3 card" style="width: 18rem;">
            <img src="https://source.unsplash.com/1200x450?computer" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
        <!-- card one -->
        <div class="m-3 card" style="width: 18rem;">
            <img src="https://source.unsplash.com/1200x450?computer" class="card-img-top" alt="..." width="200" height="200">
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
</div>

<!-- contact us section start -->
<div class="jumbotron">
  <div class="container text-center">
    <h3>contact us</h3> 
    <p>OUR TEAM INCLUDES GREAT THINKERS. YOU WOULD LOVE TO WORK WITH THEM AS THEY ARE JUST AMAZING PEOPLE.</p>     
    
  </div>
</div>

<!-- ===== -->
<div class="container-fluid border border-primary" class="bg-image" 
     style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg');
            height: 100vh">
    <div class="row">
        <div class=" mx-5 col-7 border border-primary">
            <div class="well well-sm">
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <!-- <legend class="text-center header">Contact us</legend> -->

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="fname" name="name" type="text" placeholder="First Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            
                            <button type="submit" class="btn btn-primary ">Submit</button>
                          
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- second column for show address -->
        <div class="col-4 border border-danger" >
            <div class="contact_text p-5">
                <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                <h3>contact info</h3>
                <ul class="contact_info">
                    <li>info@fahem.me</li>
                    <li>south baluadanga,dinajpur</li>
                    <li>+880174120000,+880174120000,</li>
                </ul>
                <hr class="m-2" >
                <h3>follow us</h3>
                <ul class="contact_social">
                    <li><i class="fab fa-facebook-square"></i>facebook</li>
                    
                    <li><i class="fab fa-whatsapp-square"></i>whatsapp</li>
                    <li><i class="fab fa-twitter"></i>twitter</li>
                </ul>                            
            </div>

        </div>
    </div>
</div>
<!-- ====== -->

<!-- contact from  section end -->


<?php
include('reuse_files/frontend_footer.php');
?>
