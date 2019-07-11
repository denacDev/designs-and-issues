
    <?php
 
 while($issue = mysqli_fetch_assoc($issue_template)){
       
        // other tables
         
        // design :: TITLE 
        $design_title = $sys->getTable('title', 'designs','id', $issue['design_id']); 

        // design_category :: DESCRIPTION 
        $category_title = $sys->getTable('description, hex_color', 'design_categories','id', $issue['category_id']);
        
        // designer_id :: NAME ( ENGINEER/ SENIOR)
         $designer_name = $user->get_user_details('name', 'id',$issue['designer_id'] , 'echo');

        // in case the issue is not checked yet.
         if($issue['checker_id'] != null  ){   
        // checker_id :: NAME 
          $senior_checker = $user->get_user_details('name', 'id', $issue['checker_id'] , 'echo');
        }
        //used to show if an issue can be checked or not
        $loggedUserId = $user->get_user_details('id', 'userid', $sesUserName , 'echo');

        // status_id :: DESCRIPION 
        $status_title = $sys->getTable('description', 'design_statuses','id', $issue['status_id']);




        //used in javascript TO OPEN ISSUES BODIES
        $panelId  = "'issue-panel-".$issue['id']."'";
        $buttonId = "'issue-button-".$issue['id']."'";
        $issuesIds = $panelId.",".$buttonId;
         
      
?>

     
     <!--   header -->

        <div class="issue-tab"> 
        <!-- id -->
        <div class="design-id-container issue-id-container">
                <div class="id-caption">ISSUE ID:</div>
                <div class="design-id issue-id"> <?php echo  $issue['id']; ?></div>
                <?php    
                        if($issue['checker_id'] != null ){ echo '<div class="checked-label-info"> checked</div>';} 

                        if($issue['checker_id'] != $loggedUserId && $issue['checker_id'] != NULL)
                        { echo '<div class="checked-label-danger"> cannot check</div>';} 
                        else
                        { echo '<div class="checked-label"> checkable </div>';} 
                               
                ?>
        </div> 
        
        <!-- control buttons -->
        <div class="design-control-buttons issue-control-buttons"> 
                <!-- edit button -->
                <a href='?page=edit_issue&<?php  echo "design_id=".$urlDesignId."&issue_id=".$issue['id'];   ?>'><img width='20px'src='docs/assets/img/edit.png' title='Edit Design' alt="Edit button" class="issue-buttons edit-button"> </a>
                <!-- delete button -->
                <a href='?page=delete_issue&<?php  echo "design_id=".$urlDesignId."&issue_id=".$issue['id'];   ?>'><img width='20px'src="docs/assets/img/delete.png" title='Delete Design' alt="Delete button" class="issue-buttons delete-button"> </a>
                
               <!-- show body details button-->
                <div  onclick="openBody(<?php echo $issuesIds;  ?>)"   id=<?php echo $buttonId; ?>     class=" issue-dropdown-button dropdown-button issue-buttons">
                        <span  style='background-color:white;' class='dropdown-h-line  '></span>
                        <span  style='background-color:white;' class='dropdown-v-line  '></span>
                </div>
        </div>  


        </div>  <!--end of design header-->



<!-- body -->


<div class="primary-component-issue-body"  id=<?php echo $panelId; ?>  > 
     <!-- panel left -->
    <div class="issue-panel-left panel">
        
            <div class="panel-content">

                    <div class="value-container">
                            <div class="value-caption">DESIGN:</div>
                            <div class="value"><?php   echo $design_title['title'];     ?></div>
                    </div>
                    <div class="value-container">
                            <div class="value-caption">CATEGORY:</div>
                            <div class="value" style="color: <?php echo $category_title['hex_color']; ?>;"> 
                                <?php  echo $category_title['description'];  ?>
                            </div>
                    </div>
                    <div class="value-container">
                            <div class="value-caption">DATE IN:</div>
                            <div class="value"><?php echo  $issue['date_in']; ?></div>
                    </div>
                    <div class="value-container">
                            <div class="value-caption">DATE OUT:</div>
                            <div class="value"><?php echo  $issue['date_out']; ?></div>
                    </div>
             

            </div>

    </div>
    <!-- panel middle -->
    <div class="issue-panel-middle panel">
        
        <div class="panel-content">

                <div class="value-container">
                        <div class="value-caption">DESIGNER:</div>
                        <div class="value"><?php   echo $designer_name['name'];   ?></div>
                </div>
                <div class="value-container">
                        <div class="value-caption">CHECKER:</div>
                        <div class="value"><?php    if($issue['checker_id'] == null  ){echo "not checked yet";} else{echo $senior_checker['name'];}     ?></div>
                </div>
                <div class="value-container">
                        <div class="value-caption">STATUS:</div>
                        <div class="value"><?php    echo $status_title['description'];   ?></div>
                </div>
                <div class="value-container">
                        <div class="value-caption">DRAWING REQ:</div>
                        <div class="value"><?php echo  ($issue['drawing_req'] == 0 ? "No" : "Yes");    ?></div>
                </div>
        
             

        </div>

    </div>
    <!-- panel right -->
    <div class="issue-panel-right panel">
        <div class="check-container">

                <?php 
                        $checked = $issue['checker_id'];
                        if ($checked != null){ ?> 

                                 <div class="checked-caption">CHECKED</div>

                <?php }else{ ?>  <!-- else -->
                                <div class="check-caption">NOT CHECKED</div> 

                                <!--  form -->
                                <form method="post" > <?php 

                                        // verify if the checker is an SENIOR
                                        if($sesJobTitle == "senior"){
                                        

                                                //VERIFY IF OTHER ENGINEER CREATED THE ISSUE BASED ON THE LOGIN NAME
                                                
                                                //1. select id based on user id 
                                                $designer_userid = $user->get_user_details('id', 'userId',$sesUserName , 'echo');
                                                $designer_count = $user->get_user_details('id', 'userId',$sesUserName , 'count'); 

                                                //2. check if atleast one has been found in db
                                                if ($designer_count < 1) {
                                                        echo "<span class='warning-fixed-msg'>No designer found in database( O-o :: what ?)</span>"; 
                                                }else{ 
                                                                        // if the issue designer id is not equal with the one who is logged ( allow check)
                                                                        if(  $designer_userid['id'] != $issue["designer_id"] ){ ?> 

                                                                                <!--  set the name of the designer as the checker of this issue  -->
                                                                                <input type="hidden" name="checker_id" value="<?php echo $designer_userid['id'] ?>" />  
                                                                                <input type="hidden" name="issue_to_check" value="<?php echo $issue['id'] ?>" />  
                                                                                <input type="submit" class="issue-check-link site-link"  name="submit_check_issue" value="CHECK" />  
                                                                                
                                                                        <?php   // deny check because it was created by the logged engineer
                                                                        }else{
                                                                                echo "<div class='login-caption'>Created by you</div>";
                                                                                echo "<div class='check-button-msg-error'>Cannot check</div>";
                                                                        } // end if designer id != issue designer id
 
                                                }// end if designer_count

                                        
                                                
                                        
                                        // if the checker is not a senior
                                        }else{ 
                                                echo "<div class='check-button-msg-error'>Not allowed to check</div>";   
                                        }?>

  



                                
                                </form>
                               

                       
                                
                                
                       
                       
                   
                <?php }?>  <!-- end if $checked != null -->
        </div>
    </div>
    <!-- panel bottom -->
    <div class="issue-panel-bottom panel">
    
                <div class="issue-description-container">
                        <div class="description-caption">DESCRIPTION:</div>
                        <div class="description-value"><?php echo $issue['description'] ; ?></div>
                </div>

    </div>
</div> <!--end of issue body -->




<?php   
  } 

if (isset($_POST['submit_check_issue'])){
        $checker = $_POST['checker_id'] ;
       $idToCheck = $_POST['issue_to_check'] ;
 
        
        $user->checkIssue($checker, $idToCheck,$urlDesignId );

        if(isset($_GET['open_issue'])){

                echo   $sys->openBody("{$_GET['open_issue']}", "issue" ); 
            }


}// end issue      

 // free memory
  $sys->freeMemory($issue_template);
 

 

?><!--  end while loop -->