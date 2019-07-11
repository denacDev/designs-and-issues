<nav>
    <a href='?page=designs'class="nav-link ">&lt; Cancel</a> 
</nav>


<?php 

        //get all design types
        $allDesign_types = $sys->getTable('id, description', 'design_types','','');
?>
 
<div class="secondary-component-container">

        <!-- tab head -->
        <div class="control-tab"> <div class="title-value">ADD NEW DESIGN</div> </div>
        <!-- tab body -->
        <div class="secondary-component-body "> 
                <form method="post" name='add_design'> 
                        <!-- form body -->
                        <div class="form-group ">
                                <label for='input-customer' class="input-label">Customer:</label>
                                <input value="cust" id="input-customer" class="input-field" name="customer" placeholder='Customer'>
                        </div>

                        <div class="form-group">
                                <label  for='input-location' class="input-label">Location:</label>
                                <input value="loct" id="input-location" class="input-field" name="location" placeholder='Location'>
                        </div>

                        <div class="form-group">
                                <label  for='input-contractor'  class="input-label">Contractor:</label>
                                <input value="cont" id="input-contractor" class="input-field" name="contractor" placeholder='Contractor'>
                                
                        </div>
                        <div class="form-group">
                                <label  for='input-contractor'  class="input-label">Title:</label>
                                <input value="titl" id="input-contractor" class="input-field" name="design_title" placeholder='Design Title'>
                                
                        </div> 
                        
                        <div class="form-group">
                                <label  for='input-design'  class="input-label">Design type:</label>
                                <select  id='input-design'  class="input-field" name="design_type_id"> 
                                        <?php  while($r = mysqli_fetch_assoc($allDesign_types)){    echo ("<option value='".$r['id']."'>".$r['description']."</option>");  } ?>  
                                        
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
                                <input value="1111"  id='input-depth'  class="input-field" type="number" step="0.01" name="depth" placeholder='Add Depth'> 
                        </div>

                        <div class="form-group">
                                <label  for='input-length'  class="input-label">Length:</label>
                                <input value="2222"  id="input-lenght"  class="input-field" type="number" step="0.01" name="length" placeholder='Add Length'>
                        </div>

                        <div class="form-group">
                                <label  for='input-width'  class="input-label">Width:</label>
                                <input value="3333"  id="input-width"  class="input-field" type="number" step="0.01" name="width" placeholder='Add Width'>
                        </div>

                        <input type="submit" id="submit-go" name='submit_and_go' style='display:none;' /> 
                        <input type="submit" id="submit-stay" name='submit_and_stay' style='display:none;' /> 
                </form>
        </div>

        <!-- tab  @form button -->
        <div class="form-button">
                  <label style='display:inline-block;'  class="form-btn"  for="submit-go" tabindex="0">ADD DESIGN and go</label>  
                  <label style='display:inline-block;'  class="form-btn"  for="submit-stay" tabindex="0">ADD DESIGN and stay</label>  
        </div>
 
</div>

<?php
   
      


   
if(isset($_POST['submit_and_go']) || isset($_POST['submit_and_stay']) && !empty($_POST)){


        // in case of go --> redirect
        if(isset( $_POST['submit_and_go'])){ $stayOrGo = "go";}else{$stayOrGo = "";}
	  
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
	 
        
$user->addDesign($stayOrGo, $customer, $location, $contractor, $design_title, $design_type_id, $special_project, $permanent_works, $depth, $length, $width);

 
  // free memory
$obj = [ $allDesign_types];  
 $sys->freeMemory($obj); 
        
}
  
?>
