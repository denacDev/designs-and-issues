<?php 
 
 
//user id of logged user
$sessionUserId = $user->get_user_details("id", 'userid', $_SESSION['loginName'],'echo');

// user full name ( the person who created the design)
$designerName = $user->get_user_details("name", 'userid', $_SESSION['loginName'],'echo');
 
 //get all categories
$allCategories =  $sys->getTable('id, description, hex_color', 'design_categories','','');

//get all statuses
$allStatuses =  $sys->getTable('id, description', 'design_statuses','','');

// //get title of curent design ( one time)  
$design_title =  $sys->getTable('title', 'designs','id',$urlDesignId);
  
?>

<nav> <a href='?page=issues&design_id=<?php echo $urlDesignId; ?>'class="nav-link ">&lt; Back</a>  </nav>

<div class="secondary-component-container">

        <!-- tab head -->
        <div class="control-tab">        
                 <span class="title-caption">NEW ISSUE FOR:</span> 
                 <span class="title-value"><?php  echo ucfirst( $design_title['title']);     ?> </span> 
        </div>
        <!-- tab body -->
        <div class="secondary-component-body "> 
                <form method="post"> 
                        <!-- form body -->
                        <div class="form-group">
                                <label  for='input-design_id' class="input-label">Design id:</label>
                                <input   id='input-design_id' class="input-field" name="design_id" type="text" disabled placeholder="<?php echo $urlDesignId; ?>">
                        </div>
                        <div class="form-group">
                                <label  for='input-design_id' class="input-label">Designer:</label>
                                <input   id='input-design_id' class="input-field" name="designer_id" type="text" disabled placeholder="<?php echo $designerName['name']; ?>">
                        </div>
                        <div class="form-group">
                                <label  for='input-design_id' class="input-label">Checker:</label>
                                <input   id='input-design_id' class="input-field" name="checker_id" type="text" disabled placeholder="<?php echo 'null'; ?>">
                        </div>
                        <div class="form-group ">
                                <label for='input-category' class="input-label">Category:</label>
                                <select id='input-category' class="input-field" name="category_id">
                                <?php  while($r = mysqli_fetch_assoc($allCategories)){    echo ("<option style='font-weight:bold;color:".$r['hex_color']."' value='".$r['id']."'>".$r['description']."</option>");  } ?>  
                                        
                                </select> 
                        </div>

                        <div class="form-group">
                                <label  for='input-date_in' class="input-label">Date in:</label>
                                <input   id='input-date_in' class="input-field" name="date_in" type="date" value ="<?php echo date("Y-m-d");?>">
                        </div>

                        <div class="form-group">
                                <label  for='input-date_out' class="input-label">Date out:</label>
                                <input   id='input-date_out' class="input-field" name="date_out" type="date" value ="<?php echo date("Y-m-d");?>">

                        </div>
                        
                        <div class="form-group">
                                <label  for='input-status'  class="input-label">Status:</label>
                                <select  id='input-status'  class="input-field" name="status_id">
                                <?php  while($r = mysqli_fetch_assoc($allStatuses)){    echo ("<option value='".$r['id']."'>".$r['description']."</option>");  } ?>  
                                        
                                </select>
                        </div>

                        
                        <div class="form-group">
                                <label  for='input-drawing'  class="input-label">Drawing Required:</label>
                                <select  id='input-drawing'  class="input-field" name="drawing_req">    
                                        <option value='0'>No</option>
                                        <option value='1'>Yes</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label  for='input-description'  class="input-label">Description:</label> 
                           <textarea id='input-description'  class="input-field" name="description"  cols="20" rows="3" placeholder='Add description'></textarea>
                        </div>

                        <input type="submit" id="submit-go" name='submit_and_go' style='display:none;' /> 
                        <input type="submit" id="submit-stay" name='submit_and_stay' style='display:none;' /> 
                </form>
        </div>

        <!-- tab  @form button -->
        <div class="form-button">
                <label style='display:inline-block;'  class="form-btn"  for="submit-go" tabindex="0">ADD ISSUE and go</label>  
                <label style='display:inline-block;'  class="form-btn"  for="submit-stay" tabindex="0">ADD ISSUE and stay</label>  
        </div>
 
</div>

<?php

 
if(isset($_POST['submit_and_go']) || isset($_POST['submit_and_stay']) && !empty($_POST)){
       
         // in case of go --> redirect
         if(isset( $_POST['submit_and_go'])){ $stayOrGo = "go";}else{$stayOrGo = "";}


        $design_id = $urlDesignId; 

        if($sessionUserId == null)     
                { $sys->redirectMsg('.container-site', 'error', 'user-not-logged', 'login-page','', '' ); } 
        else    { $designer_id = $sessionUserId['id'];  }
    
        
        // $checker_id = NULL ; // this is set in the query inside the function
        $category_id = $_POST['category_id'];
        $date_in = $sys->sanitizeData($_POST['date_in']);
        $date_out = $sys->sanitizeData($_POST['date_out']);
        $status_id = $_POST['status_id'];
        $drawing_req =   ($_POST['drawing_req'] == 0 ? "0" : "1"); 
        $description = $sys->sanitizeData($_POST['description']);
                        
        
        
        
$user->addIssue($stayOrGo, $design_id, $category_id, $description, $date_in, $date_out, $designer_id,   $status_id, $drawing_req);
 
// free memory
$obj = [ $allCategories,$allStatuses]; 
$sys->freeMemory($obj);

        
}
?>
 
