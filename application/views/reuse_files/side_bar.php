<div class=" col-2 side_bar border border-primary">
      <div class="w-100 user_info">

          <img src="<?php if(isset($_SESSION['user_image'])){echo $_SESSION['user_image'];}?>" alt="user_photo">
          <span class="text-center"><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span>
          <span class="text-center text-light text-uppercase"><?php if(isset($_SESSION['user_role_name'])){echo $_SESSION['user_role_name'];}?></span>
          <!-- here designation come  -->
      </div>
      <hr class=" mx-2 text-light">
      <div class="w-100 dashboard-list">
        <ul id="items">
            <?php
                if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='33'){
                    echo '<li class="item nav-item">
                            <a  href="'. base_url('index.php/dashboard_handler').'">Dashboard</a>
                        </li>';
                    echo '<li class=" item nav-item">
                            <a  href="'. base_url('index.php/view_role_handler').'">ROLE</a>
                        </li>';
                    echo '<li class=" item nav-item">
                            <a  href="'. base_url('index.php/view_method_handler').'">METHOD</a>
                        </li>';
                }
                    
            ?> 
            <li class=" item ">
                <a  aria-current="page" href="<?php echo base_url('index.php/view_project_handler');?>">PROJECT</a>
            </li>
            <li class=" item ">
                <a  aria-current="page" href="<?php echo base_url('index.php/view_task_handler');?>">TASK</a>
            </li>
            
            
            <li class="item ">
                <a  aria-current="page" href="<?php echo base_url('index.php/EditProfile_handler');?>">Profile</a>
            </li>  
            
            <li class="item">
                <a  aria-current="page" href="<?php echo base_url('index.php/logout');?>">logout</a>
            </li>     
        </ul>
          
      </div>
</div>