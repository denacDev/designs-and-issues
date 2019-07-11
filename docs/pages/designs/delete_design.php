
        <div class="secondary-component-container"> 
<?php
        // check if any design /issue has been selected
        if ( empty($urlDesignId) ) {  ?>

        
                            <nav> <a href='?page=designs'class="nav-link ">&lt; Go back</a>  </nav> 

                            <div class="control-tab"> 
                                    <span class="  error-msg">NO DESIGN SELECTED</span> 
                            </div>

                            <div class="disabled-link secondary-component-body"> 
                                <h1 style="margin:100px;"class='error-msg'>Please go back, <br>select a design and come back,<br> in order to continue!..</h1> 
                            </div>
                    
            

        <?php } else{ ?>
        
                            <nav>  <?php echo "<a href='?page=designs&open_design={$urlDesignId}' class='nav-link'>&lt; Cancel</a>"; ?> </nav> 

                            
                             <!-- head -->
                            <div class="control-tab">
                                <span class="title-caption">DELETE DESIGN: </span>
                                <span class="title-value"><?php echo($urlDesignId); ?></span> 
                            </div>   

                            <!-- message -->
                            <div class="secondary-component-body">

                                    <!-- check if there are any issues -->
                                    <?php $issues =  $sys->show_issues('design_id', $urlDesignId, true); 
            
                                           if ($issues > 0){ ?> <!-- ISSUES FOUND-->
             
                                                <h3 class="danger"> 
                                                        <p> ISSUES FOUND IN THE DATABASE  </p>
                                                        <p style='color:black;'>Please remove the issues first!</p>
                                                </h3>   
                            </div> <!-- end secondary-component-body -->

                                                <!-- button -->
                                                <a href="?page=issues&design_id=<?php echo $urlDesignId ?>" class="site-link  delete-view-issues">VIEW ISSUES(<?php echo $issues; ?>)</a> 
                                 
                                    <?php }else{ ?> <!-- NO ISSUES IN DATABASE --> 

                                                <h3 class="info">
                                                    <p style='margin-top:30px;'> No issues found in database  </p>
                                                    <p style='color:black;margin:10px;'>Are you sure you want to delete it ?</p>
                                                </h3>   

                            </div><!-- end secondary-component-body -->

                                                <!-- button -->
                                                <form method='post' class='delete-form'>
                                                    <input class="form-btn" name="submit_delete_design" type="submit" value="DELETE DESIGN"> 
                                                </form> 
                            
                                    <?php }  

            
                                        if(isset($_POST['submit_delete_design'])){

                                            $user->deleteDesign($urlDesignId);
                                            

                                        }

            
                            
                                            
 


        

                    } ?>


</div>