<?php 

 //user id of logged user
$sessionUserId = $user->get_user_details("id", 'userid', $_SESSION['loginName'],'echo');
 //get all categories
 $allCategories =  $sys->getTable('id, description, hex_color', 'design_categories','','');
 
//get all statuses
$allStatuses =  $sys->getTable('id, description', 'design_statuses','','');

// get old issue details
$old_issue = $sys->getTable('*', 'design_issues', 'id', $urlIssueId);

//modify the dates from old issue( remove time )
$moddedDate_in = $sys->dateMod($old_issue['date_in']); 
$moddedDate_out = $sys->dateMod($old_issue['date_out']); 

?>

<nav> <?php echo "<a href='?page=issues&design_id={$urlDesignId}' class='nav-link'>&lt; Cancel</a>"; ?> </nav> 
 
<div class="secondary-component-container">

        <!-- tab head -->
        <div class="control-tab">        
                 <span class="title-caption">EDIT ISSUE: </span> 
                 <span class="title-value"><?php echo $urlIssueId; ?></span> 
        </div>
        <!-- tab body -->
        <div class="secondary-component-body "> 
                <form method="post"> 
                        <!-- form body -->
                        <div class="form-group">
                                <label  for='input-design_id' class="input-label">Design id:</label>
                                <input   id='input-design_id' class="input-field" name="design_id" type="text" disabled placeholder="<?php echo $urlDesignId; ?>">
                        </div>
                        <div class="form-group ">
                                <label for='input-category' class="input-label">Category:</label>
                                <select id='input-category' class="input-field" name="category_id">
                                        <?php  while($r = mysqli_fetch_assoc($allCategories)){    
                                                ($r['id'] == $old_issue['category_id'] ) ? $selected = 'selected' :   $selected = '';
                                                echo ("<option {$selected} style='font-weight:bold;color:".$r['hex_color']."'   value='".$r['id']."'>    ".$r['description']."     </option>"); 
                                                
                                                } ?>                                          
                                </select> 
                        </div>

                        <div class="form-group">
                                <label  for='input-date_in' class="input-label">Date in:</label>
                                <input value='<?php  echo   $moddedDate_in; ?>'   id='input-date_in' class="input-field" name="date_in" type="date" placeholder="<?php  echo  $moddedDate_in; ?>">
                        </div>

                        <div class="form-group">
                                <label  for='input-date_out' class="input-label">Date out:</label>
                                <input value='<?php  echo   $moddedDate_out; ?>'   id='input-date_out' class="input-field" name="date_out" type="date" placeholder="<?php  echo   $moddedDate_out; ?>">

                        </div>
                        
                        <div class="form-group">
                                <label  for='input-status'  class="input-label">Status:</label>
                                <select  id='input-status'  class="input-field" name="status_id">
                                <?php  while($r = mysqli_fetch_assoc($allStatuses)){    
                                                 ($r['id'] == $old_issue['status_id'] ) ? $selected = 'selected' :   $selected = '';
                                        echo ("<option {$selected} value='".$r['id']."'>".$r['description']."</option>");  
                                
                                } ?>  
                                        
                                </select>
                        </div>

                        
                        <div class="form-group">
                                <label  for='input-drawing'  class="input-label">Drawing Required:</label>
                                <select  id='input-drawing'  class="input-field" name="drawing_req">

                                        <?php 
                                                $selectedYes='';
                                                $selectedNo='';
                                        $drawing_req =   ($old_issue['drawing_req'] == 0 ? $selectedNo = 'selected': $selectedYes = 'selected'); 
                                        
                                               
                                                        echo ("<option {$selectedNo} value='0'>No</option>");
                                                        echo ("<option {$selectedYes} value='1'>Yes</option>");
                                        
                                        ?>
                                           
                                </select>
                        </div>

                        <div class="form-group">
                            <label  for='input-description'  class="input-label">Description:</label> 
                           <textarea  id='input-description'  class="input-field" name="description"  cols="20" rows="3" placeholder='<?php  echo  ucfirst($old_issue['description']); ?>'><?php  echo  ucfirst($old_issue['description']); ?></textarea>
                        </div>

                        <input type="submit" id="submit-editIssue" name='editIssue' style='display:none;' /> 
                </form>
        </div>

        <!-- tab  @form button -->
        <div class="form-button">
                <label  class="form-btn"  for="submit-editIssue" tabindex="0">EDIT ISSUE</label> 
        </div>
 
</div>


<?php

 
if(isset($_POST['editIssue']) & !empty($_POST)){
       
       
          $idToUpdate = $urlIssueId; 
         
        if($sessionUserId == null)      
                {   $sys->redirectMsg('.container-site', 'error', 'user-not-logged', 'login-page','', '' ); }
        else    {   $designer_id = $sessionUserId['id']; }
    
        
        // $checker_id = NULL ; // this is set in the query inside the function
        $category_id = $_POST['category_id'];
        $date_in = $sys->sanitizeData($_POST['date_in']);
        $date_out = $sys->sanitizeData($_POST['date_out']);
        $status_id = $_POST['status_id'];
        $drawing_req =   ($_POST['drawing_req'] == 0 ? "0" : "1"); 
        $description = $sys->sanitizeData($_POST['description']);
                        
        
        
        
 $user->editIssue($urlDesignId, $idToUpdate,  $category_id, $description, $date_in, $date_out, $designer_id,  $status_id, $drawing_req);
   

 // free memory
$obj = [$allCategories, $allStatuses ];
 
 $sys->freeMemory($obj);
}
?>



