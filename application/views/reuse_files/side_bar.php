<div class=" col-2 side_bar">
      <div class="user_info">

          <img src="<?php if(isset($_SESSION['user_image'])){echo $_SESSION['user_image'];}?>" alt="user_photo">
          <span class="text-center"><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span>
          <span class="text-center text-danger"><?php if(isset($_SESSION['user_role_name'])){echo $_SESSION['user_role_name'];}?></span>
          <!-- here designation come  -->
      </div>
      <div class="dashboard-list">
          <ul id="items">
            <?php 
                if(isset($_SESSION['user_role_id']) && $_SESSION['user_role_id']=='33' ){
                    echo '<li class="item"><a href="#">ROLE</a></li>';
                    echo '<li class="item"><a href="#">METHODS</a></li>';
                }
            ?>
              <li class="item"><a href="#">PROJECTS</a></li>
              <li class="item"><a href="#">TASKS</a></li>
          </ul>
      </div>
</div>