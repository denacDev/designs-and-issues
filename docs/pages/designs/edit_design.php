<nav> <a href='?page=designs'class="nav-link ">&lt; Cancel</a>  </nav>
<?php 
 
//get all design types
$allDesign_types = $sys->getTable('id, description', 'design_types','','');
// get old design details
$old_design = $sys->getTable('*', 'designs', 'id', $urlDesignId);

     
?>



<div class="secondary-component-container">

        <!-- tab head -->
        <div class="control-tab"> 
                <div class="title-caption">EDIT DESIGN:</div> 
                <div class="title-value"> <?php  echo  ucfirst($old_design['title']); ?> </div> 
        </div>
        <!-- tab body -->
        <div class="secondary-component-body "> 
                <form method="post" name='add_design'> 
                        <!-- form body -->
                        <div class="form-group ">
                                <label for='input-customer' class="input-label">Customer:</label>
                                <input value="<?php  echo  ucfirst($old_design['customer_id']); ?>" id="input-customer" class="input-field" name="customer" placeholder='<?php  echo  ucfirst($old_design['customer_id']); ?>'>
                        </div>

                        <div class="form-group">
                                <label  for='input-location' class="input-label">Location:</label>
                                <input value="<?php  echo  ucfirst($old_design['location_id']); ?>" id="input-location" class="input-field" name="location" placeholder='<?php  echo  ucfirst($old_design['location_id']); ?>'>
                        </div>

                        <div class="form-group">
                                <label  for='input-contractor'  class="input-label">Contractor:</label>
                                <input value="<?php  echo  ucfirst($old_design['contractor_id']); ?>" id="input-contractor" class="input-field" name="contractor" placeholder='<?php  echo  ucfirst($old_design['contractor_id']); ?>'>
                                
                        </div>
                        <div class="form-group">
                                <label  for='input-contractor'  class="input-label">Title:</label>
                                <input value="<?php  echo  ucfirst($old_design['title']); ?>" id="input-contractor" class="input-field" name="design_title" placeholder='<?php  echo  $old_design['title']; ?>'>
                                
                        </div> 
                        
                        <div class="form-group">
                                <label  for='input-design'  class="input-label">Design type:</label>
                                <select  id='input-design'  class="input-field" name="design_type_id"> 
                                        <?php  while($r = mysqli_fetch_assoc($allDesign_types)){   
                                              
                                                // check which desing type was before editing
                                                ($r['id'] == $old_design['design_type_id'] ) ? $selected = 'selected' :   $selected = '';
                                                echo ("<option {$selected} value='".$r['id']."'>".$r['description']."</option>"); 
                                        } ?>  
                                        
                                </select>
                        </div>
                        
                        <div class="form-group">
                                <label  for='input-special'  class="input-label">Special project:</label>
                                <select  id='input-special'  class="input-field" name="special_project">
                                        <option value='0'>No</option>
                                        <option value='1'>Yes</option>
                                </select>
                        </div>

                        <div class="form-group">
                                <label  for='input-permanent'  class="input-label">Permanent Works:</label>
                                <select  id='input-permanent'  class="input-field" name="permanent_works">
                                        <option value='0'>No</option>
                                        <option value='1'>Yes</option>
                                </select>
                        </div>

                        <div class="form-group">
                                <label  for='input-depth'  class="input-label">Depth:</label>
                                <input value="<?php  echo  ucfirst($old_design['depth']); ?>" id='input-depth'  class="input-field" type="number" step="0.01" name="depth" placeholder='<?php  echo  $old_design['depth']; ?>'> 
                        </div>

                        <div class="form-group">
                                <label  for='input-length'  class="input-label">Length:</label>
                                <input value="<?php  echo  ucfirst($old_design['length']); ?>" id="input-lenght"  class="input-field" type="number" step="0.01" name="length" placeholder='<?php  echo  $old_design['length']; ?>'>
                        </div>

                        <div class="form-group">
                                <label  for='input-width'  class="input-label">Width:</label>
                                <input value="<?php  echo  ucfirst($old_design['width']); ?>" id="input-width"  class="input-field" type="number" step="0.01" name="width" placeholder='<?php  echo  $old_design['width']; ?>'>
                        </div>

                        <input type="submit" id="submit-form" name='addDesignSubmit' style='display:none;' /> 
                </form>
        </div>

        <!-- tab  @form button -->
        <div class="form-button">
                <label  class="form-btn"  for="submit-form" tabindex="0">EDIT DESIGN</label> 
        </div>
 
</div>

<?php

 
if(isset($_POST['addDesignSubmit']) & !empty($_POST)){
        
	$idToUpdate = $old_design['id'];
       
	$customer = $sys->sanitizeData($_POST['customer']);
	$location = $sys->sanitizeData($_POST['location']);
        $contractor = $sys->sanitizeData($_POST['contractor']);
        $design_title = $sys->sanitizeData($_POST['design_title']);
        
        $special_project = ($_POST['special_project'] == 0 ? "0" : "1"); 
	$design_type_id = $_POST['design_type_id']; 
        $permanent_works = ($_POST['permanent_works'] == 0 ? "0" : "1");
        
	$depth = $sys->sanitizeData($_POST['depth']);
	$length = $sys->sanitizeData($_POST['length']);
	$width = $sys->sanitizeData($_POST['width']);
       
        
 $user->editDesign($idToUpdate, $customer, $location, $contractor, $design_title, $design_type_id, $special_project, $permanent_works, $depth, $length, $width);
      
 
 $obj = [ $allDesign_types,]; 
 $sys->freeMemory($obj); 

}

 

?>
