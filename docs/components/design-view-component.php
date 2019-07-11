
<?php
  
    while($design = mysqli_fetch_assoc($design_template)){
   
    
    // design_type :: DESCRIPTION 
    $design_type_desc = $sys->getTable('description', 'design_types','id', $design['design_type_id']);
    // count all the issues in the database for this design
    $issue_count = $sys->show_issues("design_id", $design["id"], true);
   
        //used in javascript
        $panelId  = "'design-panel-".$design['id']."'";
        $buttonId = "'design-button-".$design['id']."'";
        $ids = $panelId.",".$buttonId;


?>
    
    
    <!--   header -->
    <div class="design-tab">


                <!-- id -->
                <div class="design-id-container">
                    <div class="id-caption">ID:</div>
                    <div class="design-id"> <?php echo  $design['id']; ?></div>
                </div> 
                
                <!-- title -->
                <div class="design-title-container"><?php echo  ucfirst($design['title']); ?></div> 
                <?php   
                    if($issue_count > 0 )
                        {echo "<div class='design-title-container login-caption'>has ".$issue_count." issues</div> "; }
                    else{echo "<div class='design-title-container login-caption'>no issues</div> "; }
                
                 ?>
                
            
                <!-- control buttons -->
                <div class="design-control-buttons"> 
                 <!-- edit button -->
                <a <?php echo ($sesJobTitle == 'senior') ? " href='?page=edit_design&design_id=".$design['id']."'" : "  class='disabled-link'    onclick='msg(\".container-site\", \"warning\", \"privilege\",\"Edit a design\")'  href='#'   " ;  ?> >
                    <img width='26px'src='docs/assets/img/edit.png' title='Edit Design' alt="Edit button" class="modify-buttons edit-button"> 
                </a>
                <!-- delete button -->
                <a <?php echo ($sesJobTitle == 'senior') ? " href='?page=delete_design&design_id=".$design['id']."'" : "  class='disabled-link'    onclick='msg(\".container-site\", \"warning\", \"privilege\",\"Delete a design\")'  href='#'   " ;  ?> >
                    <img width='26px'src="docs/assets/img/delete.png" title='Delete Design' alt="Delete button" class="modify-buttons delete-button">
                </a>
                <!-- show body details button -->
                <div  onclick="openBody(<?php echo $ids;  ?>)" id=<?php echo $buttonId; ?>   class=" design-dropdown-button modify-buttons dropdown-button">
                    <span class='dropdown-h-line'></span><span class='dropdown-v-line'></span>
                </div>

            </div>  


    </div>  <!--end of design tab (header} -->
 



    <!-- body  --> 
    <div class="primary-component-design-body" id=<?php echo $panelId; ?> >
            <!-- panel left -->
            <div class="design-body-left panel">

                <div class="panel-content">

                    <div class="value-container">
                        <div class="value-caption">CUSTOMER:</div>
                        <div class="value"> <?php echo  $design['customer_id']; ?></div>
                    </div>
                    <div class="value-container">
                        <div class="value-caption">LOCATION:</div>
                        <div class="value"> <?php echo  $design['location_id']; ?></div>
                    </div>
                    <div class="value-container">
                        <div class="value-caption">CONTRACTOR:</div>
                        <div class="value"> <?php echo  $design['contractor_id']; ?></div>
                    </div>
                    <div class="value-container">
                        <div class="value-caption">SPECIAL:</div>
                        <div class="value"><?php echo  ($design['special_project'] == 0 ? "No" : "Yes"); ?></div>
                    </div> 
                    
                </div>

            </div> 
 
            <!-- panel right -->
            <div class="design-body-right panel">

                    <div class="panel-content">

                        <div class="value-container">
                                <div class="value-caption">DESIGN TYPE:</div>
                                <div class="value"> <?php   echo $design_type_desc['description'];     ?></div>
                        </div>
                        <div class="value-container">
                                <div class="value-caption">PERMANENT WORKS</div>
                                <div class="value"><?php echo  ($design['permanent_works'] == 0 ? "No" : "Yes"); ?></div>
                        </div>
                        <div class="value-container">
                                <div class="value-caption">DEPTH:</div>
                                <div class="value"><?php echo  $design['depth']; ?></div>
                        </div>
                        <div class="value-container">
                                <div class="value-caption">LENGTH:</div>
                                <div class="value"><?php echo  $design['length']; ?></div>
                        </div>
                
                        <div class="value-container">
                                <div class="value-caption">WIDTH:</div>
                                <div class="value"><?php echo  $design['width']; ?></div>
                        </div>

                    </div>
     
            </div>

            <!-- panel bottom -->
            <div class="design-body-bottom panel">    
                    <!-- check to see if the variable is set--> <!-- if not, it means it's on design page and it will throw and error if not checked --> 
                    <?php    if ($show_single_design == "no"){   ?>

                        <a href="?page=issues&design_id=<?php echo $design["id"];  ?>" class="site-link button-view-issues">VIEW ISSUES(<?php echo  $issue_count; ?>)</a> 
                        
                    <?php  } ?> <!-- end if isset($design_presentation) -->

              
            
            
            </div> <!--end of bottom panel -->

    </div> <!--end of design body -->
            


<?php }  ?><!--  end while loop -->

<?php // $user->openBody("{$design["id"]}", "issue" ); 


 // free memory
 
 $sys->freeMemory($design_template);
 ?>