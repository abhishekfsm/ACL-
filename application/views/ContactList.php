
<?php  include('reuse_files/header.php'); ?>
<?php //print_r($users_data);?>
<div class="row w-100">

  <!-- side bar start -->
  <?php include('reuse_files/side_bar.php');?>

  <div class="col-10 my-5">
    <table  class="  table table-striped ">
      <thead class="thead-dark bg-dark text-white">

        <tr>
         
          <th scope="col">contacter Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Message</th>
          <th scope="col" >Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
            if(isset($contacters) && count($contacters)>0){
            foreach($contacters as $contacter){
        ?>
          <tr>
            <td><?php echo $contacter['name'];?></td>
            <td><?php echo $contacter['email'];?></td>
            <td><?php echo $contacter['phone'];?></td>
            <td><?php echo $contacter['message'];?></td>
            <td><?php echo $contacter['contact_date'];?></td>   
          </tr>
        <?php 
            }
        }else{
            echo '<span class ="text-center text-danger">no one contacter</span>';
        }
        ?>     
      </tbody>
      
    </table>
  </div>
</div>
<?php
include('reuse_files/footer.php');
?>