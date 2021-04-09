<!-- header -->

<?php
include("reuse_files/header.php");
?>
<?php
// all variable
    $task_name='';
    $project_name='';
    $task_description='';
    $task_status='';
    $task_priority='';
    $task_start_date= '';
    $task_end_date='';
if(isset($tasks) && count($tasks)>0){
    $task_id=$tasks[0]['task_id'];
    $task_name=$tasks[0]['task_name'];
    $project_name=$tasks[0]['project_name'];
    $task_description=$tasks[0]['task_description'];
    $task_status=$tasks[0]['task_status1'];
    $task_priority=$tasks[0]['task_priority'];
    $task_start_date= $tasks[0]['task_start_date'];
    $task_end_date=$tasks[0]['task_end_date'];
}




// array prepare for seprate comment and reply
// print_r($comments);
$comment_message=array();
$reply_message=array();
foreach($comments as $comment){
    if($comment['parent_id']!='0'){
        $reply_message[]=$comment;

    }
    if($comment['parent_id']=='0') {
        $comment_message[]=$comment;
    }
}
// echo '<br>';
// echo '</br>';
// print_r($comment_message);
// echo '<br>';
// echo '</br>';
// print_r($reply_message);
?>


<!-- main body -->
<div class="row w-100">
    <!-- side bar start -->
    <?php include('reuse_files/side_bar.php');?>

    <!-- internal body -->
    <div class="col-10 my-2">

        <!-- discription about task  -->
        <div class="mx-5 px-5">
            <p class="text-center">task name:<?php echo $task_name;?></p>
            <p>task of project:  <?php echo  $project_name;?> </p> 
            <p>description:  <?php echo $task_description;?> </p> 
            <p>task status:<?php echo $task_status;?> </p> 
            <p>task prirority:  <?php echo $task_priority;?></p>
            <p>task start date:  <?php echo $task_start_date;?></p>
            <p>task end date:  <?php echo $task_end_date;?></p>

        </div>
        
        <hr class ="mx-5">
        <!-- ask query button -->
        <button type="button" class=" mx-5 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  ask question
        </button>
        <hr class="mx-5">


        <!-- comment represent here -->
        <div class="row mx-5">
            <div class='col-10 mx-5' >
                <?php
                    if(isset($comment_message) && count($comment_message)>0){
                        foreach($comment_message as $comment){
                            
                ?>
                    <div  class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#comment_<?php echo $comment['id'];?>" aria-expanded="true" aria-controls="comment_<?php echo $comment['id'];?>">
                                    <?php 
                                        echo $comment['comment_title'];
                                        echo'<br>';
                                        echo $comment['user_name'];
                                        echo '('.$comment['role_name'].')';
                                        echo'</br>';
                                        echo $comment['comment_date'];
                                    ?>
                                </button>
                                
                            </h2>
                            <div id="comment_<?php echo $comment['id'];?>" class="accordion-collapse collapse <?php if($last_comment==$comment['id']){echo 'show';}?> "         aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>COMMENT DESCRIPTION</strong> <?php echo $comment['comment_description'];?>

                                </div>
                                <!-- reply of comment button -->
                                <button type="button" class="  reply_button mx-5 btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-comment_id="<?php echo $comment['id'];?>">
                                        reply
                                </button>
                                <hr class="mx-5">
                                    <!-- reply column start -->
                                <?php
                                    if(isset($reply_message) && count($reply_message)>0){
                                        foreach($reply_message as $reply){
                                            if($comment['id']==$reply['parent_id']){
                                                

                                ?>
                                    <div  class="mx-5 accordion" id="reply">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#REPLY_<?php echo $reply['id'];?>" aria-expanded="true" aria-controls="REPLY_<?php echo $reply['id'];?>">
                                                    <?php 
                                                        echo $reply['comment_title'];
                                                        echo'<br>';
                                                        echo $reply['user_name'];
                                                        echo '('.$reply['role_name'].')';
                                                        
                                                        echo'</br>';
                                                        echo $reply['comment_date'];
                                                    ?>
                                                </button>
                                                
                                            </h2>
                                            <div id="REPLY_<?php echo $reply['id'];?>" class="accordion-collapse collapse "         aria-labelledby="headingOne" data-bs-parent="#reply">
                                                <div class="accordion-body">
                                                    <strong>COMMENT DESCRIPTION</strong> <?php echo $reply['comment_description'];?>

                                                </div>
                                                <!-- reply of comment button
                                                <button type="button" class="  reply_button mx-5 btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-comment_id="<?php echo $reply['id'];?>">
                                                        reply
                                                </button> -->
                                            </div>

                                        </div>
                                    </div> 

                                <?php                
                                            }
                                        }
                                    }

                                ?>
                                
                            </div>

                        </div>
                    </div>    
                <?php
                        }

                    }else{
                        echo '<spanclass ="text-danger">there is no one commments</span>';
                    }
                ?>
                           
            </div>
        </div>

        <!-- end -->
       


        <!-- button end -->
        <!-- query form start (model)-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ASK QUESTION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form start -->
                    <?php echo form_open('task_comment_handler/submit_comment',' class="column g-1"');?>   
                        <!-- hidden form task id -->
                        <?php
                            $data = [
                                'type'  => 'hidden',
                                'name'  => 'task_id',
                                'value' => $task_id  
                            ];
                            echo form_input($data);
                        ?>
                        <!-- hidden form user id(from session) -->
                        <?php
                            $data = [
                                'type'  => 'hidden',
                                'name'  => 'user_id',
                                'value' => $_SESSION['user_id']  
                            ];
                            echo form_input($data);
                        ?>
                        <!-- parent id in hidden form -->
                        <?php
                            $data = [
                                'type'  => 'hidden',
                                'name'  => 'parent_id',
                                'id'   =>'parent_id',
                                 
                            ];
                            echo form_input($data);
                        ?>
                        <div class="m-1">
                            <?php echo form_label('What is query title', 'comment_title',['class'=>'visually m-1'] );?>
                            <?php echo form_input([ 'name'=>'comment_title' , 'class'=>'form-control', 'id'=>'query_title' ,'value'=>set_value('comment_title'), 'PLACEHOLDER'=>'ENTER YOUR query']);?>
                            <span class="text-danger"><?php echo form_error('comment_title');?></span>
                        </div>
                        <div class=" m-1">
                            <?php echo form_label('query discription', 'commentdesc',['class'=>'visually m-1'] );?>
                            <?php echo form_input([ 'name'=>'comment_desc' , 'class'=>'form-control', 'id'=>'email' ,'value'=>set_value('comment_desc'), 'PLACEHOLDER'=>'DESCRIPTION']);?>
                            <span class="text-danger"><?php echo form_error('comment_desc');?></span>
                        </div>
                        <?php echo form_submit(['class'=>'btn btn-primary','name'=>'submit','value'=>'submit']);?>
                    </form>
                    <!-- form end -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </div>
        <!-- ==========model  end============ -->
        <!-- qyery orm end (model) -->
    </div>
</div> 
<!-- javascript for get the reply button value  -->
<script>
    $(document).ready(function(){
      $(document).on("click",".reply_button", function(){

        var commentId=$(this).data("comment_id");
        $('#parent_id').val(commentId);
    
        });
    });

</script>
<!-- footer -->
<?php
include("reuse_files/footer.php");
?>