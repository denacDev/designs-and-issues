
        <div class="secondary-component-container"> 
<?php
        // check if any design /issue has been selected
        if ( empty($urlDesignId) || empty($urlIssueId) ) {  ?>

        
                            <nav> <a href='?page=designs'class="nav-link ">&lt; Go back</a>  </nav> 

                            <div class="control-tab"> 
                                    <span class="  error-msg">NO ISSUE SELECTED</span> 
                            </div>

                            <div class="disabled-link secondary-component-body"> 
                                <h1 style="margin:100px;"class='error-msg'>Please go back, <br>select a ISSUE and come back,<br> in order to continue!..</h1> 
                            </div>
                    
            

        <?php } else{ ?>
        
                            <nav>  <?php echo "<a href='?page=issues&design_id={$urlDesignId}' class='nav-link'>&lt; Cancel</a>"; ?> </nav> 
                            
                             <!-- head -->
                            <div class="control-tab">
                                <span class="title-caption">DELETE ISSUE width id: </span>
                                <span class="title-value"><?php echo($urlIssueId); ?></span> 
                            </div>   

                            <!-- message -->
                            <div class="secondary-component-body">

                                    <!-- check if the issue is in database -->
                                    <?php $issues =  $sys->show_issues('design_id',  $urlDesignId, true);  ?>  

                                                <h3 class="info">
                                                    <p style='margin-top:30px;'> <?php echo "There are ".$issues. " issues for design: ".$urlDesignId; ?>  </p>
                                                    <p style='color:black;margin:10px;'>Are you sure you want to delete this one ?</p>
                                                </h3>   

                            </div><!-- end secondary-component-body -->

                                                <!-- button -->
                                                <form method='post' class='delete-form'>
                                                    <input class="form-btn" name="submit_delete_issue" type="submit" value="DELETE ISSUE"> 
                                                </form> 
                            
                                    <?php 

            
                                        if(isset($_POST['submit_delete_issue'])){

                                            $user->deleteIssue($urlIssueId, $urlDesignId);
                                        }  

                                
 

            } ?>


</div>