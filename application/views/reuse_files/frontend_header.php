
<html lang="en">

   <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <!-- siede bar link -->
        <?php echo link_tag('assets/css/sidebar_Style.css');?>
        <!-- HOMEPAGE CSS  link -->
        <?php echo link_tag('assets/css/HomePageStyle.css');?>
        <title></title>
    </head>
<body>

<!-- navbar start -->
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ACL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('index.php/home_handler');?>"> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#my_portfolio">My Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#contact_us">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('index.php/registration_handler');?>">Registration</a>
                </li>

                
                <?php 
                    if(isset($_SESSION['user_logged_in'])){
                        echo '<li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="'.base_url('index.php/logout').'">logout</a>
                            </li>';
                    }else{
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="'. base_url('index.php/login_handler').'">login</a>
                    </li>';
                    }
                ?>

            </ul>   
        </div>
    </div>
</nav>

